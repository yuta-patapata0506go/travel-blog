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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); 
            $table->text('body'); // コメントの内容

            // usersテーブルとの外部キー
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // postsテーブルとの外部キー
            $table->unsignedBigInteger('post_id')->nullable();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            // spotsテーブルとの外部キー
            $table->unsignedBigInteger('spot_id')->nullable();
            $table->foreign('spot_id')->references('id')->on('spots')->onDelete('cascade');

            // 自己リレーションを使って、リプライのための親コメントを参照
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            
            $table->timestamps(); // created_at と updated_at
            $table->softDeletes(); // deleted_at を追加してソフトデリート対応
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
