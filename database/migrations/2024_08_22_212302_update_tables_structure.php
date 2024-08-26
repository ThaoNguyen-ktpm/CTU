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
         // Cập nhật bảng congviecs
         Schema::table('congviecs', function (Blueprint $table) {
            $table->dateTime('NgayBatDau')->change();
            $table->dateTime('NgayKetThuc')->change();
        });

        // Cập nhật bảng thuchiens
        Schema::table('thuchiens', function (Blueprint $table) {
            $table->dateTime('NgayBatDau')->change();
            $table->dateTime('NgayKetThuc')->change();
        });

        // Cập nhật bảng giaoviecs
        Schema::table('giaoviecs', function (Blueprint $table) {
            $table->string('TrangThai')->after('MaCongViec');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Khôi phục bảng congviecs
         Schema::table('congviecs', function (Blueprint $table) {
            $table->date('NgayBatDau')->change();
            $table->date('NgayKetThuc')->change();
        });

        // Khôi phục bảng thuchiens
        Schema::table('thuchiens', function (Blueprint $table) {
            $table->date('NgayBatDau')->change();
            $table->date('NgayKetThuc')->change();
        });

        // Xóa cột 'TrangThai' từ bảng giaoviecs
        Schema::table('giaoviecs', function (Blueprint $table) {
            $table->dropColumn('TrangThai');
        });
    
    }
};
