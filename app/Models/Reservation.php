<?php
// ไฟล์: app/Models/Reservation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;
    
    // 1. ระบุ fields ที่กรอกได้
    protected $fillable = [
        'member_id',
        'place_name',
        'start_date',
        'end_date',
        'purpose',
        'status', // Member ควรตั้งค่าเริ่มต้นเป็น 'pending'
        'approved_by',
    ];

    // 2. บอก Laravel ว่า field ไหนเป็น Date Object
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // 3. ความสัมพันธ์: "การจองนี้ เป็นของ User คนไหน"
    public function member(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}