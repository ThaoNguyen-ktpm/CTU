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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('DuongDanFile');  // Lưu trữ đường dẫn file
            $table->foreignId('MaCapNhatTienDo')->constrained('capnhattiendos')->onDelete('cascade'); // Khóa phụ liên kết với bảng capnhattiendos
            $table->boolean('IsActive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
