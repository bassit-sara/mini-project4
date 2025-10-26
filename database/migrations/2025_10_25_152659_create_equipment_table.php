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
        // 🚨
        // 🚨 ชื่อตารางตรงนี้ต้องเป็น 'equipment_borrows' (พหูพจน์)
        // 🚨
        Schema::create('equipment_borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('users')->onDelete('cascade');
            $table->string('item_name');
            $table->integer('quantity');
            $table->date('borrow_date');
            $table->date('return_date');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 🚨 ต้องเป็นชื่อเดียวกัน
        Schema::dropIfExists('equipment_borrows');
    }
};
