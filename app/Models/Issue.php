<?php
// ไฟล์: app/Models/Issue.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // import

class Issue extends Model
{
    use HasFactory;

    // protected $table = 'my_issues_table';
    // (ไม่ต้องใส่ ถ้าชื่อตารางเป็นพหูพจน์ของชื่อคลาส เช่น class Issue -> ตาราง issues)

    // protected $fillable = [...];
    // **สำคัญมาก (Mass Assignment):**
    // ระบุว่าคอลัมน์ใดบ้างที่อนุญาตให้ "กรอกข้อมูลทีเดียวทั้งหมด"
    // เช่น Issue::create($request->all());
    // เพื่อป้องกันการแอบยัดข้อมูลเข้ามาในคอลัมน์ที่เราไม่ต้องการ (เช่น แอบแก้ 'status')
    protected $fillable = [
        'member_id',
        'title',
        'description',
        // เราไม่ใส่ 'reply' หรือ 'status' ที่นี่ เพราะ Member ไม่ควรกรอกได้เอง
    ];

    /**
     * สร้างความสัมพันธ์ว่า Issue นี้ "เป็นของ" (BelongsTo) User คนไหน
     */
    public function member(): BelongsTo
    {
        // return $this->belongsTo(User::class, 'member_id');
        // บอกว่า Model นี้ (Issue) มีความสัมพันธ์ BelongsTo กับ Model 'User'
        // โดยเชื่อมกันผ่าน Foreign Key 'member_id' (ในตาราง issues)
        return $this->belongsTo(User::class, 'member_id');
    }
}