@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold flex items-center gap-2 text-gray-800">
            <i class="fa-solid fa-ticket text-green-600"></i> Ticket Details ({{ $ticket->ticket_id }})
        </h2>

        <a href="{{ route('tickets.index') }}"
           class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow text-sm">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- CARD --}}
    <div class="bg-white shadow-lg rounded-xl p-6">

        {{-- Status --}}
        <div class="mb-4">
            <span class="font-semibold text-gray-700">Status:</span>
            <span class="px-3 py-1 rounded-lg text-xs font-semibold
                @if($ticket->status=='Pending') bg-yellow-100 text-yellow-700
                @elseif($ticket->status=='In Progress') bg-blue-100 text-blue-700
                @elseif($ticket->status=='Completed') bg-green-100 text-green-700
                @else bg-gray-300 text-gray-800 @endif">
                {{ $ticket->status }}
            </span>
        </div>

        {{-- Details Grid --}}
        <div class="grid sm:grid-cols-2 gap-6">

            {{-- Hotel --}}
            <div>
                <h4 class="font-semibold text-gray-700">Hotel / Branch</h4>
                <p class="text-gray-900">{{ $ticket->hotel->name }}</p>
            </div>

            {{-- Guest Name --}}
            <div>
                <h4 class="font-semibold text-gray-700">Guest Name</h4>
                <p>{{ $ticket->guest_name }}</p>
            </div>

            {{-- Guest Contact --}}
            <div>
                <h4 class="font-semibold text-gray-700">Guest Contact</h4>
                <p>{{ $ticket->guest_contact }}</p>
            </div>

            {{-- Room --}}
            <div>
                <h4 class="font-semibold text-gray-700">Room No</h4>
                <p>{{ $ticket->room_no }}</p>
            </div>

            {{-- Check-in --}}
            <div>
                <h4 class="font-semibold text-gray-700">Check-in Date</h4>
                <p>{{ $ticket->check_in_date }}</p>
            </div>

            {{-- Check-out --}}
            <div>
                <h4 class="font-semibold text-gray-700">Check-out Date</h4>
                <p>{{ $ticket->check_out_date }}</p>
            </div>

        </div>

        {{-- Problem Details --}}
        <div class="mt-6">
            <h4 class="font-semibold text-gray-700">Problem Description</h4>
            <p class="text-gray-800 mt-1">{{ $ticket->problem_description }}</p>
        </div>

        <div class="grid sm:grid-cols-3 gap-4 mt-6">
            <div>
                <h4 class="font-semibold text-gray-700">Problem Type</h4>
                <p>{{ $ticket->problemType->name }}</p>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700">Problem Area</h4>
                <p>{{ $ticket->problemArea->name }}</p>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700">Notification Source</h4>
                <p>{{ $ticket->notificationSource->name }}</p>
            </div>
        </div>

        {{-- Action Taken --}}
        <div class="mt-6">
            <h4 class="font-semibold text-gray-700">Action Taken</h4>
            <p>{{ $ticket->action_taken }}</p>
            <p class="text-gray-600 text-sm mt-1">Actioned At: {{ $ticket->actioned_at }}</p>
        </div>

        {{-- Follow-Up --}}
        <div class="mt-6">
            <h4 class="font-semibold text-gray-700">Follow-Up</h4>
            <p>{{ $ticket->follow_up }}</p>
            <p class="text-gray-600 text-sm mt-1">Followed Up At: {{ $ticket->followed_up_at }}</p>
        </div>

        {{-- Compensation --}}
        <div class="mt-6 grid sm:grid-cols-2 gap-4">
            <div>
                <h4 class="font-semibold text-gray-700">Compensation</h4>
                <p>{{ $ticket->compensation }}</p>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700">Amount</h4>
                <p>{{ $ticket->amount }}</p>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700">Compensation Given At</h4>
                <p>{{ $ticket->compensation_given_at }}</p>
            </div>
        </div>

        {{-- Updated By --}}
        <div class="mt-8 text-gray-600 text-sm">
            Last updated by:
            <span class="font-semibold text-gray-800">
                {{ $ticket->updatedByUser->name ?? 'System' }}
            </span>
        </div>

    </div>

</div>
@endsection
