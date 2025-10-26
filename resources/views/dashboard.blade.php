<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard (ภาพรวมระบบ)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- ส่วนต้อนรับ --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-10 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        👋 ยินดีต้อนรับ, {{ Auth::user()->name }}!
                    </h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        นี่คือหน้าสรุปภาพรวมสำหรับบัญชีของคุณในระบบสโมสร
                    </p>
                </div>
            </div>

            {{-- ส่วนสมาชิกทั่วไป --}}
            @if(Auth::user()->role == 'member')

                {{-- สถานะสมาชิก --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                            🧾 สถานะสมาชิกภาพ (Membership Status)
                        </h4>

                        @if(Auth::user()->status == 'approved')
                            <p class="flex items-center text-green-600 dark:text-green-400">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-semibold">อนุมัติแล้ว (Approved)</span>
                            </p>
                            <p class="ml-8 text-sm text-gray-600 dark:text-gray-400">คุณสามารถใช้งานระบบได้เต็มรูปแบบ</p>

                        @elseif(Auth::user()->status == 'pending')
                            <p class="flex items-center text-yellow-600 dark:text-yellow-400">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-semibold">รอดำเนินการ (Pending)</span>
                            </p>
                            <p class="ml-8 text-sm text-gray-600 dark:text-gray-400">เจ้าหน้าที่กำลังตรวจสอบคำขอสมัครสมาชิกของคุณ</p>

                        @else
                            <p class="flex items-center text-red-600 dark:text-red-400">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-semibold">ถูกปฏิเสธ (Rejected)</span>
                            </p>
                            <p class="ml-8 text-sm text-gray-600 dark:text-gray-400">โปรดติดต่อเจ้าหน้าที่สโมสรเพื่อสอบถามข้อมูลเพิ่มเติม</p>
                        @endif
                    </div>
                </div>

                {{-- เมนูของสมาชิก --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('borrow.create') }}"
                       class="block p-6 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                        <h5 class="font-semibold text-xl mt-3">ยืมอุปกรณ์</h5>
                        <p class="text-sm opacity-90 mt-1">ส่งคำขอยืมอุปกรณ์กีฬา, อุปกรณ์จัดกิจกรรม, และอื่นๆ</p>
                    </a>

                    <a href="{{ route('reservations.create') }}"
                       class="block p-6 bg-green-600 text-white rounded-xl shadow-lg hover:bg-green-700 transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h5 class="font-semibold text-xl mt-3">จองสถานที่</h5>
                        <p class="text-sm opacity-90 mt-1">ส่งคำขอจองห้องประชุม, ลานกิจกรรม, หรือสถานที่ของสโมสร</p>
                    </a>

                    <a href="{{ route('issues.create') }}"
                       class="block p-6 bg-gray-700 text-white rounded-xl shadow-lg hover:bg-gray-800 transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h5 class="font-semibold text-xl mt-3">แจ้งปัญหา / Q&A</h5>
                        <p class="text-sm opacity-90 mt-1">ส่งคำถาม, ข้อสงสัย, หรือแจ้งปัญหาการใช้งาน</p>
                    </a>
                </div>

            {{-- ส่วนเจ้าหน้าที่ --}}
            @elseif(Auth::user()->role == 'staff')

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">🧰 Staff Control Panel</h4>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            เมนูลัดสำหรับจัดการระบบในส่วนที่คุณรับผิดชอบ
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        <a href="{{ route('admin.users.index') }}"
                           class="p-6 text-center border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                            <svg class="w-12 h-12 mx-auto text-blue-500" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <p class="font-semibold text-gray-700 dark:text-gray-300 mt-3">อนุมัติสมาชิก</p>
                        </a>

                        <a href="{{ route('staff.activities.index') }}"
                           class="p-6 text-center border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                            <svg class="w-12 h-12 mx-auto text-yellow-500" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16v4m-2-2h4m5 16v4m-2-2h4M12 8a2 2 0 100-4 2 2 0 000 4zm0 10a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                            <p class="font-semibold text-gray-700 dark:text-gray-300 mt-3">จัดการกิจกรรม</p>
                        </a>

                        <a href="{{ route('staff.borrow.index') }}"
                           class="p-6 text-center border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                            <svg class="w-12 h-12 mx-auto text-green-500" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-6 9l2 2 4-4"/>
                            </svg>
                            <p class="font-semibold text-gray-700 dark:text-gray-300 mt-3">อนุมัติยืมอุปกรณ์</p>
                        </a>

                        <a href="{{ route('staff.reservations.index') }}"
                           class="p-6 text-center border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                            <svg class="w-12 h-12 mx-auto text-purple-500" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a
