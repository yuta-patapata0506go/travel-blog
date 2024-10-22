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
        Schema::create('responses', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('inquiry_id')->constrained('inquiries')->onDelete('cascade'); // Foreign key to inquiries table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->text('body'); // Response content
            $table->timestamps(); // Created and updated timestamps
            $table->softDeletes(); // Soft delete column
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
