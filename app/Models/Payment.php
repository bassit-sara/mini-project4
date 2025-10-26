<?php
// ไฟล์: app/Models/Payment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;
    
    // (สมมติ Field ตาม Migration ที่ออกแบบไว้)
    protected $fillable = [
        'member_id',
        'related_id', // ID ที่เกี่ยวข้อง (เช่น ID การยืมของ)
        'related_type', // ประเภท (เช่น 'borrow', 'reservation')
        'amount',
        'reason',
        'status', // (เช่น 'pending', 'paid')
    ];

    // ความสัมพันธ์: 1 Payment "มีหลาย" (HasMany) Slips
    public function slips(): HasMany
    {
        return $this->hasMany(PaymentSlip::class);
    }
}