<?php
// ไฟล์: app/Notifications/ReservationApproved.php
namespace App\Notifications;

use App\Models\Reservation; // 1. เปลี่ยน
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationApproved extends Notification
{
    use Queueable;

    public Reservation $reservation; // 2. เปลี่ยน

    public function __construct(Reservation $reservation) // 3. เปลี่ยน
    {
        $this->reservation = $reservation; // 4. เปลี่ยน
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database']; // ส่ง Email และ เก็บใน DB
    }

    public function toMail(object $notifiable): MailMessage
    {
        // 5. เปลี่ยนข้อความ
        return (new MailMessage)
                    ->subject('มีการอนุมัติการจองสถานที่')
                    ->line('การจองสถานที่ (ID: ' . $this->reservation->id . ') ได้รับการอนุมัติแล้ว')
                    ->line('สถานที่: ' . $this->reservation->place_name)
                    ->action('ดูรายละเอียด', url('/reservations'));
    }

    public function toArray(object $notifiable): array
    {
        // 6. เปลี่ยนข้อความ
        return [
            'message' => 'อนุมัติการจอง ' . $this->reservation->place_name,
            'request_id' => $this->reservation->id,
            'url' => '/reservations',
        ];
    }
}