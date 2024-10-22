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
        Schema::create('spots', function (Blueprint $table) {
            $table->id();  // 自動インクリメントのID (主キー)
            $table->unsignedBigInteger('user_id');  // usersテーブルのIDを参照する外部キー
            $table->string('name', 255);  // スポット名
            $table->string('postalcode', 20);  // 郵便番号
            $table->string('address', 255);  // 住所
            $table->decimal('latitude', 10, 8);  // 緯度 (小数点以下8桁)
            $table->decimal('longitude', 11, 8);  // 経度 (小数点以下8桁)
            $table->timestamps();  // created_at と updated_at カラムを自動作成

            // 外部キー制約を追加
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spots');
    }
};
