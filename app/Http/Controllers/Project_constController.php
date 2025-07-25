<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class Project_constController extends Controller
{
    public function showConsultantProposal(Project $project)
    {
        // تحقق إن المستخدم هو العميل أو مقاول وفيه اقتراحات استشارية
        if (auth()->id() == $project->user_id || (auth()->user()->role == 'contractor' && $project->proposals()->count() > 0)) {
            return view('consultant_proposal', compact('project'));
        }
        abort(403, 'غير مصرح لك بمشاهدة هذه الصفحة');
    }

    public function createContractorOffer(Project $project)
    {
        if (auth()->user()->role == 'contractor' && $project->proposals()->count()) {
            return view('contractor_offer_create', compact('project'));
        }
        abort(403, 'غير مصرح لك بتقديم عرض');
    }


public function acceptContractorOffer(Request $request, $offerId)
{
    $offer = ContractorOffer::findOrFail($offerId);
    if (auth()->id() == $offer->project->user_id) {
        $offer->update(['status' => 'accepted']);
        return redirect()->back()->with('success', 'تم قبول عرض المقاول');
    }
    abort(403, 'غير مصرح لك بقبول العرض');
}


public function rejectContractorOffer(Request $request, Project $project, ContractorOffer $offer)
{
    if (auth()->id() == $project->user_id) {
        $offer->update(['status' => 'rejected']);
        return redirect()->back()->with('success', 'تم رفض عرض المقاول');
    }
    abort(403, 'غير مصرح لك برفض العرض');
}

public function showProjectOffers(Project $project)
{
    if (auth()->id() == $project->user_id) {
        $consultantProposals = $project->proposals;
        $contractorOffers = $project->contractor_offers()->with('contractor')->get(); // تحميل العلاقة contractor
        return view('project_offers', compact('project', 'consultantProposals', 'contractorOffers'));
    }
    abort(403, 'غير مصرح لك بمشاهدة هذه الصفحة');
}


}
