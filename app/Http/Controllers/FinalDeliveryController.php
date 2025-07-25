<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class FinalDeliveryController extends Controller
{
    public function showForm(Project $project)
    {
        return view('consultant.final_delivery', compact('project'));
    }

    public function submit(Request $request, Project $project)
    {
        $request->validate([
            'delivery_files.*' => 'required|file|max:2048|mimes:pdf,jpg,jpeg,png,zip',
            'notes' => 'nullable|string|max:2000',
        ]);

        // تخزين الملفات (كمثال)
        foreach ($request->file('delivery_files', []) as $file) {
            $file->store('final_deliveries');
        }

        // حفظ بيانات التسليم (لو في جدول معين)

        return redirect()->route('consultant.projects')->with('success', 'تم تسليم المشروع بنجاح');
    }
}
