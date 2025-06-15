<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:consultant']);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $totalProjects = Project::where('consultant_id', $user->id)->count();
        $activeProjects = Project::where('consultant_id', $user->id)->where('status', 'active')->count();
        $completedProjects = Project::where('consultant_id', $user->id)->where('status', 'completed')->count();
        $consultantProfile = DB::table('consultant_profiles')->where('user_id', $user->id)->first();
        return view('consultant.dashboard', compact('totalProjects', 'activeProjects', 'completedProjects', 'consultantProfile'));
    }

    public function projects()
    {
        $consultant = Auth::user();
        $projects = Project::where('consultant_id', $consultant->id)
            ->with('client')
            ->latest()
            ->paginate(10);

        return view('consultant.projects', compact('projects'));
    }

    public function showProject(Project $project)
    {
        $this->authorize('view', $project);
        return view('consultant.projects.show', compact('project'));
    }

    public function profile()
    {
        return view('consultant.profile');
    }

    public function messages()
    {
        return view('consultant.messages');
    }

    public function editProfile()
    {
        return view('consultant.profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'qualifications' => 'required|string',
        ]);

        auth()->user()->update($validated);

        return redirect()->route('consultant.dashboard')
            ->with('success', __('messages.consultant.profile_updated'));
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
}
