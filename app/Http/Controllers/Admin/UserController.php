<?php
// ไฟล์: app/Http/Controllers/Admin/UserController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // 1. import Model User
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; // 2. import
use Illuminate\View\View; // 3. import

class UserController extends Controller
{
    /**
     * หน้าแสดงรายชื่อสมาชิกทั้งหมด (ทั้งที่รออนุมัติและอนุมัติแล้ว)
     */
    public function index(): View
    {
        // $users = User::latest()->paginate(15);
        // ดึง User ทั้งหมด เรียงจากใหม่ไปเก่า แบ่งหน้า
        $users = User::latest()->paginate(15);

        // return view('admin.users.index', ...);
        // ส่งตัวแปร $users ไปที่ View 'resources/views/admin/users/index.blade.php'
        return view('admin.users.index', compact('users'));
    }

    /**
     * ฟังก์ชันสำหรับ "อนุมัติ" สมาชิก
     * (User $user) คือ Route Model Binding (ดึง User จาก ID ใน URL อัตโนมัติ)
     */
    public function approve(User $user): RedirectResponse
    {
        // $user->status = 'approved';
        // อัปเดตคอลัมน์ 'status' ของ User คนนี้เป็น 'approved'
        $user->status = 'approved';
        
        // $user->save();
        // บันทึกการเปลี่ยนแปลงลงฐานข้อมูล
        $user->save();

        // return back()
        // สั่งให้ redirect กลับไปหน้าเดิม (หน้าที่กดปุ่ม)
        // ->with('success', '...')
        // พร้อมส่ง Flash Message
        return back()->with('success', 'อนุมัติสมาชิก ' . $user->name . ' เรียบร้อยแล้ว');
    }

    /**
     * ฟังก์ชันสำหรับ "ปฏิเสธ" สมาชิก
     */
    public function reject(User $user): RedirectResponse
    {
        // อัปเดต status เป็น 'rejected'
        $user->status = 'rejected';
        $user->save();

        return back()->with('warning', 'ปฏิเสธสมาชิก ' . $user->name . ' เรียบร้อยแล้ว');
    }
}