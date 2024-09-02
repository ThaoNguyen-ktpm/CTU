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
        Schema::create('congviecs', function (Blueprint $table) {
            $table->id();
            $table->string('TenCongViec');
            $table->text('MoTa');   
            $table->dateTime('NgayBatDau');
            $table->dateTime('NgayKetThuc');
            $table->string('LinkTaiLieu')->nullable();
            $table->integer('TrangThai');
            $table->foreignId('MaDuAn')->constrained('duans');
            $table->foreignId('MaThucHien')->constrained('thuchiens');
            $table->foreignId('MaNguoiTao')->constrained('nguoidungs');
            $table->boolean('IsActive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('congviecs');
    }
};
