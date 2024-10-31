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
        Schema::table('renew_categories', function (Blueprint $table) {
            //
            $table->text('body')->nullable()->comment('Content of the post');  // Body field with note
            $table->unsignedBigInteger('user_id');  // Foreign key for users
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('renew_categories', function (Blueprint $table) {
            //
            $table->dropColumn('status');
            $table->dropSoftDeletes();
            $table->dropColumn('body');
            $table->dropColumn('user_id');
        });
    }
};
