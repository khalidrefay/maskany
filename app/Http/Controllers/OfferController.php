<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Store a new offer.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'land_exchange_id' => 'required|exists:land_exchanges,id',
            'offer_price' => 'required|numeric|min:0',
            'offer_note' => 'nullable|string|max:1000',
        ]);

        Offer::create([
            'land_exchange_id' => $validated['land_exchange_id'],
            'user_id' => auth()->id(), // Set user_id directly from authenticated user
            'price' => $validated['offer_price'],
            'note' => $validated['offer_note'] ?? null,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'تم إرسال العرض بنجاح');
    }

    /**
     * Accept an offer.
     */
    public function accept($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->status = 'accepted';
        $offer->save();

        // Optionally, notify the user or update related models

        return back()->with('success', 'تم قبول العرض بنجاح!');
    }

    /**
     * Reject an offer.
     */
    public function reject($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->status = 'rejected';
        $offer->save();

        // Optionally, notify the user or update related models

        return back()->with('success', 'تم رفض العرض.');
    }


    /**
     * Display a listing of the user's offers.
     */
    public function index()
    {
        $useroffers = Offer::where('user_id', Auth::id())
            ->with('landExchange')
            ->latest()
            ->paginate(10);

        return view('land-exchange', compact('useroffers'));
    }
}