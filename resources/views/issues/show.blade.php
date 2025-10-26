{{-- หน้าแสดงรายละเอียดปัญหา และการตอบกลับ --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('รายละเอียดปัญหา: ') }} {{ $issue->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- ส่วนคำถาม (ที่ Member แจ้งมา) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            แจ้งโดย: {{ $issue->member->name }} ({{ $issue->created_at->diffForHumans() }})
                        </span>
                        @if($issue->status == 'pending')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">รอดำเนินการ</span>
                        @elseif($issue->status == 'resolved')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">แก้ไขแล้ว</span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $issue->status }}</span>
                        @endif
                    </div>
                    
                    <h3 class="text-lg font-semibold mt-4">{{ $issue->title }}</h3>
                    <p class="mt-2 whitespace-pre-wrap">{{ $issue->description }}</p>
                </div>
            </div>

            <!-- ส่วนคำตอบ (จาก Manager) -->
            <div class="bg-gray-50 dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="text-md font-semibold mb-4">การตอบกลับจากเจ้าหน้าที่</h4>
                    
                    @if($issue->reply)
                        <div class="whitespace-pre-wrap">{{ $issue->reply }}</div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">ยังไม่มีการตอบกลับ...</p>
                    @endif

                    <!-- (ฟอร์มสำหรับ Manager ตอบกลับ) -->
                    @if(in_array(Auth::user()->role, ['manager', 'admin']))
                        <form method="POST" action="{{ route('issues.reply', $issue) }}" class="mt-6">
                            @csrf
                            @method('PATCH')
                            <x-input-label for="reply" :value="__('ตอบกลับปัญหานี้ (Manager/Admin)')" />
                            <x-textarea id="reply" class="block mt-1 w-full" name="reply" rows="4">{{ old('reply', $issue->reply) }}</x-textarea>
                            
                            <x-input-label for="status" :value="__('อัปเดตสถานะ')" class="mt-4"/>
                            <select name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="pending" {{ $issue->status == 'pending' ? 'selected' : '' }}>รอดำเนินการ</option>
                                <option value="in_progress" {{ $issue->status == 'in_progress' ? 'selected' : '' }}>กำลังดำเนินการ</option>
                                <option value="resolved" {{ $issue->status == 'resolved' ? 'selected' : '' }}>แก้ไขแล้ว</option>
                            </select>
                            
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button>
                                    {{ __('ส่งคำตอบ') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
