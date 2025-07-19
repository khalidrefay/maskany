<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $totalProjects = Project::where('user_id', $user->id)->count();
        $activeProjects = Project::where('user_id', $user->id)->where('status', 'active')->count();
        $completedProjects = Project::where('user_id', $user->id)->where('status', 'completed')->count();
        return view('user.dashboard', compact('totalProjects', 'activeProjects', 'completedProjects'));
        // return view('user.dashboard');
    }
}
