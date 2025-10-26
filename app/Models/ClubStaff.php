<?php
// ไฟล์: app/Models/ClubStaff.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // 1. import

class ClubStaff extends Model
{
    use HasFactory;

    // 2. ระบุตาราง (เผื่อชื่อไม่ตรงตาม convention)
    protected $table = 'club_staff';

    // 3. ระบุ field ที่กรอกได้ (Mass Assignment)
    protected $fillable = [
        'user_id',
        'position',
        'responsibility',
        'contact',
        'photo',
    ];

    /**
     * 4. ความสัมพันธ์ว่า "โปรไฟล์นี้ เป็นของ User คนไหน" (Inverse)
     */
    public function user(): BelongsTo
    {
        // เชื่อมกับ Model 'User' ผ่าน Foreign Key 'user_id'
        return $this->belongsTo(User::class, 'user_id');
    }
}
