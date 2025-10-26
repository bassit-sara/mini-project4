<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เข้าสู่ระบบ | สโมสรนักศึกษา</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-yellow-100 via-amber-200 to-yellow-50 flex flex-col justify-center items-center relative overflow-hidden">

    <!-- พื้นหลังเอฟเฟกต์แสง -->
    <div class="absolute inset-0 bg-gradient-to-tr from-amber-300 via-yellow-400 to-amber-200 opacity-40 blur-3xl animate-pulse"></div>

    <!-- Navbar -->
    <header class="absolute top-0 left-0 right-0 flex justify-between items-center px-10 py-4 bg-white/30 backdrop-blur-lg border-b border-amber-100/50 z-20">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-amber-500 text-white flex items-center justify-center rounded-full font-bold shadow-md">
                ST
            </div>
            <span class="text-lg font-semibold text-gray-800">Science & Tech Club</span>
        </div>
        <a href="/" class="text-gray-700 hover:text-amber-600 font-medium transition">หน้าแรก</a>
    </header>

    <!-- กล่อง Login -->
    <div class="relative z-10 w-full max-w-lg bg-white/80 backdrop-blur-2xl border border-amber-100 rounded-3xl shadow-2xl p-10 mx-4 sm:mx-0">

        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-2">เข้าสู่ระบบ</h1>
        <p class="text-center text-gray-600 mb-8">ระบบสโมสรนักศึกษา คณะวิทยาศาสตร์ฯ</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('อีเมล')" class="font-semibold text-gray-700" />
                <x-text-input id="email" class="block mt-1 w-full rounded-xl border-amber-300 focus:border-amber-500 focus:ring-amber-400"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('รหัสผ่าน')" class="font-semibold text-gray-700" />
                <x-text-input id="password" class="block mt-1 w-full rounded-xl border-amber-300 focus:border-amber-500 focus:ring-amber-400"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mt-4">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-amber-600 shadow-sm focus:ring-amber-500" name="remember">
                <label for="remember_me" class="ml-2 text-sm text-gray-700">จดจำการเข้าสู่ระบบ</label>
            </div>

            <!-- ปุ่ม -->
            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <a class="text-sm text-amber-600 hover:text-amber-500 font-medium" href="{{ route('password.request') }}">
                        ลืมรหัสผ่าน?
                    </a>
                @endif

                <x-primary-button class="bg-amber-500 hover:bg-amber-400 active:bg-amber-600 focus:bg-amber-600 text-white px-6 py-2 rounded-xl shadow-md transition transform hover:scale-105">
                    เข้าสู่ระบบ
                </x-primary-button>
            </div>

            <p class="mt-8 text-center text-sm text-gray-600">
                ยังไม่มีบัญชี? 
                <a href="{{ route('register') }}" class="text-amber-600 hover:text-amber-500 font-semibold">สมัครสมาชิก</a>
            </p>
        </form>
    </div>

    <!-- Footer -->
    <footer class="absolute bottom-4 text-sm text-gray-600">
        © {{ date('Y') }} สโมสรนักศึกษา | พัฒนาโดยทีมพัฒนาเว็บ Laravel 12
    </footer>
</body>
</html>
