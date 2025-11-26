@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-bell text-blue-600"></i> Notification Sources
        </h2>

        @can('notificationsource-create')
        <a href="{{ route('notification-sources.create') }}"
           class="mt-3 sm:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 
                  text-white text-sm font-semibold rounded-lg shadow-md transition transform hover:-translate-y-0.5">
            <i class="fa fa-plus"></i> Add New Notification Source
        </a>
        @endcan
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-5 p-4 rounded-lg bg-green-100 border border-green-300 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">No</th>
                        <th class="px-6 py-3 text-left font-semibold">Name</th>
                        <th class="px-6 py-3 text-center font-semibold w-48">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm text-gray-700 dark:text-gray-300">

                    @foreach ($sources as $source)
                        <tr class="hover:bg-blue-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-3">{{ ++$i }}</td>

                            <td class="px-6 py-3 font-semibold">{{ $source->name }}</td>

                            <td class="px-6 py-3 text-center space-x-1">

                                {{-- Show --}}
                                <a href="{{ route('notification-sources.show', $source->id) }}"
                                   class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 
                                          text-white text-xs font-semibold px-3 py-1.5 rounded-md transition">
                                    <i class="fa-solid fa-list"></i> Show
                                </a>

                                {{-- Edit --}}
                                @can('notificationsource-edit')
                                <a href="{{ route('notification-sources.edit', $source->id) }}"
                                   class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 
                                          text-white text-xs font-semibold px-3 py-1.5 rounded-md transition">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                @endcan

                                {{-- Delete --}}
                                @can('notificationsource-delete')
                                <form action="{{ route('notification-sources.destroy', $source->id) }}"
                                      method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this notification source?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 
                                               text-white text-xs font-semibold px-3 py-1.5 rounded-md transition">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach

                    {{-- No Data --}}
                    @if ($sources->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center py-6 text-gray-500 dark:text-gray-400">
                                No notification sources found.
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-5">
        {!! $sources->links('pagination::bootstrap-5') !!}
    </div>

    {{-- Footer --}}
    <p class="text-center text-gray-500 dark:text-gray-400 text-sm mt-6">
        Powered By <span class="font-semibold text-blue-600">NavicodesItSolutions</span>
    </p>

</div>
@endsection
