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
        Schema::table('inquiries', function (Blueprint $table) {
            $table->enum('status', ['Unprocessed', 'Responded', 'Resolved'])->default('Unprocessed'); // status column
            $table->enum('visibility', ['Visible', 'Hidden'])->default('Visible'); // visibility column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn(['status', 'visibility']);
        });
    }
};
