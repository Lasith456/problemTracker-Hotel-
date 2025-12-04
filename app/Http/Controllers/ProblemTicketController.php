<?php

namespace App\Http\Controllers;

use App\Models\ProblemTicket;
use App\Models\Hotel;
use App\Models\ProblemType;
use App\Models\ProblemArea;
use App\Models\NotificationSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\TicketCreatedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Department;

class ProblemTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ticket-list|ticket-create|ticket-edit|ticket-delete', ['only' => ['index','show']]);
        $this->middleware('permission:ticket-create', ['only' => ['create','store']]);
        $this->middleware('permission:ticket-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ticket-delete', ['only' => ['destroy']]);
    }

    /** List all tickets */
public function index(Request $request)
{
    // Fetch filter values
    $status      = $request->status;
    $ticket_id   = $request->ticket_id;
    $hotel_id    = $request->hotel_id;
    $type_id     = $request->problem_type_id;

    // Query builder
    $query = ProblemTicket::with(['hotel','problemType']);

    // Apply filters
    if (!empty($ticket_id)) {
        $query->where('ticket_id', 'LIKE', "%$ticket_id%");
    }

    if (!empty($status)) {
        $query->where('status', $status);
    }

    if (!empty($hotel_id)) {
        $query->where('hotel_id', $hotel_id);
    }

    if (!empty($type_id)) {
        $query->where('problem_type_id', $type_id);
    }
    if (!empty($request->department_id)) {
        $query->where('department_id', $request->department_id);
    }

    // Paginate
    $tickets = $query->latest()->paginate(10);

    // Pass dropdown data
    $hotels = Hotel::all();
    $problemTypes = ProblemType::all();
    $departments = Department::all();

    return view('tickets.index', compact('tickets','hotels','problemTypes','departments'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
}


    /** Show Create Form */
    public function create()
    {
        return view('tickets.create', [
            'hotels' => Hotel::all(),
            'types' => ProblemType::all(),
            'areas' => ProblemArea::all(),
            'sources' => NotificationSource::all(),
            'departments' => Department::all(),

        ]);
    }

    /** Store Ticket */
public function store(Request $request)
{
    $request->validate([
        'hotel_id' => 'required',
        'problem_type_id' => 'required',
        'department_id' => 'required',
        'problem_area_id' => 'required',
        'notification_source_id' => 'required',
        'problem_description' => 'required',
    ]);

    // Create Ticket
    $ticket = ProblemTicket::create([
        'ticket_id' => 'TIC-' . str_pad(ProblemTicket::count() + 1, 5, '0', STR_PAD_LEFT),
        'status' => 'Pending',
        'hotel_id' => $request->hotel_id,
        'department_id' => $request->department_id,
        'guest_name' => $request->guest_name,
        'guest_contact' => $request->guest_contact,
        'room_no' => $request->room_no,
        'check_in_date' => $request->check_in_date,
        'check_out_date' => $request->check_out_date,
        'problem_description' => $request->problem_description,
        'problem_type_id' => $request->problem_type_id,
        'problem_area_id' => $request->problem_area_id,
        'notification_source_id' => $request->notification_source_id,
        'action_taken' => $request->action_taken,
        'actioned_at' => $request->actioned_at,
        'follow_up' => $request->follow_up,
        'followed_up_at' => $request->followed_up_at,
        'compensation' => $request->compensation,
        'amount' => $request->amount,
        'compensation_given_at' => $request->compensation_given_at,
        'updated_by' => Auth::id(),
    ]);

    // Load relationships before email
    $ticket->load(['hotel', 'problemType', 'problemArea', 'notificationSource', 'department']);

    // Send email (safe handling)
    if ($ticket->department && $ticket->department->head_email) {
        try {
            Mail::to($ticket->department->head_email)->send(new TicketCreatedMail($ticket));
        } catch (\Exception $e) {
            // Log silently, but DO NOT break the process
            \Log::error('Ticket Email Failed: ' . $e->getMessage());
        }
    }

    return redirect()
        ->route('tickets.index')
        ->with('success', 'Ticket created successfully!');
}




    /** Show a single ticket */
    public function show($id)
    {
        $ticket = ProblemTicket::with(['hotel','problemType','problemArea','notificationSource','updatedByUser'])->findOrFail($id);

        return view('tickets.show', compact('ticket'));
    }

    /** Edit form */
    public function edit($id)
    {
        $ticket = ProblemTicket::findOrFail($id);
        
        return view('tickets.edit', [
            'ticket' => $ticket,
            'hotels' => Hotel::all(),
            'types' => ProblemType::all(),
            'areas' => ProblemArea::all(),
            'sources' => NotificationSource::all(),
            'departments' => Department::all(),
        ]);
    }

    /** Update ticket */
    public function update(Request $request, $id)
    {
        $ticket = ProblemTicket::findOrFail($id);

        $ticket->update([
            'status' => $request->status,
            'hotel_id' => $request->hotel_id,
            'department_id' => $request->department_id,
            'guest_name' => $request->guest_name,
            'guest_contact' => $request->guest_contact,
            'room_no' => $request->room_no,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,

            'problem_description' => $request->problem_description,
            'problem_type_id' => $request->problem_type_id,
            'problem_area_id' => $request->problem_area_id,
            'notification_source_id' => $request->notification_source_id,

            'action_taken' => $request->action_taken,
            'actioned_at' => $request->actioned_at,

            'follow_up' => $request->follow_up,
            'followed_up_at' => $request->followed_up_at,

            'compensation' => $request->compensation,
            'amount' => $request->amount,
            'compensation_given_at' => $request->compensation_given_at,

            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully!');
    }

    /** Delete */
    public function destroy($id)
    {
        ProblemTicket::findOrFail($id)->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully!');
    }
}
