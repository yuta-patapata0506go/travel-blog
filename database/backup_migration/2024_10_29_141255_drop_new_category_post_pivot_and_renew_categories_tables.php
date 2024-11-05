<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 外部キー制約を解除するために先に関連テーブルを削除
        Schema::dropIfExists('new_category_post_pivot');
        Schema::dropIfExists('renew_categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // `renew_categories` テーブルの再作成
        Schema::create('renew_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            // 自己参照の外部キー制約
            $table->foreign('parent_id')->references('id')->on('renew_categories')->onDelete('cascade');
        });

        // `new_category_post_pivot` テーブルの再作成
        Schema::create('new_category_post_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('category_id');
            $table->string('status', 255);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('post_id')->references('id')->on('new_posts')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('renew_categories')->onDelete('cascade');
        });
    }
};
