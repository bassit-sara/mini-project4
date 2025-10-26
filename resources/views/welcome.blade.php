<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ระบบสโมสร | คณะวิทยาศาสตร์เทคโนโลยีและการเกษตร</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-yellow-50 dark:bg-gray-900">

    <div class="relative isolate min-h-screen overflow-hidden">

        <!-- แสงพื้นหลังเหลืองทอง -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[40rem] -translate-x-1/2 rotate-[30deg] 
                        bg-gradient-to-tr from-amber-300 via-yellow-400 to-amber-600 opacity-30 
                        sm:left-[calc(50%-30rem)] sm:w-[75rem]"
                 style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 
                                          85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 
                                          60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 
                                          45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 
                                          17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 
                                          74.1% 44.1%)">
            </div>
        </div>

        <!-- Navbar -->
        <header class="fixed top-0 left-0 right-0 z-20 bg-white/70 dark:bg-gray-800/60 backdrop-blur-md shadow-sm">
            <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <!-- โลโก้ -->
                    <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold shadow-md">
                        ST
                    </div>
                    <span class="font-semibold text-gray-900 dark:text-gray-100 text-lg">
                        สโมสรนักศึกษา คณะวิทยาศาสตร์ฯ
                    </span>
                </div>

                <nav>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="text-gray-800 dark:text-gray-200 hover:text-amber-600 font-medium px-4 transition">
                               Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="text-gray-800 dark:text-gray-200 hover:text-amber-600 font-medium px-4 transition">
                               เข้าสู่ระบบ
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="text-gray-800 dark:text-gray-200 hover:text-amber-600 font-medium px-4 transition">
                                   สมัครสมาชิก
                                </a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </div>
        </header>

        <!-- เนื้อหาหลัก -->
        <main class="flex flex-col items-center justify-center text-center pt-32 pb-24 px-6">
            <svg class="w-20 h-20 mx-auto text-amber-500 dark:text-yellow-400 mb-6 animate-bounce" 
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332
                         A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18"/>
            </svg>

            <h1 class="text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-6xl">
                ระบบสโมสรนักศึกษา
            </h1>
            <p class="mt-2 text-3xl font-bold tracking-tight text-amber-600 dark:text-yellow-400 sm:text-4xl">
                คณะวิทยาศาสตร์เทคโนโลยีและการเกษตร
            </p>

            <p class="mt-6 text-lg leading-8 text-gray-700 dark:text-gray-300 max-w-2xl">
                ระบบกลางสำหรับนักศึกษาและบุคลากรในการสมัครสมาชิก, 
                สื่อสาร, ติดตามกิจกรรม, ยืมอุปกรณ์, จองสถานที่ 
                และดูรายงานต่างๆ ได้ในที่เดียว
            </p>

            <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="rounded-full bg-amber-500 px-6 py-3 text-base font-semibold text-white shadow-lg hover:bg-amber-400 
                              focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-500 
                              transition duration-150 ease-in-out transform hover:scale-105">
                        ไปที่ Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="rounded-full bg-amber-500 px-6 py-3 text-base font-semibold text-white shadow-lg hover:bg-amber-400 
                              focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-500 
                              transition duration-150 ease-in-out transform hover:scale-105">
                        เข้าสู่ระบบ
                    </a>
                    <a href="{{ route('register') }}" 
                       class="text-base font-semibold leading-6 text-gray-900 dark:text-white hover:text-amber-700 dark:hover:text-yellow-300 transition">
                        สมัครสมาชิก →
                    </a>
                @endauth
            </div>
        </main>

        <!-- Footer -->
        <footer class="absolute bottom-0 w-full py-5 text-center text-sm text-gray-700 dark:text-gray-400 bg-white/50 dark:bg-gray-800/30 backdrop-blur-sm">
            <p>© {{ date('Y') }} สโมสรนักศึกษา คณะวิทยาศาสตร์เทคโนโลยีและการเกษตร</p>
            <p class="text-amber-500 font-semibold">พัฒนาโดยทีมพัฒนาเว็บ Laravel 12</p>
        </footer>
    </div>
</body>
</html>
