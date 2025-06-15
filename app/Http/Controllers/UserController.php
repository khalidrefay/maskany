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
        $totalProjects = Project::where('client_id', $user->id)->count();
        $activeProjects = Project::where('client_id', $user->id)->where('status', 'active')->count();
        $completedProjects = Project::where('client_id', $user->id)->where('status', 'completed')->count();
        return view('user.dashboard', compact('totalProjects', 'activeProjects', 'completedProjects'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }
}
 