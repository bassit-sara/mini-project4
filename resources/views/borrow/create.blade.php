{{-- หน้าฟอร์ม "ส่งคำขอ" ยืมอุปกรณ์ --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('สร้างคำขอยืมอุปกรณ์') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('borrow.store') }}">
                        @csrf

                        <!-- Item Name -->
                        <div>
                            <x-input-label for="item_name" :value="__('ชื่ออุปกรณ์ที่ต้องการยืม')" />
                            <x-text-input id="item_name" class="block mt-1 w-full" type="text" name="item_name" :value="old('item_name')" required autofocus />
                            <x-input-error :messages="$errors->get('item_name')" class="mt-2" />
                        </div>

                        <!-- Quantity -->
                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('จำนวน (ชิ้น)')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')" required min="1" />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <!-- Borrow Date -->
                        <div class="mt-4">
                            <x-input-label for="borrow_date" :value="__('วันที่ต้องการยืม')" />
                            <x-text-input id="borrow_date" class="block mt-1 w-full" type="date" name="borrow_date" :value="old('borrow_date')" required />
                            <x-input-error :messages="$errors->get('borrow_date')" class="mt-2" />
                        </div>
                        
                        <!-- Return Date -->
                        <div class="mt-4">
                            <x-input-label for="return_date" :value="__('วันที่ต้องการคืน')" />
                            <x-text-input id="return_date" class="block mt-1 w-full" type="date" name="return_date" :value="old('return_date')" required />
                            <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('ส่งคำขอ') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
