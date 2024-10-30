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
        Schema::create('new_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // usersテーブルの外部キー
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('spots_id'); // spotsテーブルの外部キー
            $table->foreign('spots_id')->references('id')->on('spots')->onDelete('cascade');
            $table->tinyInteger('type')->default(0); // 0: tourism, 1: event
            $table->string('title', 255);
            $table->string('event_name', 255)->nullable();
            $table->decimal('fee', 10, 2)->nullable();

            $table->date('start_date'); // 開始日 
            $table->date('end_date'); // 終了日
            $table->string('comments', 255)->nullable();
            $table->text('helpful_info')->nullable();

            $table->tinyInteger('visibility_status')->default(0); // 0: visible, 1: admin_hidden
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_posts');
    }
};
