<?php

namespace App\Http\Controllers;

use App\Models\Activity; // 1. import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 2. import
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ActivityController extends Controller
{
    /**
     * หน้าแสดงรายการกิจกรรมทั้งหมด (สำหรับ Member)
     */
    public function index(): View
    {
        // ดึง Activity ทั้งหมด
        $activities = Activity::latest()->paginate(10);
        
        // return view('activities.index', ...);
        // ไปที่ 'resources/views/activities/index.blade.php'
        return view('activities.index', compact('activities'));
    }

    /**
     * ฟังก์ชันสำหรับ "เข้าร่วม" กิจกรรม
     */
    public function join(Activity $activity): RedirectResponse
    {
        // $user = Auth::user();
        // ดึง User ที่ Login อยู่
        $user = Auth::user();

        // $activity->participants()->attach($user->id);
        // **สำคัญ (Many-to-Many):**
        // ->participants() คือการเรียก Relationship ที่เราสร้างใน Model
        // ->attach($user->id) คือคำสั่ง "เพิ่ม" ข้อมูลลงในตารางกลาง (participants)
        // โดยจะเพิ่ม Row ใหม่ที่มี 'activity_id' = $activity->id และ 'member_id' = $user->id
        // (Laravel จะป้องกันการ Join ซ้ำอัตโนมัติ ถ้ามี Unique Key ใน DB)
        $activity->participants()->attach($user->id);

        return back()->with('success', 'คุณได้เข้าร่วมกิจกรรม ' . $activity->name);
    }

    /**
     * ฟังก์ชันสำหรับ "ยกเลิก" การเข้าร่วม
     */
    public function leave(Activity $activity): RedirectResponse
    {
        $user = Auth::user();

        // $activity->participants()->detach($user->id);
        // **สำคัญ (Many-to-Many):**
        // ->detach($user->id) คือคำสั่ง "ลบ" ข้อมูลออกจากตารางกลาง (participants)
        // ที่ตรงกับ 'activity_id' และ 'member_id' นี้
        $activity->participants()->detach($user->id);

        return back()->with('success', 'คุณได้ยกเลิกการเข้าร่วมกิจกรรม ' . $activity->name);
    }
}
