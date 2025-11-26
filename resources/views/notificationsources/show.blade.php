@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-eye text-blue-600"></i> Notification Source Details
        </h2>

        <a href="{{ route('notification-sources.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 hover:bg-gray-700 
                  text-white text-sm font-semibold rounded-lg shadow-md transition">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- Details Card --}}
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-700">

        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-1">Name</h3>
            <p class="text-gray-900 dark:text-gray-300 text-md font-medium">
                {{ $source->name }}
            </p>
        </div>

    </div>

    {{-- Footer --}}
    <p class="text-center text-gray-500 dark:text-gray-400 text-sm mt-6">
        Powered By <span class="font-semibold text-blue-600">NavicodesItSolutions</span>
    </p>

</div>
@endsection
