<?php

namespace App\Http\Controllers;

use App\Models\ProblemType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProblemTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:problemtype-list|problemtype-create|problemtype-edit|problemtype-delete', ['only' => ['index','show']]);
        $this->middleware('permission:problemtype-create', ['only' => ['create','store']]);
        $this->middleware('permission:problemtype-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:problemtype-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $types = ProblemType::latest()->paginate(10);

        return view('problemtypes.index', compact('types'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('problemtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:problem_types,name',
        ]);

        ProblemType::create([
            'name' => $request->name,
        ]);

        return redirect()->route('problem-types.index')
                         ->with('success', 'Problem Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $type = ProblemType::findOrFail($id);

        return view('problemtypes.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $type = ProblemType::findOrFail($id);

        return view('problemtypes.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:problem_types,name,' . $id,
        ]);

        $type = ProblemType::findOrFail($id);
        $type->update([
            'name' => $request->name,
        ]);

        return redirect()->route('problem-types.index')
                         ->with('success', 'Problem Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        ProblemType::findOrFail($id)->delete();

        return redirect()->route('problem-types.index')
                         ->with('success', 'Problem Type deleted successfully.');
    }
}
