<?php

namespace App\Http\Controllers;

use App\Models\ProjectItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectItemsController extends Controller
{
    //index
    public function cost()
    {
        return view('estimate-projects.estimate-cost');
    }
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'user') {
            // مالك المشروع: كل مشاريعه
            $projects = ProjectItems::with(['user', 'proposals.consultant'])
                ->where('user_id', $user->id)
                ->orderBy('id', 'desc')->latest()->paginate(10);
        } elseif ($user->role === 'consultant') {
            // استشاري: فقط المشاريع التي proposal.status = accepted له
            $projects = ProjectItems::with(['user', 'proposals.consultant'])
                ->whereHas('proposals', function($q) use ($user) {
                    $q->where('consultant_id', $user->id)->where('status', 'accepted');
                })
                ->orderBy('id', 'desc')->latest()->paginate(10);
        } else {
            // غير ذلك: لا تظهر مشاريع
            $projects = collect();
        }
        return view('project.multi-project', compact('projects'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'land_area' => 'required|numeric|min:1',
            'design' => 'required|string|max:255',
            'finishing' => 'required|string|max:255',
            'shape' => 'required|string|max:255',
            'floors' => 'nullable|integer|min:1',
            'bedrooms' => 'nullable|integer|min:0',
            'living_rooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'kitchens' => 'nullable|integer|min:0',
            'annexes' => 'nullable|integer|min:0',
            'parking' => 'nullable|integer|min:0',
            'required_area' => 'nullable|numeric|min:0',
            'terms' => 'required|boolean',
            'contact' => 'nullable|boolean',
            'estimate' => 'nullable|numeric|min:0',
        ]);

        // Set user_id after validation
        $validated['user_id'] = Auth::id();

        ProjectItems::create($validated);

      return redirect()->back()->with('success', 'تم حذف المشروع بنجاح.');
    }
public function show($id)
{
    $project = ProjectItems::with(['user', 'proposals.consultant'])->findOrFail($id);
    return view('consultant.projects.show', compact('project'));
}

public function multiProject()
{
    // تحميل العلاقات مع فلترة حسب دور المستخدم
    $query = Project::with([
        'proposals.consultant',
        'contractorOffers.contractor',
        'contractors'
    ]);

    // إذا كان المستخدم مقاولاً، نحمّل فقط المشاريع المرتبطة به
    if (auth()->check() && auth()->user()->role == 'contractor') {
        $query->where(function($q) {
            $q->whereHas('contractorOffers', function($sub) {
                $sub->where('contractor_id', auth()->id());
            })->orWhereHas('contractors', function($sub) {
                $sub->where('user_id', auth()->id());
            });
        });
    }

    $projects = $query->get();

    return view('project.multi-project', compact('projects'));
}
public function acceptContractorOffer(Request $request, Project $project, User $contractor)
{
    if (auth()->id() == $project->user_id) {
        $project->contractors()->updateExistingPivot($contractor->id, ['status' => 'accepted']);
        return redirect()->back()->with('success', 'تم قبول عرض المقاول بنجاح');
    }
    abort(403, 'غير مصرح لك بهذا الإجراء');
}
    
}
