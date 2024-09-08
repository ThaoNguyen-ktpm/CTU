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
        Schema::create('loaiduans', function (Blueprint $table) {
            $table->id(); // Tạo cột id tự động tăng
            $table->string('TenLoaiDuAn'); // Tạo cột TenLoaiDuAn kiểu chuỗi
            $table->boolean('IsActive')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loaiduans');
    }
};
