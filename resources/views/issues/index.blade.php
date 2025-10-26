{{-- หน้าแสดงรายการแจ้งปัญหา (ของ Member/Staff) --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('รายการแจ้งปัญหา / ถามข้อสงสัย') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 text-right">
                <a href="{{ route('issues.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    + {{ __('แจ้งปัญหาใหม่') }}
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
                                    <th class="px-6 py-3 text-left">หัวข้อ</th>
                                    <!-- (ถ้าเป็น Manager/Admin ให้แสดงว่า "ใคร" แจ้ง) -->
                                    @if(Auth::user()->role != 'member')
                                        <th class="px-6 py-3 text-left">ผู้แจ้ง</th>
                                    @endif
                                    <th class="px-6 py-3 text-left">สถานะ</th>
                                    <th class="px-6 py-3 text-left">วันที่แจ้ง</th>
                                    <th class="px-6 py-3 text-right"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($issues as $issue)
                                    <tr>
                                        <td class="px-6 py-4">{{ $issue->title }}</td>
                                        @if(Auth::user()->role != 'member')
                                            <!-- ดึงชื่อจาก Relationship 'member' -->
                                            <td class="px-6 py-4">{{ $issue->member->name }}</td>
                                        @endif
                                        <td class="px-6 py-4">
                                            @if($issue->status == 'pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">รอดำเนินการ</span>
                                            @elseif($issue->status == 'resolved')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">แก้ไขแล้ว</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $issue->status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">{{ $issue->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('issues.show', $issue) }}" class="text-indigo-600 hover:text-indigo-900">ดูรายละเอียด</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            {{ Auth::user()->role == 'member' ? 'คุณยังไม่ได้แจ้งปัญหาใดๆ' : 'ยังไม่มีปัญหาในระบบ' }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $issues->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
