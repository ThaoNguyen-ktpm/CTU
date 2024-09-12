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
        Schema::table('duans', function (Blueprint $table) {
            $table->integer('MaDonVi')->nullable(); // Thêm cột tên mã, cho phép NULL
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('duans', function (Blueprint $table) {
            $table->dropColumn('MaDonVi');
        });
    }
};
