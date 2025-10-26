<?php
// ไฟล์: app/Http/Controllers/IssueController.php

namespace App\Http\Controllers;

use App\Models\Issue; // 1. import Model Issue
use Illuminate\Http\Request; // 2. import Request (สำหรับรับข้อมูลจากฟอร์ม)
use Illuminate\Support\Facades\Auth; // 3. import Auth (สำหรับหา ID คนที่ login)
use Illuminate\View\View; // 4. import View
use Illuminate\Http\RedirectResponse; // 5. import RedirectResponse (สำหรับ redirect)

class IssueController extends Controller
{
    /**
     * Display a listing of the resource. (หน้าแสดงรายการ)
     */
    public function index(): View // ระบุ return type เป็น View
    {
        // Auth::user()->role คือการดึง Role ของคนที่ Login อยู่
        if (Auth::user()->role == 'manager' || Auth::user()->role == 'admin') {
            // ถ้าเป็น Manager/Admin: ให้เห็นทุก Issues
            // Issue::latest() คือ ดึงข้อมูลจากตาราง 'issues' ทั้งหมด
            // ->latest() คือ เรียงจากใหม่ไปเก่า
            // ->paginate(10) คือ แบ่งหน้า หน้าละ 10 รายการ
            $issues = Issue::with('member')->latest()->paginate(10);
        } else {
            // ถ้าเป็น Member ธรรมดา:
            // Issue::where('member_id', Auth::id())
            // คือ ดึงข้อมูลเฉพาะที่ 'member_id' ตรงกับ ID ของคนที่ Login อยู่
            $issues = Issue::where('member_id', Auth::id())
                        ->latest()
                        ->paginate(10);
        }

        // return view('issues.index', ...);
        // คือการสั่งให้แสดงผลไฟล์ 'resources/views/issues/index.blade.php'
        // compact('issues') คือการส่งตัวแปร $issues เข้าไปยัง View
        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource. (หน้าฟอร์มสำหรับสร้าง)
     */
    public function create(): View
    {
        // สั่งให้แสดงผลไฟล์ 'resources/views/issues/create.blade.php'
        return view('issues.create');
    }

    /**
     * Store a newly created resource in storage. (ฟังก์ชันรับข้อมูลจากฟอร์ม)
     */
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([...]);
        // **สำคัญ:** ตรวจสอบความถูกต้องของข้อมูล (Validation)
        $validatedData = $request->validate([
            // 'title' ต้องมี (required), เป็นข้อความ (string), ไม่เกิน 255 ตัวอักษร (max:255)
            'title' => 'required|string|max:255',
            // 'description' ต้องมี (required), เป็นข้อความ (string)
            'description' => 'required|string',
        ]);

        // Issue::create([...]);
        // สร้างข้อมูลใหม่ลงตาราง 'issues' (โดยใช้ Mass Assignment ที่ตั้งค่าใน Model)
        Issue::create([
            // 'member_id' => Auth::id(),
            // เอา ID ของคนที่ Login (Auth::id()) มาใส่ในคอลัมน์ 'member_id'
            'member_id' => Auth::id(),

            // 'title' => $validatedData['title'],
            // เอาข้อมูล 'title' ที่ผ่านการ validate แล้วมาใส่
            'title' => $validatedData['title'],

            // 'description' => $validatedData['description'],
            // เอาข้อมูล 'description' ที่ผ่านการ validate แล้วมาใส่
            'description' => $validatedData['description'],

            // 'status' => 'pending' (เราตั้งค่า default ไว้ใน migration แล้ว แต่ใส่ซ้ำเพื่อความชัวร์ก็ได้)
            'status' => 'pending',
        ]);

        // return redirect()->route('issues.index')
        // สั่งให้ redirect (ย้ายหน้า) กลับไปที่ Route ที่ชื่อ 'issues.index' (หน้า List)
        // ->with('success', '...')
        // คือการส่ง "ข้อความสำเร็จ" (Flash Message) กลับไปด้วย
        return redirect()->route('issues.index')->with('success', 'แจ้งปัญหาเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource. (หน้าแสดงรายละเอียด 1 รายการ)
     */
    public function show(Issue $issue): View // ใช้ Route Model Binding
    {
        // (Issue $issue)
        // **สำคัญ (Route Model Binding):**
        // Laravel จะไปหา Issue ที่มี id ตรงกับ {issue} ที่ส่งมาจาก URL ให้อัตโนมัติ
        // และถ้าหาไม่เจอ จะโยน 404 Not Found ให้เลย

        // **เพิ่มการตรวจสอบสิทธิ์:**
        // Member ต้องเป็นเจ้าของ Issue นี้เท่านั้นถึงจะดูได้
        // (Manager/Admin ดูได้ทุกคน)
        if (Auth::user()->role == 'member' && $issue->member_id !== Auth::id()) {
            abort(403); // ถ้าไม่ใช่เจ้าของ โยน 403
        }

        // ส่งตัวแปร $issue (ที่ดึงมาอัตโนมัติ) ไปยัง View 'issues.show'
        return view('issues.show', compact('issue'));
    }

    // ... (ฟังก์ชัน edit, update, destroy จะใช้โดย Manager/Admin ซึ่งจะซับซ้อนขึ้น)
}