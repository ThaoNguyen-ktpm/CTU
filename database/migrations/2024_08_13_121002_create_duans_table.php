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
        Schema::create('duans', function (Blueprint $table) {
            $table->id();
            $table->string('TenDuAn');
            $table->text('Mota');
            $table->string('TrangThai');
            $table->foreignId('MaNguoiTao')->constrained('nguoidungs');
            $table->boolean('IsActive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duans');
    }
};
