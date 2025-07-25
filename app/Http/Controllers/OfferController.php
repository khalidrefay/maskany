<?php
//OfferController
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
/**
 * قبول العرض (تعمل مع كل أنواع العروض)
 */
public function accept($id)
{
    $offer = Offer::with(['project.user', 'proposal.project'])->findOrFail($id);
    
    $this->authorize('accept', $offer);

    // التحقق من الصلاحيات
    if ($offer->project && auth()->id() !== $offer->project->user_id) {
        return response()->json(['message' => 'غير مصرح'], 403);
    }

    if ($offer->proposal && auth()->id() !== $offer->proposal->project->user_id) {
        return response()->json(['message' => 'غير مصرح'], 403);
    }

    DB::transaction(function () use ($offer) {
        $offer->update(['status' => 'accepted']);
        
        // إذا كان عرض مقاول
        if ($offer instanceof ContractorOffer) {
            $offer->proposal->project->update(['status' => 'contractor_accepted']);
            
            MerchantNotification::create([
                'project_id' => $offer->proposal->project_id,
                'message' => 'مشروع جاهز لتلقي عروض التجار'
            ]);
        }
        
        // إذا كان عرض استشاري
        if ($offer instanceof Proposal) {
            $offer->project->update(['status' => 'consultant_accepted']);
        }
    });

    return request()->wantsJson()
        ? response()->json(['message' => 'تم قبول العرض بنجاح', 'status' => 'success'])
        : back()->with('success', 'تم قبول العرض بنجاح');
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