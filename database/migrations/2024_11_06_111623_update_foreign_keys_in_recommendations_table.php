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
        Schema::table('recommendations', function (Blueprint $table) {
            // Drop the existing foreign key constraints
            $table->dropForeign(['category_id']);  // Drop the old foreign key constraint for category_id
            $table->dropForeign(['post_id']);      // Drop the old foreign key constraint for post_id

            // Change the foreign key for category_id to reference the renew_categories table
            $table->foreign('category_id')->references('id')->on('renew_categories')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recommendations', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['category_id']);
            $table->dropForeign(['post_id']);

            // Revert the foreign key for category_id back to reference the categories table
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
};
