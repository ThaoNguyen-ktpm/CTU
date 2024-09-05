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
            $table->date('NgayBatDau')->nullable();
            $table->date('NgayKetThuc')->nullable();
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
            $table->dropColumn(['NgayBatDau', 'NgayKetThuc']);
        });
    }
};
