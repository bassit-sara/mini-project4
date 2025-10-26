<?php
// ไฟล์: app/Notifications/BorrowRequestApproved.php

namespace App\Notifications;

use App\Models\EquipmentBorrow; // 1. import
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
// 2. import ช่องทาง (เช่น Mail)
use Illuminate\Notifications\Messages\MailMessage; 

class BorrowRequestApproved extends Notification
{
    use Queueable;

    // 3. สร้างตัวแปร public เพื่อเก็บข้อมูล
    public EquipmentBorrow $borrowRequest;

    /**
     * 4. รับค่า (คำขอยืม) เข้ามาตอน new
     */
    public function __construct(EquipmentBorrow $borrowRequest)
    {
        $this->borrowRequest = $borrowRequest;
    }

    /**
     * 5. ระบุช่องทางที่จะส่ง (เช่น 'mail', 'database')
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; // ส่งทั้ง Email และ เก็บใน DB
    }

    /**
     * 6. สร้างข้อความสำหรับ Email
     */
    public function toMail(object $notifiable): MailMessage
    {
        // (เรายังไม่ได้ดึงชื่อคนยืม แต่สามารถทำได้ผ่าน Relationship)
        return (new MailMessage)
                    ->subject('มีการอนุมัติการยืมอุปกรณ์')
                    ->line('คำขอยืมอุปกรณ์ (ID: ' . $this->borrowRequest->id . ') ได้รับการอนุมัติแล้ว')
                    ->line('รายการ: ' . $this->borrowRequest->item_name)
                    ->action('ดูรายละเอียด', url('/staff/borrow-requests'))
                    ->line('ขอบคุณครับ');
    }

    /**
     * 7. สร้างข้อมูลสำหรับเก็บลง 'database'
     * (ข้อมูลนี้จะถูกเก็บในตาราง 'notifications')
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'อนุมัติการยืม ' . $this->borrowRequest->item_name,
            'request_id' => $this->borrowRequest->id,
            'url' => '/staff/borrow-requests',
        ];
    }
}