<?php
// ไฟล์: app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ใช้สำหรับตรวจสอบการ Login
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  // ...$roles คือการรับค่าพารามิเตอร์ (สิทธิ์) ที่ส่งมาจาก Route มาเก็บเป็น Array
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Auth::check() ตรวจสอบว่าผู้ใช้ Login แล้วหรือยัง
        // Auth::user()->role คือการดึง 'role' (เช่น 'member', 'admin') ของคนที่ Login อยู่
        // !in_array(...) คือ ตรวจสอบว่า role ของผู้ใช้ *ไม่* อยู่ในกลุ่ม $roles ที่อนุญาต
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            
            // ถ้าไม่มีสิทธิ์ ให้โยน Error 403 (Forbidden)
            abort(403, 'UNAUTHORIZED ACTION.');
        }

        // $next($request);
        // ถ้ามีสิทธิ์, ปล่อยให้ Request นี้วิ่งต่อไปยัง Controller หรือ View ที่ต้องการ
        return $next($request);
    }
}