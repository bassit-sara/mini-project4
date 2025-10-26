<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void {
    Schema::create('issues', function (Blueprint $table) {
        $table->id();

        // $table->foreignId('member_id')->constrained('users');
        // เชื่อมกับตาราง 'users' โดยใช้คอลัมน์ 'member_id'
        $table->foreignId('member_id')->constrained('users')->onDelete('cascade');

        $table->string('title'); // หัวข้อปัญหา
        $table->text('description'); // รายละเอียด
        $table->text('reply')->nullable(); // คำตอบจาก Manager
        $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
