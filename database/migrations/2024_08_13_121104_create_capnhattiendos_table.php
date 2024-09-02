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
        Schema::create('capnhattiendos', function (Blueprint $table) {
            $table->id();
            $table->integer('TienDo');
            $table->text('NoiDung');
            $table->timestamp('ThoiGian');
            $table->foreignId('MaGiaoViec')->constrained('giaoviecs');
            $table->boolean('IsActive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capnhattiendos');
    }
};
