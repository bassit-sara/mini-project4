<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
    Schema::create('participants', function (Blueprint $table) {
        $table->id();
        $table->foreignId('activity_id')->constrained()->onDelete('cascade');
        $table->foreignId('member_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
        
        // $table->unique([...]);
        // ป้องกันไม่ให้ 1 คน สมัคร 1 กิจกรรม ซ้ำซ้อน
        $table->unique(['activity_id', 'member_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
