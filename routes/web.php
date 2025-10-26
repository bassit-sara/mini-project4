<?php

// ไฟล์: routes/web.php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Import Controllers (รวมทุก Controllers ที่เราใช้ทั้งหมด)
|--------------------------------------------------------------------------
*/

// Controllers หลัก (สำหรับ Member หรือ Public)
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ClubStaffController;
use App\Http\Controllers\EquipmentBorrowController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReportController;

// Controllers ส่วน Admin
use App\Http\Controllers\Admin\UserController as AdminUserController;

// Controllers ส่วน Staff
use App\Http\Controllers\Staff\ActivityController as StaffActivityController;
use App\Http\Controllers\Staff\ClubStaffController as StaffClubStaffController;
use App\Http\Controllers\Staff\BorrowApprovalController;
use App\Http\Controllers\Staff\ReservationApprovalController;
use App\Http\Controllers\Staff\AccountingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. หน้า Public
Route::get('/', function () {
    return view('welcome');
});

// 2. หน้า Dashboard (Breeze สร้างให้)
Route::get('/dashboard', function () {
    // เราสามารถย้าย Logic จาก ReportController มาไว้ที่นี่ได้
    // เพื่อให้ Dashboard แสดงผลสรุปตาม Role
    if (in_array(auth()->user()->role, ['manager', 'admin'])) {
        return redirect()->route('reports.index'); // ถ้าเป็น Admin/Manager ให้ไปหน้ารายงาน
    }
    return view('dashboard'); // Member/Staff เห็นหน้า Dashboard ปกติ
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Routes ที่ต้อง Login (auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // --- ส่วน Profile (Breeze สร้างให้) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    // --- Process 1: ระบบอนุมัติสมาชิก (Admin/Staff) ---
    Route::middleware(['role:admin,staff'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
        Route::patch('/users/{user}/reject', [AdminUserController::class, 'reject'])->name('users.reject');
    });

    
    // --- Process 2: รายชื่อบุคลากร (Club Staff) ---
    // Member (ดูได้อย่างเดียว)
    Route::middleware(['role:member,staff,manager,admin'])->group(function () {
        Route::get('/club-staff', [ClubStaffController::class, 'index'])->name('club-staff.index');
    });
    // Staff/Manager (จัดการ CRUD)
    Route::middleware(['role:staff,manager,admin'])->prefix('staff')->name('staff.')->group(function () {
        Route::resource('club-staff', StaffClubStaffController::class);
    });

    
    // --- Process 3: แจ้งปัญหา / ถามข้อสงสัย (Q&A) ---
    // (ทุกคนที่ Login สามารถสร้างและดูได้)
    Route::middleware(['role:member,staff,manager,admin'])->group(function () {
        Route::resource('issues', IssueController::class)->only([
            'index', 'create', 'store', 'show'
        ]);
        // (อาจเพิ่ม Route สำหรับ Manager เพื่อ Reply)
        // Route::patch('/issues/{issue}/reply', [IssueController::class, 'reply'])->name('issues.reply')->middleware('role:manager,admin');
    });

    
    // --- Process 4: การจัดกิจกรรม (Activity Management) ---
    // Member (ดูและเข้าร่วม)
    Route::middleware(['role:member,staff,manager,admin'])->group(function () {
        Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
        Route::post('/activities/{activity}/join', [ActivityController::class, 'join'])->name('activities.join');
        Route::delete('/activities/{activity}/leave', [ActivityController::class, 'leave'])->name('activities.leave');
    });
    // Staff/Manager (จัดการ CRUD)
    Route::middleware(['role:staff,manager,admin'])->prefix('staff')->name('staff.')->group(function () {
        Route::resource('activities', StaffActivityController::class);
    });

    
    // --- Process 5: ระบบยืมอุปกรณ์ (Equipment Borrow) ---
    // Member (สร้างคำขอ)
    Route::middleware(['role:member,staff,manager,admin'])->group(function () {
        Route::resource('borrow', EquipmentBorrowController::class)->only([
            'index', 'create', 'store', 'show'
        ]);
    });
    // Staff (อนุมัติ)
    Route::middleware(['role:staff,manager,admin'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('borrow-requests', [BorrowApprovalController::class, 'index'])->name('borrow.index');
        Route::patch('borrow-requests/{borrowRequest}/approve', [BorrowApprovalController::class, 'approve'])->name('borrow.approve');
        Route::patch('borrow-requests/{borrowRequest}/reject', [BorrowApprovalController::class, 'reject'])->name('borrow.reject');
    });


    // --- Process 6: ระบบจองสถานที่ (Room Reservation) ---
    // Member (สร้างคำขอ)
    Route::middleware(['role:member,staff,manager,admin'])->group(function () {
        Route::resource('reservations', ReservationController::class)->only([
            'index', 'create', 'store', 'show'
        ]);
    });
    // Staff (อนุมัติ)
    Route::middleware(['role:staff,manager,admin'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('reservations', [ReservationApprovalController::class, 'index'])->name('reservations.index');
        Route::patch('reservations/{reservation}/approve', [ReservationApprovalController::class, 'approve'])->name('reservations.approve');
        Route::patch('reservations/{reservation}/reject', [ReservationApprovalController::class, 'reject'])->name('reservations.reject');
    });

    
    // --- Process 7: ระบบบัญชี (Accounting) ---
    // (เฉพาะ Manager/Admin)
    Route::middleware(['role:manager,admin'])->prefix('staff')->name('staff.')->group(function () {
        Route::resource('accounting', AccountingController::class);
    });

    
    // --- Process 8: รายงาน (Reports) ---
    // (เฉพาะ Manager/Admin)
    Route::middleware(['role:manager,admin'])->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

});


/*
|--------------------------------------------------------------------------
| Routes ของระบบยืนยันตัวตน (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';