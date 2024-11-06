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
        Schema::create('new_category_post_pivot', function (Blueprint $table) {
            $table->id();  // 主キー
            $table->unsignedBigInteger('post_id');  // 外部キーとしてpost_id
            $table->unsignedBigInteger('category_id');  // 外部キーとしてcategories_id
            $table->string('status', 255);  // ステータスのvarchar(255)
            $table->timestamp('created_at')->useCurrent();  // created_atのタイムスタンプ

            // 外部キー制約
            $table->foreign('post_id')->references('id')->on('new_posts')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('renew_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_category_post_pivot');
    }
};
