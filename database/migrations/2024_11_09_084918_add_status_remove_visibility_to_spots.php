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
        Schema::table('spots', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'denied'])->default('pending');

            // remove visibility column
            $table->dropColumn('visibility');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spots', function (Blueprint $table) {
            $table->dropColumn('status');

            $table->enum('visibility', ['Hidden', 'Visible'])->default('Hidden');
        });
    }
};
