<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:hotel-list|hotel-create|hotel-edit|hotel-delete', ['only' => ['index','show']]);
        $this->middleware('permission:hotel-create', ['only' => ['create','store']]);
        $this->middleware('permission:hotel-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:hotel-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $hotels = Hotel::latest()->paginate(10);
        return view('hotels.index', compact('hotels'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view('hotels.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:hotels,name',
            'branch_code' => 'nullable',
            'address' => 'nullable',
        ]);

        Hotel::create($request->only('name', 'branch_code', 'address'));

        return redirect()->route('hotels.index')
                         ->with('success', 'Hotel/Branch created successfully.');
    }

    public function show(string $id): View
    {
        $hotel = Hotel::findOrFail($id);
        return view('hotels.show', compact('hotel'));
    }

    public function edit(string $id): View
    {
        $hotel = Hotel::findOrFail($id);
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:hotels,name,' . $id,
            'branch_code' => 'nullable',
            'address' => 'nullable',
        ]);

        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->only('name', 'branch_code', 'address'));

        return redirect()->route('hotels.index')
                         ->with('success', 'Hotel/Branch updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Hotel::findOrFail($id)->delete();

        return redirect()->route('hotels.index')
                         ->with('success', 'Hotel/Branch deleted successfully.');
    }
}
