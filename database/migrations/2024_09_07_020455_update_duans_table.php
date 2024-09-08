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

            $table->integer('QuyMo')->nullable();

            $table->foreignId('MaLoai')->nullable()->constrained('loaiduans');

         
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
            // Xóa cột QuyMo và MaLoai
            $table->dropColumn('QuyMo');
            $table->dropForeign(['MaLoai']);
            $table->dropColumn('MaLoai');

        
        });
     
    }
};
