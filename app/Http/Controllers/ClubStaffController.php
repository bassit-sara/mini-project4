<?php
// ไฟล์: app/Http/Controllers/ClubStaffController.php

// 1. (สำคัญ!) แก้ Namespace ให้ถูกต้อง
// ต้องเป็น 'App\Http\Controllers' (ไม่ใช่ App\Http\Controllers\Staff)
namespace App\Http\Controllers;

// 2. Import สิ่งที่จำเป็น
use App\Http\Controllers\Controller;
use App\Models\ClubStaff;
use Illuminate\Http\Request;
use Illuminate\View\View;

// 3. ชื่อคลาสถูกต้อง (ClubStaffController)
class ClubStaffController extends Controller
{
    /**
     * หน้าแสดงรายชื่อบุคลากร (สำหรับ Member)
     * (GET /club-staff)
     * นี่คือฟังก์ชันที่ Route ของคุณเรียกหา
     */
    public function index(): View
    {
        // $staffs = ClubStaff::with('user')->get();
        // ->with('user') คือการ Eager Loading
        // ดึงข้อมูล User (ชื่อ, email) ที่เชื่อมกันมาด้วยใน Query เดียว
        $staffs = ClubStaff::with('user')->get();

        // ไปที่ View 'resources/views/club-staff/index.blade.php'
        return view('club-staff.index', compact('staffs'));
    }
}
