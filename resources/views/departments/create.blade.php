@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold flex items-center gap-2 text-gray-800">
            <i class="fa-solid fa-building text-teal-600"></i> Add New Department
        </h2>
        <a href="{{ route('departments.index') }}"
           class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow">
           <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
            <strong>Error!</strong> Fix the following:
            <ul class="list-disc ml-6 mt-2">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <div class="bg-white shadow-lg rounded-xl p-6">
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf

{{-- HOTEL --}}
<div class="mb-4">
    <label class="font-semibold text-gray-700 dark:text-gray-300">Select Hotel</label>
    <select name="hotel_id"
            class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 dark:text-white border"
            required>
        <option value="">-- Select Hotel --</option>
        @foreach ($hotels as $hotel)
            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
        @endforeach
    </select>
</div>


            {{-- Name --}}
            <div class="mb-4">
                <label class="font-semibold">Department Name</label>
                <input type="text" name="name"
                       class="w-full mt-1 px-4 py-2 bg-gray-100 border rounded-lg">
            </div>

            {{-- Head Email --}}
            <div class="mb-4">
                <label class="font-semibold">Head Email</label>
                <input type="email" name="head_email"
                       class="w-full mt-1 px-4 py-2 bg-gray-100 border rounded-lg">
            </div>

            <button class="px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white rounded-lg shadow">
                Create Department
            </button>

        </form>
    </div>

</div>
@endsection
