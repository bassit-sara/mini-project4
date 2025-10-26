{{-- หน้าฟอร์ม "ส่งคำขอ" จองสถานที่ --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('สร้างคำขอจองสถานที่') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- ชี้ไปที่ Route 'reservations.store' --}}
                    <form method="POST" action="{{ route('reservations.store') }}">
                        @csrf

                        <!-- Place Name -->
                        <div>
                            <x-input-label for="place_name" :value="__('ชื่อสถานที่ที่ต้องการจอง')" />
                            <x-text-input id="place_name" class="block mt-1 w-full" type="text" name="place_name" :value="old('place_name')" required autofocus />
                            <x-input-error :messages="$errors->get('place_name')" class="mt-2" />
                        </div>

                        <!-- 
                            🚨
                            🚨 นี่คือจุดที่แก้ไข (The Fix)
                            🚨 เราไม่ใช้ <x-textarea>
                            🚨 เราใช้ <textarea> ธรรมดา และใส่ class ของ Tailwind ให้เหมือน <x-text-input>
                            🚨
                        -->
                        <div class="mt-4">
                            <x-input-label for="purpose" :value="__('วัตถุประสงค์การใช้งาน')" />
                            <textarea id="purpose" name="purpose" rows="4" 
                                      class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('purpose') }}</textarea>
                            <x-input-error :messages="$errors->get('purpose')" class="mt-2" />
                        </div>

                        <!-- Start Date -->
                        <div class="mt-4">
                            <x-input-label for="start_date" :value="__('วันที่และเวลาที่เริ่มจอง')" />
                            {{-- ใช้ type="datetime-local" เพื่อให้เลือกเวลาได้ --}}
                            <x-text-input id="start_date" class="block mt-1 w-full" type="datetime-local" name="start_date" :value="old('start_date')" required />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>
                        
                        <!-- End Date -->
                        <div class="mt-4">
                            <x-input-label for="end_date" :value="__('วันที่และเวลาที่สิ้นสุด')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="datetime-local" name="end_date" :value="old('end_date')" required />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('ส่งคำขอจอง') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

