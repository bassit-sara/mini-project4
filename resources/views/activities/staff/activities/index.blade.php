{{-- หน้าสำหรับ Staff จัดการ (CRUD) กิจกรรม --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('จัดการกิจกรรม (Staff)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 text-right">
                <a href="{{ route('staff.activities.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    + {{ __('สร้างกิจกรรมใหม่') }}
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
                                    <th class="px-6 py-3 text-left">ชื่อกิจกรรม</th>
                                    <th class="px-6 py-3 text-left">สถานที่</th>
                                    <th class="px-6 py-3 text-left">เวลาเริ่ม</th>
                                    <th class="px-6 py-3 text-left">ผู้เข้าร่วม</th>
                                    <th class="px-6 py-3 text-right">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($activities as $activity)
                                    <tr>
                                        <td class="px-6 py-4">{{ $activity->name }}</td>
                                        <td class="px-6 py-4">{{ $activity->location }}</td>
                                        <td class="px-6 py-4">{{ $activity->start_time->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4">{{ $activity->participants->count() }} คน</td>
                                        <td class="px-6 py-4 text-right">
                                            <!-- (ต้องสร้าง Route 'staff.activities.show' เพื่อดูรายชื่อคน Join) -->
                                            <!-- <a href="#" class="text-blue-600 hover:text-blue-900">ดูรายชื่อ</a> -->
                                            <a href="{{ route('staff.activities.edit', $activity) }}" class="text-indigo-600 hover:text-indigo-900 ms-2">แก้ไข</a>
                                            <form action="{{ route('staff.activities.destroy', $activity) }}" method="POST" class="inline-block ms-2" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">ลบ</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
