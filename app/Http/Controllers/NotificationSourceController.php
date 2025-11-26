<?php

namespace App\Http\Controllers;

use App\Models\NotificationSource;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NotificationSourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:notificationsource-list|notificationsource-create|notificationsource-edit|notificationsource-delete', ['only' => ['index','show']]);
        $this->middleware('permission:notificationsource-create', ['only' => ['create','store']]);
        $this->middleware('permission:notificationsource-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:notificationsource-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sources = NotificationSource::latest()->paginate(10);

        return view('notificationsources.index', compact('sources'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('notificationsources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:notification_sources,name',
        ]);

        NotificationSource::create([
            'name' => $request->name,
        ]);

        return redirect()->route('notification-sources.index')
                         ->with('success', 'Notification Source created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $source = NotificationSource::findOrFail($id);

        return view('notificationsources.show', compact('source'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $source = NotificationSource::findOrFail($id);

        return view('notificationsources.edit', compact('source'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:notification_sources,name,' . $id,
        ]);

        $source = NotificationSource::findOrFail($id);
        $source->update([
            'name' => $request->name,
        ]);

        return redirect()->route('notification-sources.index')
                         ->with('success', 'Notification Source updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        NotificationSource::findOrFail($id)->delete();

        return redirect()->route('notification-sources.index')
                         ->with('success', 'Notification Source deleted successfully.');
    }
}
