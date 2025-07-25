<?php
//ContractorController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectOffer;
use App\Models\ProjectProposal;
class ContractorController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalProjects = Project::where('contractor_id', $user->id)->count();
        $activeProjects = Project::where('contractor_id', $user->id)->where('status', 'active')->count();
        $completedProjects = Project::where('contractor_id', $user->id)->where('status', 'completed')->count();
        $contractorProfile = DB::table('contractor_profiles')->where('user_id', $user->id)->first();
        return view('contractor.dashboard', compact('totalProjects', 'activeProjects', 'completedProjects', 'contractorProfile'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('contractor.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'specialization' => 'nullable|string|max:255',
        ]);
        DB::table('users')->where('id', $user->id)->update($validated);
        return redirect()->route('contractor.dashboard')->with('success', __('messages.contractor.profile_updated'));
    }

    /**
     * عرض قائمة المشاريع المرتبطة بالمقاول بعد الموافقة
     */
public function projects()
{
    $userId = Auth::id();

    $projects = Project::whereHas('proposals', function ($query) use ($userId) {
         $query->where('status', 'accepted')
          ->where('contractor_id', $userId);
    })
    ->with(['proposals' => function ($query) use ($userId) {
        $query->where('status', 'accepted')
              ->where('contractor_id', $userId);
    }])
    ->latest()
    ->get();

    return view('contractor.projects', compact('projects'));
}


    /**
     * عرض تفاصيل مشروع للمقاول مع ملفات الاستشاري
     */
    public function showProject($id)
{
    $user = Auth::user();
    $projects = Project::with([
    'proposals.consultant',
    'contractorOffers.contractor',
    'contractors'
])->get();

    // المشروع اللي عنده تسليم نهائي فقط
    $project = Project::where('id', $id)
                      ->whereHas('proposals', function ($query) {
                          $query->where('status', 'accepted');
                                              })
                      ->firstOrFail();

    $acceptedProposal = $project->proposals()
                                ->where('status', 'accepted')
                                ->first();

    return view('contractor.project-details', compact('project', 'acceptedProposal'));
}

    public function availableProjects()
{
    $projects = Project::whereHas('proposals', function ($query) {
        $query->where('status', 'accepted');// الحالة لازم تكون مقبولة
    })
    ->with(['proposals' => function ($q) {
        $q->where('status', 'accepted');
        }])
    ->latest()
    ->get();

    return view('contractor.available-projects', compact('projects'));
}
public function showOfferForm(Project $project)
{
    if ($project->status !== 'consultant_accepted') {
        abort(403, 'لا يمكن تقديم عرض لهذا المشروع حالياً');
    }

    return view('contractor.offer-form', compact('project'));
}

public function submitOffer(Request $request, Project $project)
{
    $validated = $request->validate([
        'price' => 'required|numeric|min:0',
        'details' => 'required|string|max:1000',
        'timeline' => 'required|string|max:255'
    ]);

    $proposal = $project->proposals()->where('status', 'accepted')->first();

    $proposal->contractorOffers()->create([
        'contractor_id' => auth()->id(),
        'price' => $request->price,
        'details' => $request->details,
        'timeline' => $request->timeline
    ]);

    return redirect()->route('contractor.dashboard')
                   ->with('success', 'تم تقديم عرضك بنجاح');
}
public function myProjects()
{
    $projects = Project::with([
            'proposals.consultant',
            'contractorOffers.contractor',
            'contractors'
        ])
        ->where(function($q) {
            $q->whereHas('contractorOffers', function($sub) {
                $sub->where('contractor_id', auth()->id());
            })->orWhereHas('contractors', function($sub) {
                $sub->where('user_id', auth()->id());
            });
        })
        ->get();

    return view('project.multi-project', compact('projects'));
}
public function myOffers()
{
    $offers = auth()->user()->contractorOffers()->with('project')->get();
    return view('contractor.contractor_offers_list', compact('offers')); // 
}


public function showConsultantProposal(ProjectProposal $proposal)
    {
        // جلب بيانات الاستشاري
        $consultant = $proposal->consultant;

        // جلب المشروع بناءً على العلاقة (افتراض إن فيه علاقة مع Project أو ProjectItems)
        $project = $proposal->projectItem->project ?? $proposal->project ?? null;

        // لو المشروع مش موجود، يمكن نرجع خطأ أو صفحة بديلة
        if (!$project) {
            return redirect()->back()->with('error', 'لا يمكن عرض بيانات الاستشاري: المشروع غير موجود.');
        }

        return view('consultant_proposal', compact('proposal', 'consultant', 'project'));
    }

    

}
