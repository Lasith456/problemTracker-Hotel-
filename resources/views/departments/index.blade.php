@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-building text-teal-500"></i> Departments
        </h2>

        @can('department-create')
        <a href="{{ route('departments.create') }}"
           class="mt-3 sm:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-teal-600 hover:bg-teal-700 
                  text-white text-sm font-semibold rounded-lg shadow-md transition transform hover:-translate-y-0.5">
            <i class="fa fa-plus"></i> Add New Department
        </a>
        @endcan
    </div>


    {{-- FILTER SECTION --}}
    <form method="GET" action="{{ route('departments.index') }}"
          class="bg-white dark:bg-gray-800 p-4 mb-6 rounded-xl shadow flex flex-wrap gap-4">

        {{-- Hotel Filter --}}
        <div class="w-full sm:w-1/3">
            <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Filter by Hotel / Branch</label>
            <select name="hotel_id"
                    class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white">

                <option value="">-- All Hotels --</option>

                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}"
                        {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                        {{ $hotel->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Buttons --}}
        <div class="w-full sm:w-auto flex items-end gap-3">
            <button type="submit"
                    class="px-5 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                Apply Filter
            </button>

            <a href="{{ route('departments.index') }}"
               class="px-5 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 text-gray-800">
                Clear
            </a>
        </div>

    </form>

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
                        <th class="px-6 py-3 text-left font-semibold">Department Name</th>
                        <th class="px-6 py-3 text-left font-semibold">Hotel / Branch</th>
                        <th class="px-6 py-3 text-left font-semibold">Head Email</th>
                        <th class="px-6 py-3 text-center font-semibold w-56">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm text-gray-700 dark:text-gray-300">

                    @foreach ($departments as $department)
                        <tr class="hover:bg-teal-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-3">{{ ++$i }}</td>
                            <td class="px-6 py-3 font-semibold">{{ $department->name }}</td>

                            <td class="px-6 py-3">
                                {{ $department->hotel->name ?? '— Not Assigned —' }}
                            </td>

                            <td class="px-6 py-3">{{ $department->head_email }}</td>

                            <td class="px-6 py-3 text-center space-x-1">
                                <a href="{{ route('departments.show', $department->id) }}"
                                   class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 
                                          text-white text-xs font-semibold px-3 py-1.5 rounded-md transition">
                                    <i class="fa-solid fa-list"></i> Show
                                </a>

                                @can('department-edit')
                                <a href="{{ route('departments.edit', $department->id) }}"
                                   class="inline-flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 
                                          text-white text-xs font-semibold px-3 py-1.5 rounded-md transition">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                @endcan

                                @can('department-delete')
                                <form action="{{ route('departments.destroy', $department->id) }}"
                                      method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this department?')">
                                    @csrf @method('DELETE')
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

                    @if ($departments->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500 dark:text-gray-400">
                                No departments found.
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-5">
        {{ $departments->links('vendor.pagination.tailwind') }}
    </div>

    <p class="text-center text-gray-500 dark:text-gray-400 text-sm mt-6">
        Powered By <span class="font-semibold text-teal-500">NavicodesItSolutions</span>
    </p>

</div>
@endsection
