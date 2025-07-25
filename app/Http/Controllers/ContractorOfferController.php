<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectProposal;
use App\Models\ContractorOffer;

class ContractorOfferController extends Controller
{
    public function store(Request $request, $project)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'timeline' => 'required|integer|min:1',
            'details' => 'required|string',
            'pdf_file' => 'required|file|mimes:pdf|max:5120',
        ]);

        $project = \App\Models\Project::findOrFail($project);

        $offer = new ContractorOffer();
        $offer->project_id = $project->id;
        $offer->contractor_id = auth()->id();
        $offer->price = $request->price;
        $offer->timeline = $request->timeline;
        $offer->details = $request->details;

        if ($request->hasFile('pdf_file')) {
            $filePath = $request->file('pdf_file')->store('offers', 'public');
            $offer->pdf_file = $filePath;
        }

        $offer->save();

        return redirect()->route('contractor.offers.list')->with('success', 'تم حفظ العرض بنجاح');
    }

    public function showOffers()
    {
        $user = Auth::user();
        
        if ($user->role == 'consultant') {
            $projects = Project::whereHas('proposals', function($q) use ($user) {
                $q->where('consultant_id', $user->id);
            })->with(['proposals.contractors'])->get();
        } 
        elseif ($user->role == 'contractor') {
            $projects = Project::whereHas('contractors', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->with(['proposals.consultant', 'contractors'])->get();
        } 
        else {
            $projects = $user->projects()
                            ->with(['proposals.consultant', 'contractors'])
                            ->get();
        }

        return view('projects.offers', [
            'projects' => $projects,
            'userRole' => $user->role
        ]);
    }

    public function accept(Project $project, User $contractor)
    {
        $project->contractors()->updateExistingPivot($contractor->id, ['status' => 'accepted']);
        return response()->json(['success' => true]);
    }

    public function delete(Project $project)
    {
        $project->contractors()->detach(auth()->id());
        return response()->json(['success' => true]);
    }

    public function storeOffer(Request $request, Project $project)
    {
        $validated = $request->validate([
            'price' => 'required|numeric',
            'timeline' => 'required|integer',
            'details' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $offer = $project->contractor_offers()->create([
            'contractor_id' => auth()->id(),
            'price' => $validated['price'],
            'timeline' => $validated['timeline'],
            'details' => $validated['details'],
            'pdf_file' => $request->file('pdf_file') ? $request->file('pdf_file')->store('offers', 'public') : null,
            'status' => 'pending',
        ]);

        return redirect()->route('contractor.offers.list')->with('success', 'تم حفظ العرض بنجاح');
    }

    public function create(Project $project)
    {
        if (auth()->user()->role == 'contractor' && $project->proposals()->count()) {
            $offer = session('offer_data', [
                'price' => old('price'),
                'timeline' => old('timeline'),
                'details' => old('details'),
                'pdf_file' => old('pdf_file'),
            ]);
            return view('contractor_offer_create', compact('project', 'offer'));
        }
        abort(403, 'غير مصرح لك بتقديم عرض');
    }

    public function preview(Project $project, ContractorOffer $offer)
    {
        if ($offer->contractor_id == auth()->id()) {
            return view('contractor_offer_preview', compact('project', 'offer'));
        }
        abort(403, 'غير مصرح لك بمعاينة هذا العرض');
    }

    public function destroy(Project $project, ContractorOffer $offer)
    {
        if ($offer->contractor_id == auth()->id()) {
            $offer->delete();
            return redirect()->route('projects.multi', ['project' => $project->id])
                             ->with('success', 'تم حذف العرض بنجاح');
        }
        abort(403, 'غير مصرح لك بحذف هذا العرض');
    }

    public function listOffers()
    {
        $offers = auth()->user()->contractorOffers()->with('project')->get();
        $projects = Project::whereDoesntHave('contractorOffers', function ($query) {
            $query->where('contractor_id', auth()->id());
        })->get();
        return view('contractor_offers_list', compact('offers', 'projects'));
    }

    public function show($offer)
    {
        $offer = ContractorOffer::with(['project', 'contractor'])->findOrFail($offer);
        $isContractor = auth()->user()->role === 'contractor' && $offer->contractor->id === auth()->id();
        return view('contractor.offers.show', compact('offer', 'isContractor'));
    }

public function submitOffer(Request $request, $project_id)
{
    $validated = $request->validate([
        'price' => 'required|numeric',
        'timeline' => 'required|integer',
        'details' => 'nullable|string',
        'pdf_file' => 'nullable|file|mimes:pdf|max:5120',
        'project_id' => 'required|exists:contractor_offers,project_id', // تحقق من وجود project_id
        'contractor_id' => 'required|exists:users,id',
    ]);

    try {
        $offer = new ContractorOffer();
        $offer->proposal_id = $request->input('proposal_id', null);
        $offer->contractor_id = $validated['contractor_id'];
        $offer->price = $validated['price'];
        $offer->timeline = $validated['timeline'];
        $offer->details = $validated['details'];
        $offer->pdf_file = $request->file('pdf_file') ? $request->file('pdf_file')->store('offers', 'public') : null;
        $offer->status = 'pending';
        $offer->project_id = $project_id;
        $offer->save();

        return response()->json([
            'success' => true,
            'redirect' => route('contractor.offers.list')
        ]);
    } catch (\Exception $e) {
        \Log::error('Error saving offer: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'فشل في حفظ العرض، حاول مرة أخرى: ' . $e->getMessage()
        ], 400);
    }
}
public function showProjectOffers($projectId)
{
    $project = Project::with(['offers.contractor'])->findOrFail($projectId);
    
    return view('projects.offers', [
        'project' => $project,
        'offers' => $project->offers
    ]);
}
public function showOfferDetails($offerId)
{
    $offer = ContractorOffer::with(['contractor', 'project'])->findOrFail($offerId);
    return view('offers.details', compact('offer'));
}



public function acceptOffer($offerId)
{
    $offer = ContractorOffer::findOrFail($offerId);
    
    // تحديث حالة العرض
    $offer->update(['status' => 'accepted']);
    
    // تحديث حالة المشروع
    $offer->project->update(['status' => 'in_progress']);
    
    return back()->with('success', 'تم قبول العرض بنجاح');
}

}