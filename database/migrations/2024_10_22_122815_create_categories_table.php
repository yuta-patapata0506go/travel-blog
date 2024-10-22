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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->string('title', 255);  // Title field with varchar(255)
            $table->text('body')->nullable()->comment('Content of the post');  // Body field with note
            $table->unsignedBigInteger('user_id');  // Foreign key for users
            $table->string('status', 255);  // Status field with varchar(255)
            $table->timestamp('created_at')->useCurrent();  // Timestamp for created_at

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
