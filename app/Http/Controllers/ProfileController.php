<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate common fields
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image) {
                Storage::delete($user->image);
            }

            // Store new image
            $path = $request->file('image')->store('profile-pictures', 'public');
            $validated['image'] = $path;
        }

        // Update user information
        $user->update($validated);

        // Handle role-specific fields
        if ($user->role === 'consultant') {
            $request->validate([
                'specialization' => 'required|string|max:255',
                'experience' => 'required|integer|min:0',
            ]);

            $user->consultantProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'specialization' => $request->specialization,
                    'experience' => $request->experience,
                ]
            );
        }

        if ($user->role === 'contractor') {
            $request->validate([
                'company_name' => 'required|string|max:255',
                'license_number' => 'required|string|max:255',
            ]);

            $user->contractorProfile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'company_name' => $request->company_name,
                    'license_number' => $request->license_number,
                ]
            );
        }

        return redirect()->back()->with('success', __('messages.profile.profile_updated'));
    }
}