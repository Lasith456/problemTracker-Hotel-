@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-building text-teal-500"></i> Add New Department
        </h2>
        <a href="{{ route('departments.index') }}"
           class="mt-3 sm:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-gray-600 hover:bg-gray-700
                  text-white text-sm font-semibold rounded-lg shadow transition transform hover:-translate-y-0.5">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <strong>Error!</strong> Fix the following issues:
            <ul class="list-disc ml-6 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label class="font-semibold text-gray-700 dark:text-gray-300">Department Name</label>
                <input type="text" name="name"
                       class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white border"
                       placeholder="Enter department name">
            </div>

            {{-- Head Email --}}
            <div class="mb-4">
                <label class="font-semibold text-gray-700 dark:text-gray-300">Head Email</label>
                <input type="email" name="head_email"
                       class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white border"
                       placeholder="Enter department head email">
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-lg shadow transition transform hover:-translate-y-0.5">
                Create Department
            </button>

        </form>
    </div>

</div>
@endsection
