<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('thongbaos', function (Blueprint $table) {
            // Đổi tên cột cũ
            $table->renameColumn('ThoiGian', 'old_ThoiGian');
        });

        // Đợi một chút để đảm bảo cột đã được đổi tên
        sleep(2);

        Schema::table('thongbaos', function (Blueprint $table) {
            // Thêm cột mới
            $table->timestamp('ThoiGian')->nullable()->after('NoiDung');
        });

        // Sao chép dữ liệu từ cột cũ sang cột mới
        DB::statement('UPDATE thongbaos SET ThoiGian = old_ThoiGian');

        // Xóa cột cũ
        Schema::table('thongbaos', function (Blueprint $table) {
            $table->dropColumn('old_ThoiGian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thongbaos', function (Blueprint $table) {
            // Thêm lại cột cũ
            $table->date('ThoiGian')->after('NoiDung');
        });

        // Đợi một chút để đảm bảo cột đã được thêm
        sleep(2);

        // Sao chép dữ liệu từ cột mới sang cột cũ
        DB::statement('UPDATE thongbaos SET ThoiGian = ThoiGian');

        Schema::table('thongbaos', function (Blueprint $table) {
            // Xóa cột mới
            $table->dropColumn('ThoiGian');
        });

        Schema::table('thongbaos', function (Blueprint $table) {
            // Đổi tên cột cũ về tên cũ
            $table->renameColumn('old_ThoiGian', 'ThoiGian');
        });
    }
};
