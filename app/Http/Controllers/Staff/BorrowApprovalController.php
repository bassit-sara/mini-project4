<?php
// ไฟล์: app/Http/Controllers/Staff/BorrowApprovalController.php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\EquipmentBorrow; // 1. import
use App\Models\User; // 2. import
use App\Notifications\BorrowRequestApproved; // 3. import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 4. import
use Illuminate\Support\Facades\Notification; // 5. import

class BorrowApprovalController extends Controller
{
    // (ฟังก์ชัน index() สำหรับแสดงรายการรอดำเนินการ)
    public function index() {
        $requests = EquipmentBorrow::where('status', 'pending')->latest()->paginate(10);
        // (ส่ง $requests ไปยัง View)
    }

    /**
     * ฟังก์ชันอนุมัติ
     */
    public function approve(EquipmentBorrow $borrowRequest)
    {
        // 1. อัปเดตสถานะ
        $borrowRequest->status = 'approved';
        
        // 2. บันทึกว่าใครอนุมัติ
        $borrowRequest->approved_by = Auth::id(); // บันทึก ID ของ Staff ที่กดอนุมัติ
        $borrowRequest->save();

        // 3. **ส่วนของการแจ้งเตือน**
        // 3.1 ค้นหา "นายก" (สมมติว่าคือ Manager) และ "เลขานุการ" (สมมติว่าคือ Staff บางคนที่มียศ)
        // (ในระบบจริง อาจต้องระบุ User ID ที่ชัดเจน)
        $usersToNotify = User::where('role', 'manager')
                            // ->orWhere('position', 'secretary') // (ถ้ามี)
                            ->get();

        // 3.2 สั่งส่ง Notification
        // Notification::send($usersToNotify, ...);
        // $usersToNotify: คนที่จะได้รับ (Collection)
        // new BorrowRequestApproved($borrowRequest): Object Notification พร้อมข้อมูล
        Notification::send($usersToNotify, new BorrowRequestApproved($borrowRequest));

        return back()->with('success', 'อนุมัติการยืมเรียบร้อยแล้ว');
    }

    // (ฟังก์ชัน reject() ... )
}