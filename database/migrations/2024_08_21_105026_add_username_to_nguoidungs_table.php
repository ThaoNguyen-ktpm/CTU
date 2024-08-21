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
        Schema::table('nguoidungs', function (Blueprint $table) {
            $table->string('UserName')->after('Name'); // Thêm cột UserName sau cột Name
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nguoidungs', function (Blueprint $table) {
            $table->dropColumn('UserName');
        });
    }
};
