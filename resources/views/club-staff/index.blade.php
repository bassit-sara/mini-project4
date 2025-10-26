<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('(P2) คณะกรรมการสโมสร (Club Staff)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($staffs as $staff)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl transform transition-all hover:scale-105">
                        <div class="w-full h-32 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $staff->user->name }}</h3>
                            
                            <p class="text-md font-semibold text-red-600 dark:text-red-400">{{ $staff->position }}</p>
                            
                            <hr class="my-3 border-gray-200 dark:border-gray-700">
                            
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                <strong class="text-gray-900 dark:text-white">หน้าที่:</strong> {{ $staff->responsibility }}
                            </p>
                            
                            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                <strong class="text-gray-900 dark:text-white">ติดต่อ:</strong> {{ $staff->contact ?? '-' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 text-gray-500 dark:text-gray-400">
                        <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <p class="mt-4 text-lg">ยังไม่มีข้อมูลบุคลากรสโมสร</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>{{-- หน้าสำหรับ Member ดูรายชื่อคณะกรรมการ --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('คณะกรรมการสโมสร') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- ปุ่มสำหรับ Staff -->
            @if(in_array(Auth::user()->role, ['staff', 'manager', 'admin']))
                <div class="mb-4 text-right">
                    <a href="{{ route('staff.club-staff.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('จัดการรายชื่อ (Staff)') }}
                    </a>
                </div>
            @endif

            <!-- Grid แสดงรายชื่อ -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($staffs as $staff)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg transform transition-all duration-300 hover:scale-105">
                        <div class="p-6">
                            <!-- (Icon/Photo Placeholder) -->
                            <div class="flex justify-center mb-4">
                                <img class="w-24 h-24 rounded-full object-cover border-4 border-red-500" 
                                     src="{{ $staff->photo ?? 'https://placehold.co/100x100/EFEFEF/333333?text=' . substr($staff->user->name, 0, 1) }}" 
                                     alt="Profile photo">
                            </div>
                            <h3 class="text-xl font-bold text-center text-gray-900 dark:text-white">{{ $staff->user->name }}</h3>
                            <p class="text-sm text-red-500 dark:text-red-400 text-center font-semibold">{{ $staff->position }}</p>
                            <hr class="my-4 border-gray-200 dark:border-gray-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <strong class="text-gray-800 dark:text-gray-200">หน้าที่:</strong> {{ $staff->responsibility }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                <strong class="text-gray-800 dark:text-gray-200">ติดต่อ:</strong> {{ $staff->contact ?? '-' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">ยังไม่มีข้อมูลบุคลากรในขณะนี้</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
