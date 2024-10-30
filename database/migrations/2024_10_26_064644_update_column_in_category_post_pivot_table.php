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
        Schema::table('category_post_pivot', function (Blueprint $table) {
            //
            $table->dropForeign(['categories_id']);
            $table->foreign('categories_id')->references('id')->on('renew_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_post_pivot', function (Blueprint $table) {
            //
        });
    }
};
