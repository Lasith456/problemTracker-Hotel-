@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-ticket text-blue-600"></i> Create Problem Ticket
        </h2>
        <a href="{{ route('tickets.index') }}"
           class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg shadow">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    {{-- ERRORS --}}
    @if ($errors->any())
    <div class="mb-5 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
        <strong>Error!</strong> Please fix the following:
        <ul class="list-disc ml-6 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- FORM --}}
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf

            {{-- HOTEL --}}
            <div class="mb-4">
                <label class="font-semibold">Hotel / Branch</label>
                <select name="hotel_id" class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                    <option value="">-- Select Hotel --</option>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- DEPARTMENT --}}
            <div class="mb-4">
                <label class="font-semibold">Department</label>
                <select name="department_id" id="department_select"
                        class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                    <option value="">-- Select Department --</option>
                </select>
            </div>


            {{-- GUEST DETAILS --}}
            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-semibold">Guest Name</label>
                    <input type="text" name="guest_name"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>
                {{-- CONFIRMATION NUMBER --}}
                <div class="mb-4">
                    <label class="font-semibold">Confirmation Number</label>
                    <input type="text" name="confirmation_number"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border"
                           placeholder="Enter confirmation number">
                </div>
                <div>
                    <label class="font-semibold">Guest Contact</label>
                    <input type="text" name="guest_contact"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border"
                           placeholder="Enter guest contact">
                </div>
                <div>
                    <label class="font-semibold">Guest Email</label>
                    <input type="email" name="email"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border"
                           placeholder="Enter guest email">
                </div>
            </div>

            {{-- ROOM & DATES --}}
            <div class="grid sm:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="font-semibold">Room No</label>
                    <input type="text" name="room_no"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border"
                           placeholder="Enter room number">
                </div>

                <div>
                    <label class="font-semibold">Check-in Date</label>
                    <input type="date" name="check_in_date"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>

                <div>
                    <label class="font-semibold">Check-out Date</label>
                    <input type="date" name="check_out_date"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>
            </div>

            {{-- PROBLEM DESCRIPTION --}}
            <div class="mb-4">
                <label class="font-semibold">Problem Description</label>
                <textarea name="problem_description"
                          class="w-full mt-1 px-4 py-2 h-28 rounded-lg bg-gray-100 border" placeholder="Describe the problem"></textarea>
            </div>

            {{-- PROBLEM TYPE / AREA / SOURCE --}}
            <div class="grid sm:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="font-semibold">Problem Type</label>
                    <select name="problem_type_id" class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                        <option value="">-- Select --</option>
                        @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="font-semibold">Problem Area</label>
                    <select name="problem_area_id" class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                        <option value="">-- Select --</option>
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="font-semibold">Notification Source</label>
                    <select name="notification_source_id"
                            class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                        <option value="">-- Select --</option>
                        @foreach ($sources as $source)
                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- ACTION TAKEN --}}
            <div class="mb-4">
                <label class="font-semibold">Action Taken</label>
                <textarea name="action_taken"
                          class="w-full mt-1 px-4 py-2 h-24 rounded-lg bg-gray-100 border" placeholder="Enter action taken"></textarea>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-semibold">Actioned At</label>
                    <input type="date" name="actioned_at"
                        class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>

                <div>
                    <label class="font-semibold">Follow-up At</label>
                    <input type="date" name="followed_up_at"
                        class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
                </div>
            </div>

            {{-- FOLLOW UP --}}
            <div class="mb-4">
                <label class="font-semibold">Follow Up</label>
                <textarea name="follow_up"
                          class="w-full mt-1 px-4 py-2 h-24 rounded-lg bg-gray-100 border" placeholder="Enter follow up details"></textarea>
            </div>

            {{-- COMPENSATION --}}
            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="font-semibold">Compensation</label>
                    <input type="text" name="compensation"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border" placeholder="Enter compensation details">
                </div>

                <div>
                    <label class="font-semibold">Amount</label>
                    <input type="number" step="0.01" name="amount"
                           class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border" placeholder="Enter amount">
                </div>
            </div>

            <div class="mb-6">
                <label class="font-semibold">Compensation Given At</label>
                <input type="datetime-local" name="compensation_given_at"
                       class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border">
            </div>
<div class="mb-4">
                <label class="font-semibold">Entered By</label>
                <input type="text" name="entered_by" value="{{ Auth::user()->name }}"
                       class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border" >
            </div>
                        {{-- FOLLOWED UP BY --}}
            <div class="mb-6">
                <label class="font-semibold">Followed Up By</label>
                <input type="text" name="followed_up_by"
                       class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-100 border" placeholder="Enter name of person who followed up">
            </div>
            {{-- SUBMIT --}}
            <button type="submit"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow">
                Submit Ticket
            </button>
        </form>
    </div>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const hotelDropdown = document.querySelector("select[name='hotel_id']");
        const deptDropdown  = document.getElementById("department_select");

        hotelDropdown.addEventListener("change", function () {
            const hotelId = this.value;

            deptDropdown.innerHTML = `<option value="">Loading...</option>`;

            if (!hotelId) {
                deptDropdown.innerHTML = `<option value="">-- Select Department --</option>`;
                return;
            }

            fetch(`/get-hotel-departments/${hotelId}`)
                .then(response => response.json())
                .then(data => {
                    deptDropdown.innerHTML = `<option value="">-- Select Department --</option>`;
                    if (data.length === 0) {
                        deptDropdown.innerHTML = `<option value="">No departments available</option>`;
                    }
                    data.forEach(dept => {
                        deptDropdown.innerHTML += `<option value="${dept.id}">${dept.name}</option>`;
                    });
                })
                .catch(err => {
                    deptDropdown.innerHTML = `<option>Error loading departments</option>`;
                });
        });
    });
</script>

@endsection
