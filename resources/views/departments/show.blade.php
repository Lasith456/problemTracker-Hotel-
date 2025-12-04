@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-building text-teal-500"></i> Department Details
        </h2>

        <a href="{{ route('departments.index') }}"
           class="mt-3 sm:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-gray-600 hover:bg-gray-700
                  text-white text-sm font-semibold rounded-lg shadow transition transform hover:-translate-y-0.5">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- Card --}}
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">

        <div class="space-y-4">

            <div>
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Department Name</h4>
                <p class="text-gray-900 dark:text-gray-100">{{ $department->name }}</p>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700 dark:text-gray-300">Head Email</h4>
                <p class="text-gray-900 dark:text-gray-100">{{ $department->head_email }}</p>
            </div>

            <div class="pt-4 text-sm text-gray-600 dark:text-gray-400">
                Created At: {{ $department->created_at->format('Y-m-d') }} <br>
                Last Updated: {{ $department->updated_at->format('Y-m-d') }}
            </div>

        </div>

    </div>

</div>
@endsection
