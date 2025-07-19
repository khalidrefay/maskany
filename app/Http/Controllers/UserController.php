<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $projects = \App\Models\Project::where('user_id', $user->id)->get();
        $totalProjects = $projects->count();
        $activeProjects = $projects->where('status', 'active')->count();
        $completedProjects = $projects->where('status', 'completed')->count();

        // جلب عروض الاستشاريين
        $consultantOffers = \App\Models\ProjectProposal::whereIn('project_id', $projects->pluck('id'))->with('consultant', 'project')->latest()->get();
        // جلب عروض المقاولين/الموردين
        $contractorOffers = \App\Models\ProjectOffer::whereIn('project_id', $projects->pluck('id'))->with('user', 'project')->latest()->get();

        return view('user.dashboard', compact('totalProjects', 'activeProjects', 'completedProjects', 'consultantOffers', 'contractorOffers'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }
}
