<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Cập nhật bảng 'duans' để thêm cột 'TenMa' có thể NULL
        Schema::table('duans', function (Blueprint $table) {
            $table->string('TenMa')->nullable(); // Thêm cột tên mã, cho phép NULL
        });

        // Cập nhật bảng 'files' để thêm các cột có thể NULL
        Schema::table('files', function (Blueprint $table) {
            $table->dateTime('ThoiGianNop')->nullable(); // Thêm cột thời gian nộp, cho phép NULL
            $table->string('TenFile')->nullable(); // Thêm cột tên file, cho phép NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         // Xóa cột 'TenMa' từ bảng 'duans'
         Schema::table('duans', function (Blueprint $table) {
            $table->dropColumn('TenMa');
        });

        // Xóa các cột 'ThoiGianNop' và 'TenFile' từ bảng 'files'
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn(['ThoiGianNop', 'TenFile']);
        });
    }
};
