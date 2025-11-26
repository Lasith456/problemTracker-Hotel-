@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
            <i class="fa-solid fa-pen-to-square text-blue-600"></i> Edit Problem Type
        </h2>

        <a href="{{ route('problem-types.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 hover:bg-gray-700 
                  text-white text-sm font-semibold rounded-lg shadow-md transition">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- Error Message --}}
    @if($errors->any())
        <div class="mb-5 p-4 rounded-lg bg-red-100 border border-red-300 text-red-800 text-sm">
            <strong>Whoops!</strong> Something went wrong.
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-red-700">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-700">

        <form method="POST" action="{{ route('problem-types.update', $type->id) }}">
            @csrf
            @method('PUT')

            {{-- Input --}}
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                    Problem Type Name
                </label>

                <input type="text" name="name" 
                       value="{{ $type->name }}"
                       placeholder="Enter problem type name"
                       class="w-full px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 
                              border border-gray-300 dark:border-gray-600 text-gray-700 
                              dark:text-gray-200 focus:ring-2 focus:ring-blue-500 
                              focus:outline-none">
            </div>

            {{-- Update Button --}}
            <button type="submit"
                class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 hover:bg-blue-700 
                       text-white text-sm font-semibold rounded-lg shadow-md transition 
                       transform hover:-translate-y-0.5">
                <i class="fa-solid fa-floppy-disk"></i> Update
            </button>
        </form>

    </div>

    {{-- Footer --}}
    <p class="text-center text-gray-500 dark:text-gray-400 text-sm mt-6">
        Powered By <span class="font-semibold text-blue-600">NavicodesItSolutions</span>
    </p>

</div>
@endsection
