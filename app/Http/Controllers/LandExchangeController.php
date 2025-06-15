<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandExchange;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LandExchangeController extends Controller
{
    /**
     * Store a new land exchange ad.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'current_location' => 'required|string|max:255',
            'desired_locations' => 'required|array|min:1',
            'desired_locations.*' => 'required|string|max:255',
            'current_area' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:2000',
            'image' => 'nullable|image|max:4096',
            'phone_number' => 'required|string|max:20',
            'price' => 'nullable|numeric|min:0',
            'for_sale' => 'nullable|boolean',
            'for_exchange' => 'nullable|boolean',
            'map_coordinates' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('land_exchange_images', 'public');
        }

        // Convert desired_locations array to JSON for storage
        $validated['desired_locations'] = json_encode($validated['desired_locations'], JSON_UNESCAPED_UNICODE);

        // Checkbox values
        $validated['for_sale'] = $request->has('for_sale') ? 1 : 0;
        $validated['for_exchange'] = $request->has('for_exchange') ? 1 : 0;

        LandExchange::create($validated);

        return redirect()->back()->with('success', 'تم نشر إعلان تبادل الأرض بنجاح!');
    }


    /**
     * Display a listing of land exchange ads.
     */
    public function index()
    {
        $ads = LandExchange::with('user')->latest()->paginate(10);
        $myOffers = LandExchange::where('user_id', auth()->id())->latest()->get();
        $useroffers = Offer::where('user_id', Auth::id())
            ->with('landExchange')
            ->latest()
            ->paginate(5);
        return view('land-exchange', compact('ads', 'myOffers', 'useroffers'));
    }

    /**
     * Show the form for creating a new land exchange ad.
     */
    public function create()
    {
        return view('land_exchange.create');
    }
    //edit
    public function edit($id)
    {
        $ad = LandExchange::findOrFail($id);
        return view('landexchange.edit', compact('ad'));
    }
    /**
     * Update the specified land exchange ad.
     */
    public function update(Request $request, $id)
    {
        $ad = LandExchange::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'current_location' => 'required|string|max:255',
            'desired_locations' => 'required|array|min:1',
            'desired_locations.*' => 'required|string|max:255',
            'current_area' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:2000',
            'image' => 'nullable|image|max:4096',
            'phone_number' => 'required|string|max:20',
            'price' => 'nullable|numeric|min:0',
            'for_sale' => 'nullable|boolean',
            'for_exchange' => 'nullable|boolean',
            'map_coordinates' => 'nullable|string|max:255'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($ad->image) {
                Storage::disk('public')->delete($ad->image);
            }
            $validated['image'] = $request->file('image')->store('land_exchange_images', 'public');
        }

        // Convert desired_locations array to JSON for storage
        $validated['desired_locations'] = json_encode($validated['desired_locations'], JSON_UNESCAPED_UNICODE);

        // Checkbox values
        $validated['for_sale'] = $request->has('for_sale') ? 1 : 0;
        $validated['for_exchange'] = $request->has('for_exchange') ? 1 : 0;

        $ad->update($validated);

        return redirect()->route('land.exchange.index')->with('success', 'تم تحديث إعلان تبادل الأرض بنجاح!');
    }
    //destroy
    public function destroy($id)
    {
        $ad = LandExchange::findOrFail($id);

        // Delete the image if it exists
        if ($ad->image) {
            Storage::disk('public')->delete($ad->image);
        }

        $ad->delete();

        return redirect()->route('land.exchange.index')->with('success', 'تم حذف إعلان تبادل الأرض بنجاح!');
    }

    // Compare this snippet from app/Models/LandExchange.php:
}