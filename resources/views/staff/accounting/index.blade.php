{{-- หน้าจัดการบัญชี (สำหรับ Manager/Admin) --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('จัดการบัญชี (Manager/Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 text-right">
                <a href="{{ route('staff.accounting.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    + {{ __('สร้างรายการใหม่') }}
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left">สมาชิก</th>
                                    <th class="px-6 py-3 text-left">จำนวนเงิน (บาท)</th>
                                    <th class="px-6 py-3 text-left">เหตุผล</th>
                                    <th class="px-6 py-3 text-left">สถานะ</th>
                                    <th class="px-6 py-3 text-right">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($payments as $payment)
                                    <tr>
                                        <td class="px-6 py-4">{{ $payment->member->name }}</td>
                                        <td class="px-6 py-4 text-right">{{ number_format($payment->amount, 2) }}</td>
                                        <td class="px-6 py-4">{{ $payment->reason }}</td>
                                        <td class="px-6 py-4">
                                            @if($payment->status == 'pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">ค้างชำระ</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">ชำระแล้ว</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <!-- (ต้องสร้างฟังก์ชันอัปโหลดสลิปและ Mark as Paid) -->
                                            <a href="{{ route('staff.accounting.edit', $payment) }}" class="text-indigo-600 hover:text-indigo-900">แก้ไข</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            ไม่มีรายการบัญชี
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
