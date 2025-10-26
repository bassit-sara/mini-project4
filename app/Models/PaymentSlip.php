<?php
// ไฟล์: app/Models/PaymentSlip.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentSlip extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'payment_id',
        'file_path', // ที่อยู่ของไฟล์สลิปที่ Upload
    ];
    
    // ความสัมพันธ์: 1 Slip "เป็นของ" (BelongsTo) Payment
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}