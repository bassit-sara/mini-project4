{{-- หน้าสำหรับ Staff "อนุมัติ" การจอง --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('อนุมัติคำขอจองสถานที่ (Staff)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">รายการที่รอการอนุมัติ (Pending)</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left">ผู้จอง</th>
                                    <th class="px-6 py-3 text-left">สถานที่</th>
                                    <th class="px-6 py-3 text-left">เวลาเริ่ม</th>
                                    <th class="px-6 py-3 text-left">เวลาสิ้นสุด</th>
                                    <th class="px-6 py-3 text-right">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($requests as $request)
                                    <tr>
                                        <td class="px-6 py-4">{{ $request->member->name }}</td>
                                        <td class="px-6 py-4">{{ $request->place_name }}</td>
                                        <td class="px-6 py-4">{{ $request->start_date->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4">{{ $request->end_date->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('staff.reservations.approve', $request) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-green-600 hover:text-green-900">อนุมัติ</button>
                                            </form>
                                            <form action="{{ route('staff.reservations.reject', $request) }}" method="POST" class="inline-block ms-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-red-600 hover:text-red-900">ปฏิเสธ</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            ไม่มีคำขอที่รอการอนุมัติ
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
