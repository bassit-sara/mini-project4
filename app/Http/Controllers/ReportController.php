<?php
// ไฟล์: app/Http/Controllers/ReportController.php
namespace App\Http\Controllers;

// 1. import Models ทั้งหมดที่จะใช้
use App\Models\User;
use App\Models\Issue;
use App\Models\Activity;
use App\Models\EquipmentBorrow;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * หน้าแสดงรายงานสรุป (Dashboard)
     */
    public function index(): View
    {
        // 1. ดึงข้อมูลสรุป (ตัวอย่าง)
        
        // Process 1: สมาชิก
        $totalMembers = User::where('role', 'member')->where('status', 'approved')->count();
        $pendingMembers = User::where('role', 'member')->where('status', 'pending')->count();
        
        // Process 3: Q&A
        $pendingIssues = Issue::where('status', 'pending')->count();
        $resolvedIssues = Issue::where('status', 'resolved')->count();
        
        // Process 5: ยืมของ
        $pendingBorrows = EquipmentBorrow::where('status', 'pending')->count();
        
        // Process 6: จองที่
        $pendingReservations = Reservation::where('status', 'pending')->count();
        
        // Process 7: บัญชี
        $unpaidAmount = Payment::where('status', 'pending')->sum('amount');
        
        // 2. ส่งข้อมูลทั้งหมดไปยัง View
        return view('reports.index', compact(
            'totalMembers',
            'pendingMembers',
            'pendingIssues',
            'resolvedIssues',
            'pendingBorrows',
            'pendingReservations',
            'unpaidAmount'
        ));
    }
}