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
        Schema::table('posts', function (Blueprint $table) {
            $table->date('start_date')->nullable()->change(); // 開始日をnullableに変更
            $table->date('end_date')->nullable()->change(); // 終了日をnullableに変更
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->date('start_date')->nullable(false)->change(); // 元に戻す
            $table->date('end_date')->nullable(false)->change(); // 元に戻す
        });
    }
};
