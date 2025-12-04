<nav class="flex flex-1 flex-col w-full text-gray-400">
    <ul role="list" class="flex flex-1 flex-col gap-y-7 no-scrollbar overflow-y-auto">


        {{-- DASHBOARD (Shown for all logged users) --}}
        <li>
            <a href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }} 
                       group flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold transition">
                <i class="fa-solid fa-house h-5 w-5"></i>
                <span x-show="!sidebarCollapsed || sidebarHover" class="whitespace-nowrap">Dashboard</span>
            </a>
        </li>


        {{-- PROBLEM TICKETS --}}
        @canany(['ticket-list','ticket-create','ticket-edit','ticket-delete'])
        <li x-data="{ open: {{ request()->routeIs('tickets.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold text-left transition
                {{ request()->routeIs('tickets.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-ticket h-5 w-5"></i>
                <span x-show="!sidebarCollapsed || sidebarHover" class="whitespace-nowrap flex-1">Problem Tickets</span>
                <i x-show="!sidebarCollapsed || sidebarHover"
                   :class="{'rotate-90': open}"
                   class="fa-solid fa-chevron-right text-xs transition-transform duration-300"></i>
            </button>

            <ul x-show="open" x-collapse class="mt-1 px-2 space-y-1">

                @can('ticket-create')
                <li>
                    <a href="{{ route('tickets.create') }}"
                       class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">
                       Add Ticket
                    </a>
                </li>
                @endcan

                @can('ticket-list')
                <li>
                    <a href="{{ route('tickets.index') }}"
                       class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">
                       All Tickets
                    </a>
                </li>
                @endcan

            </ul>
        </li>
        @endcanany


        {{-- PROBLEM TYPES --}}
        @canany(['problemtype-list','problemtype-create','problemtype-edit','problemtype-delete'])
        <li x-data="{ open: {{ request()->routeIs('problem-types.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold text-left transition
                {{ request()->routeIs('problem-types.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-list-check h-5 w-5"></i>
                <span x-show="!sidebarCollapsed || sidebarHover" class="whitespace-nowrap flex-1">Problem Types</span>
                <i x-show="!sidebarCollapsed || sidebarHover"
                   :class="{'rotate-90': open}"
                   class="fa-solid fa-chevron-right text-xs transition-transform duration-300"></i>
            </button>

            <ul x-show="open" x-collapse class="mt-1 px-2 space-y-1">

                @can('problemtype-create')
                <li><a href="{{ route('problem-types.create') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">Add Problem Type</a></li>
                @endcan

                @can('problemtype-list')
                <li><a href="{{ route('problem-types.index') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">All Problem Types</a></li>
                @endcan

            </ul>
        </li>
        @endcanany


        {{-- PROBLEM AREAS --}}
        @canany(['problemarea-list','problemarea-create','problemarea-edit','problemarea-delete'])
        <li x-data="{ open: {{ request()->routeIs('problem-areas.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold text-left transition
                {{ request()->routeIs('problem-areas.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-map-location-dot h-5 w-5"></i>
                <span x-show="!sidebarCollapsed || sidebarHover" class="whitespace-nowrap flex-1">Problem Areas</span>
                <i x-show="!sidebarCollapsed || sidebarHover"
                   :class="{'rotate-90': open}"
                   class="fa-solid fa-chevron-right text-xs transition-transform duration-300"></i>
            </button>

            <ul x-show="open" x-collapse class="mt-1 px-2 space-y-1">

                @can('problemarea-create')
                <li><a href="{{ route('problem-areas.create') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">Add Problem Area</a></li>
                @endcan

                @can('problemarea-list')
                <li><a href="{{ route('problem-areas.index') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">All Problem Areas</a></li>
                @endcan

            </ul>
        </li>
        @endcanany


        {{-- NOTIFICATION SOURCES --}}
        @canany(['notificationsource-list','notificationsource-create','notificationsource-edit','notificationsource-delete'])
        <li x-data="{ open: {{ request()->routeIs('notification-sources.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold text-left transition
                {{ request()->routeIs('notification-sources.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-bell h-5 w-5"></i>
                <span x-show="!sidebarCollapsed || sidebarHover" class="whitespace-nowrap flex-1">Notification Sources</span>
                <i x-show="!sidebarCollapsed || sidebarHover"
                   :class="{'rotate-90': open}"
                   class="fa-solid fa-chevron-right text-xs transition-transform duration-300"></i>
            </button>

            <ul x-show="open" x-collapse class="mt-1 px-2 space-y-1">

                @can('notificationsource-create')
                <li><a href="{{ route('notification-sources.create') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">Add Notification Source</a></li>
                @endcan

                @can('notificationsource-list')
                <li><a href="{{ route('notification-sources.index') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">All Notification Sources</a></li>
                @endcan

            </ul>
        </li>
        @endcanany


        {{-- HOTELS --}}
        @canany(['hotel-list','hotel-create','hotel-edit','hotel-delete'])
        <li x-data="{ open: {{ request()->routeIs('hotels.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold text-left transition
                {{ request()->routeIs('hotels.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-hotel h-5 w-5"></i>
                <span x-show="!sidebarCollapsed || sidebarHover" class="whitespace-nowrap flex-1">Hotels / Branches</span>
                <i x-show="!sidebarCollapsed || sidebarHover"
                   :class="{'rotate-90': open}"
                   class="fa-solid fa-chevron-right text-xs transition-transform duration-300"></i>
            </button>

            <ul x-show="open" x-collapse class="mt-1 px-2 space-y-1">

                @can('hotel-create')
                <li><a href="{{ route('hotels.create') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">Add Hotel/Branch</a></li>
                @endcan

                @can('hotel-list')
                <li><a href="{{ route('hotels.index') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">All Hotels/Branches</a></li>
                @endcan

            </ul>
        </li>
        @endcanany
        {{-- DEPARTMENTS --}}
        @canany(['department-list','department-create','department-edit','department-delete'])
        <li x-data="{ open: {{ request()->routeIs('departments.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold text-left transition
                {{ request()->routeIs('departments.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-building h-5 w-5"></i>
                <span x-show="!sidebarCollapsed || sidebarHover" class="whitespace-nowrap flex-1">Departments</span>
                <i x-show="!sidebarCollapsed || sidebarHover"
                :class="{'rotate-90': open}"
                class="fa-solid fa-chevron-right text-xs transition-transform duration-300"></i>
            </button>

            <ul x-show="open" x-collapse class="mt-1 px-2 space-y-1">
                <li><a href="{{ route('departments.create') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">Add Department</a></li>
                <li><a href="{{ route('departments.index') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">All Departments</a></li>
            </ul>
        </li>
        @endcanany


        {{-- USERS & ROLES --}}
        @canany([
            'user-list','user-create','user-edit','user-delete',
            'role-list','role-create','role-edit','role-delete'
        ])
        <li x-data="{ open: {{ request()->routeIs('users.*') || request()->routeIs('roles.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold text-left transition
                {{ request()->routeIs('users.*') || request()->routeIs('roles.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                <i class="fa-solid fa-users-gear h-5 w-5"></i>
                <span x-show="!sidebarCollapsed || sidebarHover" class="whitespace-nowrap flex-1">Users</span>
                <i x-show="!sidebarCollapsed || sidebarHover"
                   :class="{'rotate-90': open}"
                   class="fa-solid fa-chevron-right text-xs transition-transform duration-300"></i>
            </button>

            <ul x-show="open" x-collapse class="mt-1 px-2 space-y-1">

                @can('user-list')
                <li><a href="{{ route('users.index') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">Manage Users</a></li>
                @endcan

                @can('role-list')
                <li><a href="{{ route('roles.index') }}" class="block rounded-md py-2 pl-9 pr-2 text-sm hover:bg-gray-800 hover:text-white">Manage Roles</a></li>
                @endcan

            </ul>
        </li>
        @endcanany


        {{-- LOGOUT --}}
        <li class="mt-auto border-t border-gray-700 pt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold hover:bg-gray-800 hover:text-white transition">
                    <i class="fa-solid fa-right-from-bracket h-5 w-5"></i>
                    <span x-show="!sidebarCollapsed || sidebarHover" class="whitespace-nowrap">Logout</span>
                </button>
            </form>
        </li>


    </ul>
</nav>
