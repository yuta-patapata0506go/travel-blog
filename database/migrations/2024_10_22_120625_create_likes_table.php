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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();  // プライマリキー
            $table->unsignedBigInteger('user_id');  // users テーブルの外部キー
            $table->unsignedBigInteger('post_id')->nullable();  // posts テーブルの外部キー
            $table->unsignedBigInteger('spot_id')->nullable();  // spots テーブルの外部キー
            $table->timestamp('created_at')->useCurrent();  // 作成日時

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('spot_id')->references('id')->on('spots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
