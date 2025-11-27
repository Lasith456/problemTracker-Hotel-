@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex gap-2">
            <i class="fa-solid fa-ticket text-blue-600"></i> Problem Tickets
        </h2>

        @can('ticket-create')
        <a href="{{ route('tickets.create') }}"
           class="mt-3 sm:mt-0 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg shadow">
            <i class="fa fa-plus"></i> Add Ticket
        </a>
        @endcan
    </div>

    {{-- Success --}}
    @if (session('success'))
        <div class="mb-5 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
{{-- FILTERS --}}
<form method="GET" action="{{ route('tickets.index') }}" class="mb-6 bg-white p-4 rounded-xl shadow flex flex-wrap gap-4">

    {{-- Ticket ID --}}
    <div class="w-full sm:w-1/4">
        <label class="text-sm font-semibold text-gray-700">Ticket ID</label>
        <input type="text" name="ticket_id" value="{{ request('ticket_id') }}"
               class="w-full mt-1 p-2 border rounded-lg" placeholder="Search by ID">
    </div>

    {{-- Hotel --}}
    <div class="w-full sm:w-1/4">
        <label class="text-sm font-semibold text-gray-700">Hotel</label>
        <select name="hotel_id" class="w-full mt-1 p-2 border rounded-lg">
            <option value="">All Hotels</option>
            @foreach ($hotels as $hotel)
                <option value="{{ $hotel->id }}" {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                    {{ $hotel->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Problem Type --}}
    <div class="w-full sm:w-1/4">
        <label class="text-sm font-semibold text-gray-700">Problem Type</label>
        <select name="problem_type_id" class="w-full mt-1 p-2 border rounded-lg">
            <option value="">All Types</option>
            @foreach ($problemTypes as $type)
                <option value="{{ $type->id }}" {{ request('problem_type_id') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Status --}}
    <div class="w-full sm:w-1/4">
        <label class="text-sm font-semibold text-gray-700">Status</label>
        <select name="status" class="w-full mt-1 p-2 border rounded-lg">
            <option value="">All Status</option>
            <option value="Pending" {{ request('status')=='Pending' ? 'selected' : '' }}>Pending</option>
            <option value="In Progress" {{ request('status')=='In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Completed" {{ request('status')=='Completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>

    {{-- Buttons --}}
    <div class="w-full flex gap-3 pt-3">
        <button type="submit"
            class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Apply Filter
        </button>

        <a href="{{ route('tickets.index') }}"
           class="px-5 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
            Clear
        </a>
    </div>

</form>

    {{-- Table --}}
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border">
        <table class="min-w-full">
            <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Hotel</th>
                    <th class="px-6 py-3 text-left">Problem Type</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y text-gray-700">
                @foreach ($tickets as $ticket)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-6 py-3 font-semibold">{{ $ticket->ticket_id }}</td>
                    <td class="px-6 py-3">{{ $ticket->hotel->name }}</td>
                    <td class="px-6 py-3">{{ $ticket->problemType->name }}</td>

                    <td class="px-6 py-3">
                        <span class="px-3 py-1 text-xs rounded-lg font-semibold
                            @if($ticket->status=='Pending') bg-yellow-100 text-yellow-700 border-yellow-300
                            @elseif($ticket->status=='In Progress') bg-blue-100 text-blue-700 border-blue-300
                            @elseif($ticket->status=='Completed') bg-green-100 text-green-700 border-green-300
                            @else bg-gray-200 text-gray-700 border-gray-300 @endif
                        ">
                            {{ $ticket->status }}
                        </span>
                    </td>

                    <td class="px-6 py-3 text-center space-x-2">
                        <a href="{{ route('tickets.show', $ticket->id) }}"
                           class="px-3 py-1 text-xs bg-blue-500 text-white rounded-md hover:bg-blue-600">
                           Show
                        </a>
                        @can('ticket-edit')
                        <a href="{{ route('tickets.edit', $ticket->id) }}"
                           class="px-3 py-1 text-xs bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                           Edit
                        </a>
                        @endcan
                        @can('ticket-delete')
                        <form method="POST" action="{{ route('tickets.destroy', $ticket->id) }}" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this ticket?')"
                                class="px-3 py-1 text-xs bg-red-600 text-white rounded-md hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach

                @if ($tickets->isEmpty())
                <tr>
                    <td colspan="5" class="py-6 text-center text-gray-500">No tickets found.</td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {!! $tickets->links('pagination::bootstrap-5') !!}
    </div>

</div>
@endsection
