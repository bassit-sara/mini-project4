<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('activities.index')" :active="request()->routeIs('activities.index')">
                        {{ __('กิจกรรม (Activities)') }}
                    </x-nav-link>
                    <x-nav-link :href="route('club-staff.index')" :active="request()->routeIs('club-staff.index')">
                        {{ __('บุคลากรสโมสร') }}
                    </x-nav-link>

                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out">
                                <div>บริการสโมสร</div>
                                <div class="ml-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('borrow.index')">
                                {{ __('ประวัติยืมอุปกรณ์') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('reservations.index')">
                                {{ __('ประวัติจองสถานที่') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('issues.index')">
                                {{ __('แจ้งปัญหา / Q&A') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>

                    @if(in_array(Auth::user()->role, ['staff', 'manager', 'admin']))
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 mt-3 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none transition ease-in-out duration-150">
                                    <div>เมนู Staff</div>
                                    <div class="ml-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.users.index')">
                                    {{ __('(P1) อนุมัติสมาชิก') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('staff.club-staff.index')">
                                    {{ __('(P2) จัดการบุคลากร') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('staff.activities.index')">
                                    {{ __('(P4) จัดการกิจกรรม') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('staff.borrow.index')">
                                    {{ __('(P5) อนุมัติยืมของ') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('staff.reservations.index')">
                                    {{ __('(P6) อนุมัติจองที่') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif
                    
                    @if(in_array(Auth::user()->role, ['manager', 'admin']))
                         <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="ml-4 inline-flex items-center px-3 py-2 mt-3 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none transition ease-in-out duration-150">
                                    <div>เมนู Manager</div>
                                    <div class="ml-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('reports.index')">
                                    {{ __('(P8) รายงานสรุป') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('staff.accounting.index')">
                                    {{ __('(P7) ระบบบัญชี') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('activities.index')" :active="request()->routeIs('activities.index')">
                {{ __('กิจกรรม (Activities)') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('club-staff.index')" :active="request()->routeIs('club-staff.index')">
                {{ __('บุคลากรสโมสร') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">บริการสโมสร</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('borrow.index')">
                    {{ __('ประวัติยืมอุปกรณ์') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reservations.index')">
                    {{ __('ประวัติจองสถานที่') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('issues.index')">
                    {{ __('แจ้งปัญหา / Q&A') }}
                </x-responsive-nav-link>
            </div>
        </div>

        @if(in_array(Auth::user()->role, ['staff', 'manager', 'admin']))
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-blue-800 dark:text-blue-300">เมนู Staff</div>
                </div>
                <div class="mt-3 space-y-1">
                     <x-responsive-nav-link :href="route('admin.users.index')">
                        {{ __('(P1) อนุมัติสมาชิก') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('staff.club-staff.index')">
                        {{ __('(P2) จัดการบุคลากร') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('staff.activities.index')">
                        {{ __('(P4) จัดการกิจกรรม') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('staff.borrow.index')">
                        {{ __('(P5) อนุมัติยืมของ') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('staff.reservations.index')">
                        {{ __('(P6) อนุมัติจองที่') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endif
        
        @if(in_array(Auth::user()->role, ['manager', 'admin']))
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-red-800 dark:text-red-300">เมนู Manager</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('reports.index')">
                        {{ __('(P8) รายงานสรุป') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('staff.accounting.index')">
                        {{ __('(P7) ระบบบัญชี') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endif

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>