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
        Schema::create('category_post_pivot', function (Blueprint $table) {
            $table->id();  // 主キー
            $table->unsignedBigInteger('post_id');  // 外部キーとしてpost_id
            $table->unsignedBigInteger('categories_id');  // 外部キーとしてcategories_id
            $table->string('status', 255);  // ステータスのvarchar(255)
            $table->timestamp('created_at')->useCurrent();  // created_atのタイムスタンプ

            // 外部キー制約
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_post_pivot');
    }
};
