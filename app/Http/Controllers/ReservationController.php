<?php
// ไฟล์: app/Http/Controllers/ReservationController.php

// 1. (สำคัญ!) นี่คือ Namespace ที่ถูกต้องสำหรับ Controller นี้
namespace App\Http\Controllers;

// 2. Import คลาสที่จำเป็น
use App\Models\Reservation; // Model ของการจอง
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // สำหรับหา ID คนที่ Login
use Illuminate\View\View; // สำหรับ return หน้า View
use Illuminate\Http\RedirectResponse; // สำหรับ return redirect

// 3. (สำคัญ!) ชื่อคลาสต้องตรงกับชื่อไฟล์
class ReservationController extends Controller
{
    /**
     * หน้าแสดง "ประวัติการจอง" (ของฉัน)
     * (GET /reservations)
     */
    public function index(): View
    {
        // ถ้าเป็น Member, ให้เห็นเฉพาะของตัวเอง
        if (Auth::user()->role == 'member') {
            $reservations = Reservation::where('member_id', Auth::id())
                                ->latest()
                                ->paginate(10);
        } else {
            // ถ้าเป็น Staff/Admin, ให้เห็นของทุกคน
            $reservations = Reservation::latest()->paginate(10);
        }

        // ไปที่ 'resources/views/reservations/index.blade.php'
        return view('reservations.index', compact('reservations'));
    }

    /**
     * 🚨
     * 🚨 นี่คือฟังก์ชันที่ Route (GET /reservations/create) เรียกหา 🚨
     * 🚨
     * หน้าแสดง "ฟอร์ม" สร้างคำขอจองใหม่
     */
    public function create(): View
    {
        // สั่งให้แสดงผล View 'resources/views/reservations/create.blade.php'
        return view('reservations.create');
    }

    /**
     * ฟังก์ชันสำหรับ "รับข้อมูล" จากฟอร์ม (บันทึกลง DB)
     * (POST /reservations)
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. ตรวจสอบข้อมูล (Validation)
        $validated = $request->validate([
            'place_name' => 'required|string|max:255',
            'purpose' => 'required|string',
            'start_date' => 'required|date|after_or_equal:now',
            'end_date' => 'required|date|after:start_date',
        ]);
        
        // 2. สร้างข้อมูล (เพิ่ม member_id และ status)
        Reservation::create(array_merge($validated, [
            'member_id' => Auth::id(), // ใส่ ID ของคนจอง
            'status' => 'pending', // สถานะเริ่มต้น
        ]));

        // 3. กลับไปหน้า List พร้อมข้อความสำเร็จ
        return redirect()->route('reservations.index')->with('success', 'ส่งคำขอจองสถานที่เรียบร้อยแล้ว');
    }

    /**
     * หน้าแสดง "รายละเอียด" (ถ้ามี)
     * (GET /reservations/{reservation})
     */
    public function show(Reservation $reservation): View
    {
        // 3. ตรวจสอบสิทธิ์ (เจ้าของ หรือ Staff ขึ้นไป)
        if (Auth::user()->role == 'member' && $reservation->member_id !== Auth::id()) {
            abort(403); // ถ้าไม่ใช่เจ้าของ โยน 403
        }

        // (เรายังไม่ได้สร้างไฟล์ show.blade.php ถ้าสร้างแล้วให้เปิดบรรทัดล่าง)
        // return view('reservations.show', compact('reservation'));
        
        // ตอนนี้ให้กลับไปหน้า List ก่อน
        return redirect()->route('reservations.index');
    }
}
