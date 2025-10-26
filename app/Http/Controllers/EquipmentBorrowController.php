<?php

    namespace App\Http\Controllers;

    use App\Models\EquipmentBorrow; // 1. Import Model
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth; // 2. Import Auth
    use Illuminate\View\View; // 3. Import View
    use Illuminate\Http\RedirectResponse; // 4. Import Redirect

    class EquipmentBorrowController extends Controller
    {
        /**
         * หน้าแสดง "ประวัติการยืม" (ของฉัน)
         * (GET /borrow)
         */
        public function index(): View
        {
            // ถ้าเป็น Member, ให้เห็นเฉพาะของตัวเอง
            if (Auth::user()->role == 'member') {
                $borrows = EquipmentBorrow::where('member_id', Auth::id())
                                ->latest()
                                ->paginate(10);
            } else {
                // ถ้าเป็น Staff/Admin, ให้เห็นของทุกคน
                $borrows = EquipmentBorrow::latest()->paginate(10);
            }

            // ไปที่ 'resources/views/borrow/index.blade.php'
            return view('borrow.index', compact('borrows'));
        }

        /**
         * 🚨
         * 🚨 นี่คือฟังก์ชันที่ขาดไป! 🚨
         * 🚨
         * หน้าแสดง "ฟอร์ม" สร้างคำขอยืมใหม่
         * (GET /borrow/create)
         */
        public function create(): View
        {
            // สั่งให้แสดงผล View 'resources/views/borrow/create.blade.php'
            // (ซึ่งเราสร้างไฟล์นี้ไว้แล้วในขั้นตอนก่อน)
            return view('borrow.create');
        }

        /**
         * ฟังก์ชันสำหรับ "รับข้อมูล" จากฟอร์ม (บันทึกลง DB)
         * (POST /borrow)
         */
        public function store(Request $request): RedirectResponse
        {
            // 1. ตรวจสอบข้อมูล (Validation)
            $validated = $request->validate([
                'item_name' => 'required|string|max:255',
                'quantity' => 'required|numeric|min:1',
                'borrow_date' => 'required|date|after_or_equal:today',
                'return_date' => 'required|date|after_or_equal:borrow_date',
            ]);

            // 2. สร้างข้อมูล
            EquipmentBorrow::create(array_merge($validated, [
                'member_id' => Auth::id(), // ใส่ ID ของคนยืม
                'status' => 'pending',   // สถานะเริ่มต้น
            ]));

            // 3. กลับไปหน้า List พร้อมข้อความสำเร็จ
            return redirect()->route('borrow.index')->with('success', 'ส่งคำขอยืมอุปกรณ์เรียบร้อยแล้ว');
        }

        /**
         * หน้าแสดง "รายละเอียด" (ถ้ามี)
         * (GET /borrow/{borrow})
         */
        public function show(EquipmentBorrow $borrow): View
        {
            // ตรวจสอบสิทธิ์ (เจ้าของ หรือ Staff ขึ้นไป)
            if (Auth::user()->role == 'member' && $borrow->member_id !== Auth::id()) {
                abort(403);
            }

            // (เรายังไม่ได้สร้างไฟล์ show.blade.php แต่ถ้าจะสร้าง ก็ใช้หน้านี้)
            // return view('borrow.show', compact('borrow'));
            
            // หรือแค่ Redirect กลับไปหน้า List
            return redirect()->route('borrow.index');
        }
    }
