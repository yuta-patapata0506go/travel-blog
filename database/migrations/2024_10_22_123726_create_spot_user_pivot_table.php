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
        Schema::create('spot_user_pivot', function (Blueprint $table) {
            $table->id();  // 自動インクリメントの主キー
            $table->unsignedBigInteger('user_id');  // 外部キー user_id
            $table->unsignedBigInteger('spot_id');  // 外部キー spot_id
            $table->tinyInteger('status')->default(0)->comment('0: pending, 1: approved, 2: denied');  // ステータス
            $table->timestamps();  // created_at, updated_atのタイムスタンプ

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('spot_id')->references('id')->on('spots')->onDelete('cascade');

            // ユニークキー制約
            $table->unique(['user_id', 'spot_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spot_user_pivot');
    }
};
