<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectOffer;

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

    public function submitOffer(Request $request, Project $project)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string|max:1000',
        ]);

        ProjectOffer::create([
            'project_id' => $project->id,
            'user_id' => Auth::id(),
            'amount' => $validated['amount'],
            'note' => $validated['note'] ?? null,
            'status' => 'pending',
        ]);

        return back()->with('success', 'تم تقديم العرض بنجاح!');
    }

    /**
     * عرض قائمة المشاريع المرتبطة بالمقاول بعد الموافقة
     */
    public function projects()
    {
        $user = Auth::user();
        $projects = Project::where('contractor_id', $user->id)->latest()->get();
        return view('contractor.projects', compact('projects'));
    }

    /**
     * عرض تفاصيل مشروع للمقاول مع ملفات الاستشاري
     */
    public function showProject($id)
    {
        $user = Auth::user();
        $project = Project::where('contractor_id', $user->id)->where('id', $id)->firstOrFail();
        $acceptedProposal = $project->proposals()->where('status', 'accepted')->first();
        return view('contractor.project-details', compact('project', 'acceptedProposal'));
    }
}
