<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('รายงานสรุปและ Dashboard (Manager/Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <h3 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">🚨 รายการที่ต้องดำเนินการ (Action Items)</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-yellow-100 dark:bg-yellow-900 border-l-4 border-yellow-500 p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200 uppercase">Pending Members</p>
                            <p class="text-3xl font-bold text-yellow-900 dark:text-yellow-100">{{ $pendingMembers }} คน</p>
                        </div>
                        <span class="p-3 bg-yellow-500 rounded-full text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </span>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-yellow-700 dark:text-yellow-300 hover:underline mt-4 inline-block">ไปที่หน้าจัดการ →</a>
                </div>
                
                <div class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 p-6 rounded-lg shadow-lg">
                     <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-red-800 dark:text-red-200 uppercase">Pending Issues</p>
                            <p class="text-3xl font-bold text-red-900 dark:text-red-100">{{ $pendingIssues }} รายการ</p>
                        </div>
                        <span class="p-3 bg-red-500 rounded-full text-white">
                           <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                    </div>
                    <a href="{{ route('issues.index') }}" class="text-sm text-red-700 dark:text-red-300 hover:underline mt-4 inline-block">ไปที่หน้าจัดการ →</a>
                </div>
                
                <div class="bg-blue-100 dark:bg-blue-900 border-l-4 border-blue-500 p-6 rounded-lg shadow-lg">
                     <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-800 dark:text-blue-200 uppercase">Pending Requests</p>
                            <p class="text-3xl font-bold text-blue-900 dark:text-blue-100">{{ $pendingBorrows + $pendingReservations }} รายการ</p>
                        </div>
                        <span class="p-3 bg-blue-500 rounded-full text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </span>
                    </div>
                    <a href="{{ route('staff.borrow.index') }}" class="text-sm text-blue-700 dark:text-blue-300 hover:underline mt-4 inline-block">ดูคำขอยืม/จอง →</a>
                </div>
            </div>

            <h3 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">📊 ข้อมูลสรุป (Overview)</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-green-100 dark:bg-green-900 p-6 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <span class="p-3 bg-green-500 rounded-full text-white mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-2.37M13 7a4 4 0 11-8 0 4 4 0 018 0zM13 14a6 6 0 00-6 6v1h6v-1a6 6 0 00-6-6zm-3-4a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-green-800 dark:text-green-200 uppercase">Total Members</p>
                            <p class="text-2xl font-bold text-green-900 dark:text-green-100">{{ $totalMembers }} คน</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-200 dark:bg-gray-700 p-6 rounded-lg shadow-lg">
                    <div class="flex items-center">
                         <span class="p-3 bg-gray-500 rounded-full text-white mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200 uppercase">Issues Resolved</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $resolvedIssues }} รายการ</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-orange-100 dark:bg-orange-900 p-6 rounded-lg shadow-lg">
                    <div class="flex items-center">
                         <span class="p-3 bg-orange-500 rounded-full text-white mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        <div>
                            <p class="text-sm font-medium text-orange-800 dark:text-orange-200 uppercase">Unpaid Amount</p>
                            <p class="text-2xl font-bold text-orange-900 dark:text-orange-100">฿{{ number_format($unpaidAmount, 2) }}</p>
                        </div>
                    </div>
                    <a href="{{ route('staff.accounting.index') }}" class="text-sm text-orange-700 dark:text-orange-300 hover:underline mt-3 inline-block">ไปที่หน้าบัญชี →</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>