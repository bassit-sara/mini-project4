{{-- หน้าแสดงกิจกรรมให้ Member เข้าร่วม --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('กิจกรรมสโมสร') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- ปุ่มสำหรับ Staff -->
            @if(in_array(Auth::user()->role, ['staff', 'manager', 'admin']))
                <div class="mb-4 text-right">
                    <a href="{{ route('staff.activities.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('จัดการกิจกรรม (Staff)') }}
                    </a>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">{{ session('success') }}</div>
            @endif

            <!-- Grid แสดงกิจกรรม -->
            <div class="space-y-6">
                @forelse($activities as $activity)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <!-- (สามารถเพิ่มรูปกิจกรรมได้ที่นี่) -->
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $activity->start_time->format('d M Y, H:i') }} - {{ $activity->end_time->format('d M Y, H:i') }}
                            </span>
                            <h3 class="text-2xl font-bold mt-2">{{ $activity->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 inline-block -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $activity->location }}
                            </p>
                            <p class="mt-4">{{ $activity->description }}</p>
                            
                            <div class="mt-6 flex justify-between items-center">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    ผู้เข้าร่วมแล้ว: {{ $activity->participants->count() }} คน
                                </span>
                                
                                <!-- ปุ่ม Join/Leave -->
                                @if($activity->participants->contains(Auth::id()))
                                    <!-- ถ้า Join แล้ว: แสดงปุ่ม "Leave" -->
                                    <form action="{{ route('activities.leave', $activity) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 font-semibold hover:underline">ยกเลิกการเข้าร่วม</button>
                                    </form>
                                @else
                                    <!-- ถ้ายังไม่ Join: แสดงปุ่ม "Join" -->
                                    <form action="{{ route('activities.join', $activity) }}" method="POST">
                                        @csrf
                                        <x-primary-button>
                                            {{ __('เข้าร่วมกิจกรรม') }}
                                        </x-primary-button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                            <p class="text-gray-500 dark:text-gray-400">ยังไม่มีกิจกรรมในขณะนี้</p>
                        </div>
                    </div>
                @endforelse
            </div>
             <div class="mt-4">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
