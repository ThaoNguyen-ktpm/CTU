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
        Schema::create('thongbaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('MaNguoiDung')->constrained('nguoidungs');
            $table->text('NoiDung');
            $table->timestamp('ThoiGian');
            $table->boolean('IsSee');
            $table->boolean('IsActive');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thongbaos');
    }
};
