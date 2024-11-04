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
        Schema::create('new_categories', function (Blueprint $table) {
            $table->id();  // 主キー
            $table->string('name', 255);  // カテゴリー名
            $table->unsignedBigInteger('parent_id')->nullable();  // 親カテゴリーID (null許容)
            $table->timestamps();  // 作成日と更新日のタイムスタンプ
        
            // 親カテゴリーを参照する外部キー制約
            $table->foreign('parent_id')->references('id')->on('new_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_categories');
    }
};
