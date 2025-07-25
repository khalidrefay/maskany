<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class Contractor_Offerdetails_Controller extends Controller
{
   public function preview(Request $request, Project $project)
{
    $validated = $request->validate([
        'price' => 'required|numeric|min:0',
        'timeline' => 'required|integer|min:1',
        'details' => 'nullable|string|max:1000',
        'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
    ]);

    try {
        $offer = $project->contractorOffers()->create([
            'contractor_id' => auth()->id(),
            'price' => $validated['price'],
            'timeline' => $validated['timeline'],
            'details' => $validated['details'],
            'pdf_file' => $request->file('pdf_file') ? 
                $request->file('pdf_file')->store('offers', 'public') : null,
            'status' => 'pending',
        ]);

        return redirect()->route('contractor.my.offers')
            ->with('success', 'تم الحفظ و العرض على العميل');

    } catch (\Exception $e) {
        return back()->withInput()
            ->with('error', 'حدث خطأ أثناء الحفظ: ' . $e->getMessage());
    }
}
    // إذا عايز زرار "تقديم العرض النهائي" يشتغل، أضف:
    public function store(Request $request, Project $project)
    {
        // الكود هنا لحفظ العرض في الـ Database
        // مثال: $offer = new Offer(); $offer->save();
        return redirect()->route('consultant.proposal.show', $project->id)->with('success', 'تم تقديم العرض بنجاح');
    }
    public function showConsultantProposal(Project $project)
{
    if (auth()->id() == $project->user_id || (auth()->user()->role == 'contractor' && $project->proposals()->count() > 0)) {
        return view('consultant_proposal', compact('project'));
    }
    abort(403, 'غير مصرح لك بمشاهدة هذه الصفحة');
}


}