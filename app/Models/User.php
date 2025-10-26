<?php
// ไฟล์: app/Models/User.php

namespace App\Models;

// 1. ===== IMPORT STATEMENTS =====
// (นำเข้าคลาสทั้งหมดที่จำเป็น)

// นี่คือตัวที่แก้ Error "Authenticatable not found"
use Illuminate\Foundation\Auth\User as Authenticatable; 

// (Breeze/Laravel ใช้)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail; // (หากคุณใช้ระบบยืนยันอีเมล ให้เปิดบรรทัดนี้)

// (Relationships ที่เราใช้)
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


// 2. ===== CLASS DEFINITION =====
// (คลาส User ของคุณ ต้อง extends Authenticatable)

class User extends Authenticatable // (หากใช้ยืนยันอีเมล ให้เพิ่ม implements MustVerifyEmail)
{
    // 3. ===== TRAITS =====
    // (ใช้คุณสมบัติเสริม)
    use HasFactory, Notifiable;

    // 4. ===== PROPERTIES =====
    // (ตัวแปรที่ใช้ใน Model นี้)

    /**
     * The attributes that are mass assignable.
     * (ระบุ field ที่อนุญาตให้กรอกผ่าน $request->all())
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'student_id', // ที่เราเพิ่ม
        'role',       // ที่เราเพิ่ม
        'status',     // ที่เราเพิ่ม
    ];

    /**
     * The attributes that should be hidden for serialization.
     * (ซ่อน field เหล่านี้เมื่อแปลงเป็น JSON)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * (แปลงชนิดข้อมูลอัตโนมัติ)
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Hash รหัสผ่านอัตโนมัติ
        ];
    }


    // 5. ===== RELATIONSHIPS =====
    // (ความสัมพันธ์กับ Model อื่นๆ ที่เราสร้างไว้)

    /**
     * (Process 2) สร้างความสัมพันธ์ว่า User 1 คน "มีโปรไฟล์" (HasOne) ClubStaff
     */
    public function staffProfile(): HasOne
    {
        return $this->hasOne(ClubStaff::class, 'user_id');
    }

    /**
     * (Process 3) สร้างความสัมพันธ์ว่า User 1 คน "มีหลาย" (HasMany) Issues
     */
    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class, 'member_id');
    }

    /**
     * (Process 4) ความสัมพันธ์ Many-to-Many กับ Activity (ที่ User เข้าร่วม)
     */
    public function joinedActivities(): BelongsToMany
    {
        // 1. Activity::class: Model ปลายทาง
        // 2. 'participants': ตารางกลาง
        // 3. 'member_id': FK ที่อ้างอิงถึง Model นี้ (User)
        // 4. 'activity_id': FK ที่อ้างอิงถึง Model ปลายทาง (Activity)
        return $this->belongsToMany(Activity::class, 'participants', 'member_id', 'activity_id')
                    ->withTimestamps(); // (บันทึกเวลาที่ join)
    }

    /**
     * (Process 6) สร้างความสัมพันธ์ว่า User 1 คน "มีหลาย" (HasMany) Reservations
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'member_id');
    }

    // (คุณสามารถเพิ่ม Relationship สำหรับ Process 5 (EquipmentBorrow) และ 7 (Payments) ที่นี่ได้)

}