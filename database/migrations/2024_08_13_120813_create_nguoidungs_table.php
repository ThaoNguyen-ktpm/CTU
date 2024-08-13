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
        Schema::create('nguoidungs', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Password');
            $table->string('Email');
            $table->string('SDT')->nullable();
            $table->string('Quyen');
            $table->string('google_id')->nullable();
            $table->boolean('IsActive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nguoidungs');
    }
};
