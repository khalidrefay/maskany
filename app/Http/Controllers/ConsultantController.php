<?php
//ConsultantController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectItems;
use App\Models\ProjectProposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectMessage;
use App\Models\ProjectMessageAttachment;
use App\Notifications\NewProjectMessage;

class ConsultantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:consultant']);
    }

    public function dashboard()
    {
        $consultant = auth()->user();

        // Get active projects count
        $activeProjects = Project::whereHas('proposals', function($query) use ($consultant) {
            $query->where('consultant_id', $consultant->id)
                  ->where('status', 'accepted');
        })->count();

        // Get total proposals count
        $totalProposals = ProjectProposal::where('consultant_id', $consultant->id)->count();

        // Get accepted proposals count
        $acceptedProposals = ProjectProposal::where('consultant_id', $consultant->id)
            ->where('status', 'accepted')
            ->count();

        // Calculate average rating
        $averageRating = ProjectProposal::where('consultant_id', $consultant->id)
            ->whereNotNull('rating')
            ->avg('rating') ?? 0;

        // Get recent projects with their proposals
        $recentProjects = Project::whereHas('proposals', function($query) use ($consultant) {
            $query->where('consultant_id', $consultant->id);
        })
        ->with(['proposals' => function($query) use ($consultant) {
            $query->where('consultant_id', $consultant->id);
        }])
        ->latest()
        ->take(5)
        ->get()
        ->map(function($project) {
            $proposal = $project->proposals->first();
            $project->status = $proposal->status;
            $project->status_text = $proposal->status_text;
            return $project;
        });

        return view('consultant.dashboard', compact(
            'activeProjects',
            'totalProposals',
            'acceptedProposals',
            'averageRating',
            'recentProjects'
        ));
    }

    public function projects()
    {
        $consultant = Auth::user();
        $projects = Project::where('consultant_id', $consultant->id)
            ->with(['client', 'items'])
            ->latest()
            ->paginate(10);

        return view('consultant.projects', compact('projects'));
    }
    public function availableProjects()
    {
        // dd('availableProjects');
        $projects = ProjectItems::with(['user'])->latest()->get();
        return view('consultant.available-projects', compact('projects'));
    }
    public function show($id)
    {
        $project = ProjectItems::where('id',$id)->with(['user'])->first();
        return view('consultant.project-details', compact('project'));
    }

    public function showProject(Project $project)
    {
        $this->authorize('view', $project);
        return view('consultant.projects.show', compact('project'));
    }

    public function profile()
    {
        $consultant = auth()->user();
        return view('consultant.profile', compact('consultant'));
    }

    public function messages()
    {
        return view('consultant.messages');
    }

    public function editProfile()
    {
        $consultant = auth()->user();
        return view('consultant.edit-profile', compact('consultant'));
    }

    public function updateProfile(Request $request)
    {
        $consultant = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $consultant->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'specialization' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'qualifications' => 'required|string|max:1000',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($consultant->image) {
                Storage::disk('public')->delete($consultant->image);
            }
            $validated['image'] = $request->file('image')->store('consultants', 'public');
        }

        $consultant->update($validated);

        return redirect()
            ->route('consultant.profile')
            ->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    public function submitOffer(Request $request, Project $project)
    {
        $validated = $request->validate([
            'plans' => 'required|string',
            'materials' => 'required|string',
            'price' => 'required|numeric|min:1',
        ]);

        $project->update([
            'plans' => $validated['plans'],
            'materials' => $validated['materials'],
            'price' => $validated['price'],
            'status' => 'pending_approval',
        ]);

        return redirect()->route('consultant.projects')->with('success', 'تم تقديم العرض بنجاح!');
    }

    public function myOffers()
    {
        $proposals = ProjectProposal::where('consultant_id', auth()->id())
            ->with(['project'])
            ->latest()
            ->paginate(10);

        return view('consultant.my-offers', compact('proposals'));
    }

   

    public function sendMessage(Request $request)
    {
        try {
            $validated = $request->validate([
                'project_id' => 'required|exists:projects,id',
                'message' => 'required|string|min:10',
                'files' => 'nullable|array|max:3',
                'files.*' => 'nullable|file|max:10240|mimes:pdf',
                'file_types' => 'nullable|array|max:3',
                'file_types.*' => 'nullable|in:architectural_plan,structural_plan,technical_plan'
            ], [
                'files.max' => 'يمكنك رفع 3 ملفات كحد أقصى',
                'files.*.file' => 'الملف المرفوع غير صالح',
                'files.*.max' => 'حجم الملف يتجاوز الحد الأقصى المسموح به (10MB)',
                'files.*.mimes' => 'يرجى رفع ملفات PDF فقط',
                'file_types.max' => 'يمكنك تحديد 3 أنواع فقط',
                'file_types.*.in' => 'نوع المخطط غير صالح'
            ]);

            // إنشاء الرسالة
            $message = ProjectMessage::create([
                'project_id' => $validated['project_id'],
                'user_id' => auth()->id(),
                'message' => $validated['message']
            ]);

            // رفع الملفات إذا وجدت
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $file) {
                    $path = $file->store('project-files', 'public');
                    ProjectMessageAttachment::create([
                        'message_id' => $message->id,
                        'file_path' => $path,
                        'file_type' => $request->input('file_types')[$index] ?? null,
                        'original_name' => $file->getClientOriginalName()
                    ]);
                }
            }

            // إرسال إشعار
            $project = Project::findOrFail($request->project_id);
            $project->user->notify(new NewProjectMessage($message));

            return response()->json([
                'success' => true,
                'message' => 'تم إرسال الرسالة بنجاح'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطأ في البيانات المدخلة',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error in sendMessage: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إرسال الرسالة'
            ], 500);
        }
    }

    

public function finalDeliveryForm(Project $project)
{
    return view('consultant.final_delivery', compact('project'));
}


// في الكونترولر
public function myOffersView(Request $request)
{
    $query = projectProposal::with('project')
            ->where('consultant_id', auth()->id());
            
    if ($request->status) {
        $query->where('status', $request->status);
    }
    
    $proposals = $query->latest()->paginate(10);
    
    return view('consultant.my-offers', compact('proposals'));
}
public function showFinalDeliveryForm($projectId)
{
    $project = Project::findOrFail($projectId);
    
    return view('consultant.final_delivery', [
        'project' => $project
    ]);
}

public function submitFinalDelivery(Request $request, $projectId)
{
    $validated = $request->validate([
        'delivery_files' => 'required|array|min:1',
        'delivery_files.*' => 'file|mimes:pdf,jpg,png,zip|max:2048',
        'notes' => 'nullable|string|max:1000'
    ]);

    // رفع الملفات
    $paths = [];
    foreach ($request->file('delivery_files') as $file) {
        $paths[] = $file->store('public/deliveries');
    }
    
    // حفظ البيانات
    Delivery::create([
        'project_id' => $projectId,
        'consultant_id' => auth()->id(),
        'files' => json_encode($paths),
        'notes' => $request->notes
    ]);

    return redirect()->route('consultant.dashboard')
                   ->with('success', 'تم تسليم المشروع بنجاح');
}



}
