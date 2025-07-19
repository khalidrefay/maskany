<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectProposal;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:supplier']);
    }

    /**
     * لوحة تحكم المورد
     */
    public function dashboard()
    {
        $user = Auth::user();
        // عدد المشاريع المتاحة
        $availableProjects = Project::whereHas('proposals', function($q) {
            $q->where('status', 'accepted');
        })->count();
        // عدد العروض المقدمة من المورد (لاحقاً)
        $myOffers = 0;
        return view('supplier.dashboard', compact('availableProjects', 'myOffers'));
    }

    /**
     * عرض المشاريع المتاحة للمورد بعد موافقة الاستشاري
     */
    public function projects()
    {
        // المشاريع التي بها عرض استشاري مقبول
        $projects = Project::whereHas('proposals', function($q) {
            $q->where('status', 'accepted');
        })->with(['proposals' => function($q) {
            $q->where('status', 'accepted');
        }])->latest()->get();
        return view('supplier.projects', compact('projects'));
    }

    /**
     * تفاصيل مشروع للمورد مع تحميل الملفات
     */
    public function showProject($id)
    {
        $project = Project::whereHas('proposals', function($q) {
            $q->where('status', 'accepted');
        })->with(['proposals' => function($q) {
            $q->where('status', 'accepted');
        }])->findOrFail($id);
        $acceptedProposal = $project->proposals->first();
        return view('supplier.project-details', compact('project', 'acceptedProposal'));
    }

    /**
     * تقديم عرض للمواد من المورد على مشروع متاح
     */
    public function storeOffer(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:project_items,id',
            'amount'     => 'required|numeric|min:1',
            'note'       => 'nullable|string|max:1000',
        ]);

        \App\Models\ProjectOffer::create([
            'project_id' => $validated['project_id'],
            'user_id'    => Auth::id(),
            'amount'     => $validated['amount'],
            'note'       => $validated['note'] ?? null,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'تم إرسال عرضك للمواد بنجاح!');
    }
}
