@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-ticket text-yellow-600"></i> Edit Ticket ({{ $ticket->ticket_id }})
        </h2>
        <a href="{{ route('tickets.index') }}"
           class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg shadow">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- ERRORS --}}
    @if ($errors->any())
    <div class="mb-5 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
        <strong>Error!</strong> Fix the issues:
        <ul class="list-disc ml-6 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- FORM --}}
    <div class="bg-white shadow-lg rounded-xl p-6">
        <form method="POST" action="{{ route('tickets.update', $ticket->id) }}">
            @csrf
            @method('PUT')

            {{-- STATUS --}}
            <div class="mb-4">
                <label class="font-semibold">Status</label>
                <select name="status" class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                    <option {{ $ticket->status=='Pending' ? 'selected' : '' }}>Pending</option>
                    <option {{ $ticket->status=='In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option {{ $ticket->status=='Completed' ? 'selected' : '' }}>Completed</option>
                    <option {{ $ticket->status=='Closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            {{-- HOTEL --}}
            <div class="mb-4">
                <label class="font-semibold">Hotel / Branch</label>
                <select name="hotel_id" class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}" {{ $hotel->id == $ticket->hotel_id ? 'selected' : '' }}>
                            {{ $hotel->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- DEPARTMENT --}}
            <div class="mb-4">
                <label class="font-semibold">Department</label>
                <select name="department_id" class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ $department->id == $ticket->department_id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- GUEST DETAILS --}}
            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-semibold">Guest Name</label>
                    <input type="text" name="guest_name" value="{{ $ticket->guest_name }}"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>

                <div>
                    <label class="font-semibold">Guest Contact</label>
                    <input type="text" name="guest_contact" value="{{ $ticket->guest_contact }}"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>
            </div>

            {{-- ROOM --}}
            <div class="grid sm:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="font-semibold">Room No</label>
                    <input type="text" name="room_no" value="{{ $ticket->room_no }}"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>

                <div>
                    <label class="font-semibold">Check-in Date</label>
                    <input type="date" name="check_in_date" value="{{ $ticket->check_in_date }}"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>

                <div>
                    <label class="font-semibold">Check-out Date</label>
                    <input type="date" name="check_out_date" value="{{ $ticket->check_out_date }}"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>
            </div>

            {{-- PROBLEM DESCRIPTION --}}
            <div class="mb-4">
                <label class="font-semibold">Problem Description</label>
                <textarea name="problem_description"
                          class="w-full mt-1 px-4 py-2 h-28 rounded-lg bg-gray-100 border">{{ $ticket->problem_description }}</textarea>
            </div>

            {{-- TYPE / AREA / SOURCE --}}
            <div class="grid sm:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="font-semibold">Problem Type</label>
                    <select name="problem_type_id"
                        class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                        @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == $ticket->problem_type_id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="font-semibold">Problem Area</label>
                    <select name="problem_area_id"
                        class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ $area->id == $ticket->problem_area_id ? 'selected' : '' }}>
                            {{ $area->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="font-semibold">Notification Source</label>
                    <select name="notification_source_id"
                        class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                        @foreach ($sources as $source)
                        <option value="{{ $source->id }}" {{ $source->id == $ticket->notification_source_id ? 'selected' : '' }}>
                            {{ $source->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="mb-4">
                <label class="font-semibold">Action Taken</label>
                <textarea name="action_taken"
                          class="w-full mt-1 px-4 py-2 h-24 rounded-lg bg-gray-100 border">{{ $ticket->action_taken }}</textarea>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-semibold">Actioned At</label>
                    <input type="datetime-local" name="actioned_at" value="{{ $ticket->actioned_at }}"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>

                <div>
                    <label class="font-semibold">Follow-up At</label>
                    <input type="datetime-local" name="followed_up_at" value="{{ $ticket->followed_up_at }}"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>
            </div>

            {{-- FOLLOW UP --}}
            <div class="mb-4">
                <label class="font-semibold">Follow Up</label>
                <textarea name="follow_up"
                          class="w-full mt-1 px-4 py-2 h-24 rounded-lg bg-gray-100 border">{{ $ticket->follow_up }}</textarea>
            </div>

            {{-- COMPENSATION --}}
            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-semibold">Compensation</label>
                    <input type="text" name="compensation" value="{{ $ticket->compensation }}"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>

                <div>
                    <label class="font-semibold">Amount</label>
                    <input type="number" step="0.01" name="amount" value="{{ $ticket->amount }}"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>
            </div>

            <div class="mb-6">
                <label class="font-semibold">Compensation Given At</label>
                <input type="datetime-local" name="compensation_given_at" value="{{ $ticket->compensation_given_at }}"
                       class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow">
                Update Ticket
            </button>
        </form>
    </div>

</div>
@endsection
