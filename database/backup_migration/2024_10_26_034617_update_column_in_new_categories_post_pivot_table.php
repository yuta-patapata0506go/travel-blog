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
        Schema::table('new_category_post_pivot', function (Blueprint $table) {
            //
            $table->dropForeign(['post_id']);
            $table->foreign('post_id') ->references('id') ->on('posts') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('new_category_post_pivot', function (Blueprint $table) {
            //
        });
    }
};
