@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-building text-blue-600"></i> Department Details
        </h2>

        <a href="{{ route('departments.index') }}"
            class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl p-6">

        <div class="mb-4">
            <h4 class="font-semibold text-gray-700">Department Name</h4>
            <p class="text-gray-900">{{ $department->name }}</p>
        </div>

        <div class="mb-4">
            <h4 class="font-semibold text-gray-700">Hotel</h4>
            <p class="text-gray-900">{{ $department->hotel->name ?? 'N/A' }}</p>
        </div>

        <div class="mb-4">
            <h4 class="font-semibold text-gray-700">Head Email</h4>
            <p class="text-gray-900">{{ $department->head_email ?? '-' }}</p>
        </div>

        <div class="text-sm text-gray-600 mt-6">
            Created At: {{ $department->created_at }} <br>
            Updated At: {{ $department->updated_at }}
        </div>

    </div>

</div>
@endsection
