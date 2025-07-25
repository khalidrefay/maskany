<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectProposal;


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

    // المشاريع الخاصة بالمستخدم
    $userProjectIds = Project::where('user_id', $user->id)->pluck('id');

    // العروض المقدمة من الاستشاريين
    $consultantOffers = ProjectProposal::whereIn('project_id', $userProjectIds)
        ->whereHas('consultant') // علشان نتأكد إنه استشاري
        ->with(['project', 'consultant'])
        ->get();

    // عروض أخرى (ممكن تضيف شرط حسب نوع المستخدم لو فيه)
    $contractorOffers = ProjectProposal::whereIn('project_id', $userProjectIds)
        ->whereDoesntHave('consultant') // نفترض إنها لمورد أو مقاول
        ->with(['project', 'consultant'])
        ->get();

    return view('user.dashboard', compact(
        'totalProjects',
        'activeProjects',
        'completedProjects',
        'consultantOffers',
        'contractorOffers'
    ));
}

}
