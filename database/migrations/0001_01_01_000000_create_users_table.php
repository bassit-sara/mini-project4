<?php
// ไฟล์: database/migrations/2014_10_12_000000_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create คือคำสั่งให้สร้างตารางใหม่ชื่อ 'users'
        Schema::create('users', function (Blueprint $table) {
            
            // $table->id(); 
            // สร้างคอลัมน์ 'id' (Primary Key, Auto-Increment, BigInt)
            $table->id();

            // $table->string('name');
            // สร้างคอลัมน์ 'name' ชนิด VARCHAR (เก็บชื่อ-สกุล)
            $table->string('name');

            // $table->string('student_id')->unique()->nullable();
            // สร้างคอลัมน์ 'student_id' (รหัสนักศึกษา)
            // ->unique() คือ ห้ามมีข้อมูลซ้ำกันในคอลัมน์นี้
            // ->nullable() คือ อนุญาตให้มีค่าว่างได้ (เผื่อสำหรับ Admin/Manager ที่ไม่ใช่ นศ.)
            $table->string('student_id')->unique()->nullable();

            // $table->string('email')->unique();
            // สร้างคอลัมน์ 'email' และห้ามซ้ำ
            $table->string('email')->unique();

            // $table->timestamp('email_verified_at')->nullable();
            // เก็บวันที่และเวลาที่ยืนยันอีเมล (ถ้ามี)
            $table->timestamp('email_verified_at')->nullable();

            // $table->string('password');
            // เก็บรหัสผ่าน (ที่ถูก Hash แล้ว)
            $table->string('password');

            // $table->enum('role', ...);
            // **สำคัญ:** สร้างคอลัมน์ 'role' ชนิด ENUM (จำกัดค่าที่เป็นไปได้)
            // สำหรับเก็บสิทธิ์ 4 ประเภทตามที่คุณกำหนด
            // ->default('member') คือ ถ้าไม่ระบุ ค่าเริ่มต้นจะเป็น 'member'
            $table->enum('role', ['admin', 'manager', 'staff', 'member'])->default('member');

            // $table->enum('status', ...);
            // **สำคัญ:** สร้างคอลัมน์ 'status' สำหรับ Process 1 (อนุมัติสมาชิก)
            // ->default('pending') คือ สถานะเริ่มต้นคือ 'รอดำเนินการ'
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // $table->rememberToken();
            // สร้างคอลัมน์สำหรับฟีเจอร์ "จดจำฉัน" (Remember Me)
            $table->rememberToken();

            // $table->timestamps();
            // สร้าง 2 คอลัมน์อัตโนมัติ: 'created_at' (เวลาสร้าง) และ 'updated_at' (เวลาแก้ไข)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('users');
        // คำสั่งสำหรับตอน 'rollback' (ย้อนกลับ) คือให้ลบตาราง 'users' ทิ้ง
        Schema::dropIfExists('users');
    }
};