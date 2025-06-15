<?php

namespace App\Http\Controllers;

use App\Models\ProjectItems;
use App\Models\ProjectOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectOfferController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:project_items,id',
            'amount'     => 'required|numeric|min:1',
            'note'       => 'nullable|string|max:1000',
        ]);

        ProjectOffer::create([
            'project_id' => $validated['project_id'],
            'user_id'    => Auth::id(),
            'amount'     => $validated['amount'],
            'note'       => $validated['note'] ?? null,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'تم إرسال العرض بنجاح!');
    }

    /**
     * List all offers for a specific project (for project owner).
     */
    public function index($project_id)
    {
        $project = ProjectItems::with('offers.user')->findOrFail($project_id);

        // Only allow the owner to view offers
        if ($project->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بعرض هذه العروض');
        }

        $offers = $project->offers()->with('user')->latest()->get();

        return view('project.project-offers', compact('project', 'offers'));
    }

    /**
     * Accept an offer (optional).
     */
    public function accept($offer_id)
    {
        $offer = ProjectOffer::findOrFail($offer_id);

        // Only project owner can accept
        if ($offer->project->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك');
        }

        $offer->status = 'accepted';
        $offer->save();

        // Optionally, reject other offers for this project
        ProjectOffer::where('project_id', $offer->project_id)
            ->where('id', '!=', $offer->id)
            ->update(['status' => 'rejected']);

        return back()->with('success', 'تم قبول العرض بنجاح!');
    }

    /**
     * Reject an offer (optional).
     */
    public function reject($offer_id)
    {
        $offer = ProjectOffer::findOrFail($offer_id);

        // Only project owner can reject
        if ($offer->project->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك');
        }

        $offer->status = 'rejected';
        $offer->save();

        return back()->with('success', 'تم رفض العرض.');
    }
}