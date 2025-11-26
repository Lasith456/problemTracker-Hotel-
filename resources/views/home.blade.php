@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-7xl mx-auto space-y-6">
        {{-- Welcome Header --}}
        <div class="bg-white shadow rounded-2xl p-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-indigo-700">🏠 Dashboard</h2>
                <p class="text-gray-600">Welcome back, {{ Auth::user()->name ?? 'User' }}!</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Today: {{ now()->format('l, d M Y') }}</p>
            </div>
        </div>

        
        {{-- Footer --}}
        <div class="text-center text-gray-500 text-sm mt-6">
            © {{ date('Y') }} Navicodes IT Solutions — All Rights Reserved
        </div>
    </div>
</div>
@endsection
