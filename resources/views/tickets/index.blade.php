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
