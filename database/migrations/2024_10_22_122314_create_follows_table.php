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
        Schema::create('follows', function (Blueprint $table) {
            $table->unsignedBigInteger('following_user_id');  // フォローするユーザーのID
            $table->unsignedBigInteger('followed_user_id');   // フォローされるユーザーのID
            $table->timestamps();  // created_at, updated_at

            // 外部キー制約
            $table->foreign('following_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('followed_user_id')->references('id')->on('users')->onDelete('cascade');

            // ユニークキー制約（1つのユーザーが同じユーザーを複数回フォローできないようにする）
            $table->unique(['following_user_id', 'followed_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
