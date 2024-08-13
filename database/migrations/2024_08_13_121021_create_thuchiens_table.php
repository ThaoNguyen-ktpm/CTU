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
        Schema::create('thuchiens', function (Blueprint $table) {
            $table->id();
            $table->date('NgayBatDau');
            $table->date('NgayKetThuc');
            $table->string('ThuGiaiDoan');
            $table->foreignId('MaDuAn')->constrained('duans');
            $table->foreignId('MaGiaiDoan')->constrained('giaidoans');
            $table->boolean('IsActive');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thuchiens');
    }
};
