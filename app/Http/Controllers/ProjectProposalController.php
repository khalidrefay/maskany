<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectProposal;
use Illuminate\Support\Facades\Auth;

class ProjectProposalController extends Controller
{
    public function store(Request $request, $projectId)
    {
        // تحقق من رفع الملفات
        if ($request->hasFile('design_files')) {
            foreach ($request->file('design_files') as $file) {
                $path = $file->store('designs', 'public');

                ProjectProposal::create([
                    'project_id' => $projectId,
                    'consultant_id' => Auth::id(),
                    'design_plans' => json_encode([$path]),
                ]);
            }
        }

        return redirect()->back()->with('success', 'تم إرسال التخطيط بنجاح.');
    }
    public function destroy(Proposal $proposal)
{
    if ($proposal->consultant_id != auth()->id()) {
        abort(403);
    }

    $proposal->delete();

    return response()->json(['success' => true]);
}

public function submitProposal(Request $request, $project_id)
    {
        $validated = $request->validate([
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'notes' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5120',
            'project_id' => 'required|exists:projects,id', // تأكد من وجود project_id
            'contractor_id' => 'nullable|exists:users,id', // Optional
        ]);

        try {
            $proposal = new ProjectProposal();
            $proposal->project_id = $project_id;
            $proposal->consultant_id = auth()->id(); // أو contractor_id لو عايز
            $proposal->contractor_id = $validated['contractor_id'] ?? auth()->id();
            $proposal->price = $validated['price'];
            $proposal->duration = $validated['duration'];
            $proposal->notes = $validated['notes'];
            $proposal->design_plans = $request->file('pdf_file') ? $request->file('pdf_file')->store('proposals/design-plans', 'public') : null;
            $proposal->materials_list = null; // يمكن تضيف حقل تاني لو عايز
            $proposal->status = 'pending';
            $proposal->save();

            return response()->json([
                'success' => true,
                'redirect' => route('contractor.offers.list')
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving proposal: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'فشل في حفظ العرض، حاول مرة أخرى: ' . $e->getMessage()
            ], 400);
        }
    }
}
