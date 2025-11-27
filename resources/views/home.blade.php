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
{{-- Quick Shortcut Tiles --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    {{-- TICKETS --}}
    @canany(['ticket-list','ticket-create'])
    <a href="{{ route('tickets.index') }}"
        class="group bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-transparent hover:border-indigo-300">
        <div class="flex items-center gap-4">
            <div class="bg-indigo-100 text-indigo-600 p-4 rounded-xl">
                <i class="fa-solid fa-ticket text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-indigo-600">Problem Tickets</h3>
                <p class="text-sm text-gray-500">View & manage tickets</p>
            </div>
        </div>
    </a>
    @endcanany

    {{-- PROBLEM TYPES --}}
    @canany(['problemtype-list','problemtype-create'])
    <a href="{{ route('problem-types.index') }}"
        class="group bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-transparent hover:border-indigo-300">
        <div class="flex items-center gap-4">
            <div class="bg-blue-100 text-blue-600 p-4 rounded-xl">
                <i class="fa-solid fa-list-check text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-600">Problem Types</h3>
                <p class="text-sm text-gray-500">Manage categories</p>
            </div>
        </div>
    </a>
    @endcanany

    {{-- PROBLEM AREAS --}}
    @canany(['problemarea-list','problemarea-create'])
    <a href="{{ route('problem-areas.index') }}"
        class="group bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-transparent hover:border-indigo-300">
        <div class="flex items-center gap-4">
            <div class="bg-emerald-100 text-emerald-600 p-4 rounded-xl">
                <i class="fa-solid fa-map-location-dot text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-emerald-600">Problem Areas</h3>
                <p class="text-sm text-gray-500">View all problem areas</p>
            </div>
        </div>
    </a>
    @endcanany

    {{-- NOTIFICATION SOURCES --}}
    @canany(['notificationsource-list','notificationsource-create'])
    <a href="{{ route('notification-sources.index') }}"
        class="group bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-transparent hover:border-indigo-300">
        <div class="flex items-center gap-4">
            <div class="bg-yellow-100 text-yellow-600 p-4 rounded-xl">
                <i class="fa-solid fa-bell text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-yellow-600">Notification Sources</h3>
                <p class="text-sm text-gray-500">Manage notification types</p>
            </div>
        </div>
    </a>
    @endcanany

    {{-- HOTELS --}}
    @canany(['hotel-list','hotel-create'])
    <a href="{{ route('hotels.index') }}"
        class="group bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-transparent hover:border-indigo-300">
        <div class="flex items-center gap-4">
            <div class="bg-red-100 text-red-600 p-4 rounded-xl">
                <i class="fa-solid fa-hotel text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-red-600">Hotels / Branches</h3>
                <p class="text-sm text-gray-500">View & manage hotels</p>
            </div>
        </div>
    </a>
    @endcanany

    {{-- USERS & ROLES --}}
    @canany(['user-list','role-list'])
    <a href="{{ route('users.index') }}"
        class="group bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-transparent hover:border-indigo-300">
        <div class="flex items-center gap-4">
            <div class="bg-purple-100 text-purple-600 p-4 rounded-xl">
                <i class="fa-solid fa-users-gear text-2xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-purple-600">User Management</h3>
                <p class="text-sm text-gray-500">Manage users & roles</p>
            </div>
        </div>
    </a>
    @endcanany

</div>

        
        {{-- Footer --}}
        <div class="text-center text-gray-500 text-sm mt-6">
            © {{ date('Y') }} Navicodes IT Solutions — All Rights Reserved
        </div>
    </div>
</div>
@endsection
