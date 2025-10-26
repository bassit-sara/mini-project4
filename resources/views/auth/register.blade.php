<x-guest-layout>
    <div class="min-h-screen flex flex-col bg-gradient-to-br from-yellow-100 via-amber-200 to-yellow-300 font-sans relative">

    <nav class="w-full bg-white/20 backdrop-blur-lg shadow-md p-4 sticky top-0 z-50 border-b border-white/30">
        <div class="container mx-auto flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0">
            <a href="/" class="flex items-center space-x-2 text-xl font-bold text-yellow-800 drop-shadow">
                <span class="text-2xl">🌻</span>
                <span>Science Club</span>
            </a>
            
            <div class="flex items-center space-x-4 sm:space-x-6">
                <a href="/" class="text-gray-700 hover:text-yellow-800 font-medium transition-colors">หน้าแรก</a>
                <a href="{{ route('login') }}" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded-lg shadow-md hover:bg-yellow-600 transition-all text-sm font-medium">เข้าสู่ระบบ</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-4 sm:p-6 relative">

        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute top-20 left-10 w-40 h-40 bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-52 h-52 bg-yellow-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
        </div>

        <div class="w-full max-w-md bg-white/90 backdrop-blur-md shadow-2xl rounded-2xl p-8 border border-yellow-200 z-10">
            
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-yellow-600 drop-shadow-md">🌻 สมัครสมาชิก Science Club</h1>
                <p class="text-gray-500 text-sm mt-2">สร้างบัญชีเพื่อเข้าร่วมสโมสร</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('ชื่อ-สกุล')" class="text-yellow-700" />
                    <x-text-input 
                        id="name" 
                        class="block mt-1 w-full rounded-lg border-yellow-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        required autofocus autocomplete="name" 
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="student_id" :value="__('รหัสนักศึกษา (Student ID)')" class="text-yellow-700" />
                    <x-text-input 
                        id="student_id" 
                        class="block mt-1 w-full rounded-lg border-yellow-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200" 
                        type="text" 
                        name="student_id" 
                        :value="old('student_id')" 
                        required autocomplete="username" 
                    />
                    <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" class="text-yellow-700" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full rounded-lg border-yellow-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required autocomplete="email" 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password (รหัสผ่าน)')" class="text-yellow-700" />
                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full rounded-lg border-yellow-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                        type="password"
                        name="password"
                        required autocomplete="new-password" 
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password (ยืนยันรหัสผ่าน)')" class="text-yellow-700" />
                    <x-text-input 
                        id="password_confirmation" 
                        class="block mt-1 w-full rounded-lg border-yellow-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                        type="password"
                        name="password_confirmation" 
                        required autocomplete="new-password" 
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a 
                        class="text-sm text-yellow-700 hover:text-yellow-900 underline transition-colors" 
                        href="{{ route('login') }}">
                        {{ __('เป็นสมาชิกอยู่แล้ว? (Already registered?)') }}
                    </a>

                    <x-primary-button 
                        class="ml-4 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white font-semibold rounded-lg shadow-md px-6 py-2 transition-all duration-300 hover:scale-105">
                        {{ __('สมัครสมาชิก (Register)') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </main>

    <footer class="w-full bg-white/20 backdrop-blur-lg p-4 text-center text-gray-700 text-sm border-t border-white/30">
        &copy; {{ date('Y') }} Science Club. All rights reserved.
    </footer>

</div>

</x-guest-layout>
