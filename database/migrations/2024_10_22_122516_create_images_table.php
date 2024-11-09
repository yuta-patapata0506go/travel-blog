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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image_url', 255); // 画像のURL
            
            // postsテーブルとの外部キー、postに関連しない画像の場合はnullも許容
            $table->unsignedBigInteger('post_id')->nullable(); 
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            
            // spotsテーブルとの外部キー、spotに関連しない画像の場合はnullも許容
            $table->unsignedBigInteger('spot_id')->nullable();
            $table->foreign('spot_id')->references('id')->on('spots')->onDelete('cascade');
            
            // usersテーブルとの外部キー、画像をアップロードしたユーザー
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // 画像のキャプション
            $table->string('caption', 255)->nullable();
            
            // 画像のステータス（例: published, draft）
            $table->string('status', 255)->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
