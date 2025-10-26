<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
    Schema::create('club_staff', function (Blueprint $table) {
        $table->id();
        
        // $table->foreignId('user_id')->constrained()->onDelete('cascade');
        // 'user_id' คือ Foreign Key (FK)
        // ->constrained() บอกว่า FK นี้ เชื่อมกับ Primary Key (id) ของตาราง 'users'
        // ->onDelete('cascade') ถ้า user ถูกลบ, ข้อมูล staff นี้จะถูกลบตามไปด้วย
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->string('position'); // ตำแหน่ง
        $table->text('responsibility'); // หน้าที่
        $table->string('contact')->nullable(); // ข้อมูลติดต่อ
        $table->string('photo')->nullable(); // URL รูปภาพ
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_staff');
    }
};
