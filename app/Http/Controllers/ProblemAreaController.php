<?php

namespace App\Http\Controllers;

use App\Models\ProblemArea;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProblemAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:problemarea-list|problemarea-create|problemarea-edit|problemarea-delete', ['only' => ['index','show']]);
        $this->middleware('permission:problemarea-create', ['only' => ['create','store']]);
        $this->middleware('permission:problemarea-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:problemarea-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $areas = ProblemArea::latest()->paginate(10);

        return view('problemareas.index', compact('areas'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('problemareas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:problem_areas,name',
        ]);

        ProblemArea::create([
            'name' => $request->name,
        ]);

        return redirect()->route('problem-areas.index')
                         ->with('success', 'Problem Area created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $area = ProblemArea::findOrFail($id);

        return view('problemareas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $area = ProblemArea::findOrFail($id);

        return view('problemareas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:problem_areas,name,' . $id,
        ]);

        $area = ProblemArea::findOrFail($id);
        $area->update([
            'name' => $request->name,
        ]);

        return redirect()->route('problem-areas.index')
                         ->with('success', 'Problem Area updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        ProblemArea::findOrFail($id)->delete();

        return redirect()->route('problem-areas.index')
                         ->with('success', 'Problem Area deleted successfully.');
    }
}
