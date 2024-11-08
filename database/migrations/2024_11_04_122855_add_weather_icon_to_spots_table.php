<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('spots', function (Blueprint $table) {
        $table->string('weather_icon')->nullable(); // weather_iconカラムを追加
    });
}

public function down()
{
    Schema::table('spots', function (Blueprint $table) {
        $table->dropColumn('weather_icon'); // 取り消し処理
    });
}
    
};
