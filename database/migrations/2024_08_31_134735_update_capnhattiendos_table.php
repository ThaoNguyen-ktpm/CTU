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
        Schema::table('capnhattiendos', function (Blueprint $table) {
            $table->dropColumn('DuongDanFile');  // Xóa cột DuongDanFile
            $table->dropColumn('TenNguoiNop');   // Xóa cột TenNguoiNop
            $table->integer('TienDo')->after('NoiDung');  // Thêm cột TienDo để lưu % tiến độ
        });

         // Cập nhật bảng congviecs
         Schema::table('duans', function (Blueprint $table) {
            $table->integer('TrangThai')->change();
        });
         // Cập nhật bảng congviecs
         Schema::table('congviecs', function (Blueprint $table) {
            $table->integer('TrangThai')->change();
        });
         // Cập nhật bảng congviecs
         Schema::table('giaoviecs', function (Blueprint $table) {
            $table->integer('TrangThai')->change();
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('capnhattiendos', function (Blueprint $table) {
            $table->string('DuongDanFile'); // Phục hồi cột DuongDanFile
            $table->string('TenNguoiNop');  // Phục hồi cột TenNguoiNop
            $table->dropColumn('TienDo');   // Xóa cột TienDo
        });
         // Cập nhật bảng congviecs
         Schema::table('duans', function (Blueprint $table) {
            $table->string('TrangThai')->change();
        });
          // Cập nhật bảng congviecs
          Schema::table('congviecs', function (Blueprint $table) {
            $table->string('TrangThai')->change();
        });
          // Cập nhật bảng congviecs
          Schema::table('giaoviecs', function (Blueprint $table) {
            $table->string('TrangThai')->change();
        });
    }
};
