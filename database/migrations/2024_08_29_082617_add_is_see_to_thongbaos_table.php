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
        Schema::table('thongbaos', function (Blueprint $table) {
            $table->boolean('IsSee')->default(false)->after('IsActive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thongbaos', function (Blueprint $table) {
            $table->dropColumn('IsSee');
        });
        
    }
};
