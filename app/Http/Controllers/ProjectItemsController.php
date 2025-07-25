<?php

namespace App\Http\Controllers;

use App\Models\ProjectItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectItemsController extends Controller
{
    //index
    public function cost()
    {
        return view('estimate-projects.estimate-cost');
    }
    public function index()
    {
        $projects = ProjectItems::with('user')->orderBy('id', 'desc')->latest()->paginate(10);
        // dd($projects);
        return view('project.multi-project', compact('projects'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'land_area' => 'required|numeric|min:1',
            'design' => 'required|string|max:255',
            'finishing' => 'required|string|max:255',
            'shape' => 'required|string|max:255',
            'floors' => 'nullable|integer|min:1',
            'bedrooms' => 'nullable|integer|min:0',
            'living_rooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'kitchens' => 'nullable|integer|min:0',
            'annexes' => 'nullable|integer|min:0',
            'parking' => 'nullable|integer|min:0',
            'required_area' => 'nullable|numeric|min:0',
            'terms' => 'required|boolean',
            'contact' => 'nullable|boolean',
            'estimate' => 'nullable|numeric|min:0',
        ]);

        // Set user_id after validation
        $validated['user_id'] = Auth::id();

        ProjectItems::create($validated);

        return redirect()->back()->with('success', 'تم حفظ تقدير المشروع بنجاح!');
    }
    public function show($id)
    {
        $estimates = ProjectItems::where('user_id', Auth::id())->latest()->paginate(10);
        return view('estimate-projects.show', compact('estimates'));
    }
    public function destroy($id)
{
    $project = ProjectItems::findOrFail($id);

    // تحقق إن المستخدم هو صاحب المشروع
    if (auth()->id() !== $project->user_id) {
        abort(403, 'غير مصرح لك بحذف هذا المشروع');
    }

    $project->delete();

    return redirect()->route('projects.index')->with('success', 'تم حذف المشروع بنجاح.');
}
public function showSingleProject($id)
{
    $project = ProjectItems::with('user')->findOrFail($id);
    return view('consultant.projects.show', compact('project'));
}

}
