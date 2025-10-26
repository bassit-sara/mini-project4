<?php

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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // 🚨
            // 🚨 นี่คือบรรทัดสำคัญที่คาดว่าคุณลืมใส่ 🚨
            // 🚨 (Foreign Key ที่เชื่อมกับตาราง 'users')
            //
            $table->foreignId('member_id')->constrained('users')->onDelete('cascade');
            
            // ----------------------------------------------

            $table->string('place_name');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('purpose');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            // (approved_by ควรเป็น nullable เพราะตอนแรกยังไม่มีคนอนุมัติ)
            $table->foreignId('approved_by')->nullable()->constrained('users');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }

};

