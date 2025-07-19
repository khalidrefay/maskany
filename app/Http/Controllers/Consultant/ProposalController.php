<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectItems;
use App\Models\ProjectProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\SupplierOfferStatus;
use App\Notifications\ConsultantFilesUploaded;

class ProposalController extends Controller
{
    public function create($id)
    {
        // dd($id);
        $project = ProjectItems::findorFail($id);
        return view('consultant.submit-proposal', compact('project'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'design_plans.*' => 'required|file|mimes:pdf,dwg,jpg,jpeg,png|max:10240',
            'materials_list' => 'required|file|mimes:pdf,xlsx,xls|max:10240',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:1000'
        ]);

        // Upload design plans
        $designPlans = [];
        foreach ($request->file('design_plans') as $file) {
            $path = $file->store('proposals/design-plans', 'public');
            $designPlans[] = $path;
        }

        // Upload materials list
        $materialsList = $request->file('materials_list')->store('proposals/materials-lists', 'public');

        // Create proposal
        $proposal = ProjectProposal::create([
            'project_id' => $request->project_id,
            'consultant_id' => auth()->id(),
            'design_plans' => $designPlans,
            'materials_list' => $materialsList,
            'price' => $request->price,
            'duration' => $request->duration,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        // إشعار مالك المشروع عند رفع ملفات من الاستشاري
        $proposal->project->user->notify(new ConsultantFilesUploaded($proposal));

        return redirect()
            ->route('consultant.projects.show', $request->project_id)
            ->with('success', 'تم تقديم العرض بنجاح');
    }

    public function edit($proposalId)
    {
        $proposal = ProjectProposal::findOrFail($proposalId);
        // التأكد أن المستخدم هو صاحب العرض
        if ($proposal->consultant_id !== auth()->id()) {
            abort(403);
        }
        $project = $proposal->project;
        return view('consultant.submit-proposal', [
            'project' => $project,
            'proposal' => $proposal,
            'editMode' => true
        ]);
    }

    public function update(Request $request, $proposalId)
    {
        $proposal = ProjectProposal::findOrFail($proposalId);
        if ($proposal->consultant_id !== auth()->id()) {
            abort(403);
        }
        $request->validate([
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:1000',
            // الملفات اختيارية في التعديل
            'design_plans.*' => 'nullable|file|mimes:pdf,dwg,jpg,jpeg,png|max:10240',
            'materials_list' => 'nullable|file|mimes:pdf,xlsx,xls|max:10240',
        ]);

        // تحديث الملفات إذا تم رفعها
        $designPlans = $proposal->design_plans ?? [];
        if ($request->hasFile('design_plans')) {
            $designPlans = [];
            foreach ($request->file('design_plans') as $file) {
                $path = $file->store('proposals/design-plans', 'public');
                $designPlans[] = $path;
            }
        }
        $materialsList = $proposal->materials_list;
        if ($request->hasFile('materials_list')) {
            $materialsList = $request->file('materials_list')->store('proposals/materials-lists', 'public');
        }

        $proposal->update([
            'design_plans' => $designPlans,
            'materials_list' => $materialsList,
            'price' => $request->price,
            'duration' => $request->duration,
            'notes' => $request->notes,
        ]);

        // إشعار مالك المشروع عند تحديث ملفات من الاستشاري
        $proposal->project->user->notify(new ConsultantFilesUploaded($proposal));

        return redirect()->route('consultant.projects.show', $proposal->project_id)
            ->with('success', 'تم تحديث العرض بنجاح');
    }

    /**
     * قبول عرض الاستشاري من قبل مالك المشروع
     */
    public function accept($proposalId)
    {
        $proposal = ProjectProposal::findOrFail($proposalId);
        $project = $proposal->project;

        // تحقق أن المستخدم الحالي هو مالك المشروع
        if (auth()->id() !== $project->user_id) {
            abort(403, 'غير مصرح لك بتنفيذ هذا الإجراء');
        }

        // قبول العرض
        $proposal->status = 'accepted';
        $proposal->save();

        // رفض باقي العروض لنفس المشروع
        ProjectProposal::where('project_id', $proposal->project_id)
            ->where('id', '!=', $proposal->id)
            ->update(['status' => 'rejected']);

        // تحديث المقاول في المشروع (جدول projects)
        $mainProject = \App\Models\Project::where('id', $proposal->project_id)->first();
        if ($mainProject) {
            $mainProject->contractor_id = $proposal->consultant_id;
            $mainProject->save();
        }

        // يمكنك هنا إرسال إشعار للمقاول أو تنفيذ منطق إضافي
        // مثال: إشعار بسيط (يمكنك تخصيصه)
        // $proposal->consultant->notify(new \App\Notifications\ProposalAccepted($proposal));

        return redirect()->back()->with('success', 'تم قبول عرض الاستشاري بنجاح وتم ربط الملفات بالمقاول.');
    }

    /**
     * عرض عروض الموردين على مشروع معيّن بعد موافقة الاستشاري
     */
    public function supplierOffers($projectId)
    {
        $project = \App\Models\ProjectItems::findOrFail($projectId);
        // فقط الاستشاري أو مالك المشروع يمكنه رؤية العروض
        if (auth()->id() !== $project->user_id && auth()->id() !== optional($project->proposals()->where('status', 'accepted')->first())->consultant_id) {
            abort(403, 'غير مصرح لك بعرض هذه العروض');
        }
        $offers = \App\Models\ProjectOffer::where('project_id', $projectId)->with('user')->latest()->get();
        return view('consultant.supplier-offers', compact('project', 'offers'));
    }

    /**
     * قبول عرض مورد
     */
    public function acceptSupplierOffer($offerId)
    {
        $offer = \App\Models\ProjectOffer::findOrFail($offerId);
        $project = $offer->project;
        // تحقق من الصلاحية
        if (auth()->id() !== $project->user_id && auth()->id() !== optional($project->proposals()->where('status', 'accepted')->first())->consultant_id) {
            abort(403, 'غير مصرح لك');
        }
        $offer->status = 'accepted';
        $offer->save();
        // إشعار للمورد
        $offer->user->notify(new SupplierOfferStatus($offer, 'accepted'));
        return back()->with('success', 'تم قبول عرض المورد بنجاح!');
    }

    /**
     * رفض عرض مورد
     */
    public function rejectSupplierOffer($offerId)
    {
        $offer = \App\Models\ProjectOffer::findOrFail($offerId);
        $project = $offer->project;
        // تحقق من الصلاحية
        if (auth()->id() !== $project->user_id && auth()->id() !== optional($project->proposals()->where('status', 'accepted')->first())->consultant_id) {
            abort(403, 'غير مصرح لك');
        }
        $offer->status = 'rejected';
        $offer->save();
        // إشعار للمورد
        $offer->user->notify(new SupplierOfferStatus($offer, 'rejected'));
        return back()->with('success', 'تم رفض عرض المورد.');
    }
}
