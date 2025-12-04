<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Hotel;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:department-list|department-create|department-edit|department-delete', ['only' => ['index','show']]);
        $this->middleware('permission:department-create', ['only' => ['create','store']]);
        $this->middleware('permission:department-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:department-delete', ['only' => ['destroy']]);
    }

    /** LIST **/
    public function index(Request $request)
    {
        $hotel_id = $request->hotel_id;

        $departments = Department::with('hotel')
            ->when($hotel_id, function ($query) use ($hotel_id) {
                $query->where('hotel_id', $hotel_id);
            })
            ->latest()
            ->paginate(10);

        $hotels = \App\Models\Hotel::all();

        return view('departments.index', compact('departments', 'hotels'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }


    /** CREATE FORM **/
    public function create()
    {
        return view('departments.create', [
            'hotels' => Hotel::all()  // hotel dropdown
        ]);
    }

    /** STORE **/
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required',
            'head_email' => 'nullable|email',
        ]);

        Department::create([
            'hotel_id' => $request->hotel_id,
            'name' => $request->name,
            'head_email' => $request->head_email,
        ]);

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    /** SHOW **/
    public function show($id)
    {
        return view('departments.show', [
            'department' => Department::with('hotel')->findOrFail($id),
        ]);
    }

    /** EDIT FORM **/
    public function edit($id)
    {
        return view('departments.edit', [
            'department' => Department::findOrFail($id),
            'hotels' => Hotel::all(),
        ]);
    }

    /** UPDATE **/
    public function update(Request $request, $id)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'name' => 'required',
            'head_email' => 'nullable|email',
        ]);

        $department = Department::findOrFail($id);

        $department->update([
            'hotel_id' => $request->hotel_id,
            'name' => $request->name,
            'head_email' => $request->head_email,
        ]);

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    /** DELETE **/
    public function destroy($id)
    {
        Department::findOrFail($id)->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
