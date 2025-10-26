<?php
// ไฟล์: app/Models/Activity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// 1. import
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 

class Activity extends Model
{
    // ... (use HasFactory)
    protected $fillable = ['name', 'description', 'start_time', 'end_time', 'location'];

    /**
     * ความสัมพันธ์ Many-to-Many กับ User (ที่เข้าร่วม)
     * ชื่อฟังก์ชัน: participants (ผู้เข้าร่วม)
     */
    public function participants(): BelongsToMany
    {
        // return $this->belongsToMany(User::class, 'participants', 'activity_id', 'member_id');
        // 1. User::class: Model ปลายทาง
        // 2. 'participants': "ตารางกลาง" (Pivot Table) ที่เราสร้างใน Migration
        // 3. 'activity_id': Foreign Key ในตารางกลาง ที่อ้างอิงถึง Model นี้ (Activity)
        // 4. 'member_id': Foreign Key ในตารางกลาง ที่อ้างอิงถึง Model ปลายทาง (User)
        return $this->belongsToMany(User::class, 'participants', 'activity_id', 'member_id')
                    // ->withTimestamps(); 
                    // (แนะนำ) ให้บันทึกเวลา (created_at) ตอนที่ Join ด้วย
                    ->withTimestamps();
    }
    
    // (เราจะข้าม organizers และ organizer_applications ไปก่อน เพื่อโฟกัสที่การ Join)
}
