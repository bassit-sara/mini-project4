{{-- หน้าฟอร์ม "สร้าง" บุคลากรใหม่ --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('เพิ่มบุคลากรใหม่') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('staff.club-staff.store') }}">
                        @csrf

                        <!-- User (เลือกจาก Staff) -->
                        <div class="mt-4">
                            <x-input-label for="user_id" :value="__('เลือก User (ที่เป็น Staff/Manager/Admin)')" />
                            <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">-- กรุณาเลือก --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Position -->
                        <div class="mt-4">
                            <x-input-label for="position" :value="__('ตำแหน่ง')" />
                            <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" required autofocus />
                            <x-input-error :messages="$errors->get('position')" class="mt-2" />
                        </div>

                        <!-- Responsibility -->
                        <div class="mt-4">
                            <x-input-label for="responsibility" :value="__('หน้าที่รับผิดชอบ')" />
                            <x-textarea id="responsibility" class="block mt-1 w-full" name="responsibility" rows="3">{{ old('responsibility') }}</x-textarea>
                            <x-input-error :messages="$errors->get('responsibility')" class="mt-2" />
                        </div>
                        
                        <!-- Contact -->
                        <div class="mt-4">
                            <x-input-label for="contact" :value="__('ข้อมูลติดต่อ (เช่น Line, Facebook)')" />
                            <x-text-input id="contact" class="block mt-1 w-full" type="text" name="contact" :value="old('contact')" />
                            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                        </div>
                        
                        <!-- (สามารถเพิ่ม Input 'photo' (type="file") ได้ที่นี่) -->

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('บันทึก') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
