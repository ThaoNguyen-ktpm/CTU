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
        Schema::table('congviecs', function (Blueprint $table) {
            $table->string('LinkTaiLieu')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('congviecs', function (Blueprint $table) {
            $table->string('LinkTaiLieu')->nullable(false)->change();
        });
    }
};
