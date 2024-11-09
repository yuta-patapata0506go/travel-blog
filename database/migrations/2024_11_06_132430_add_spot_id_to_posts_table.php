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
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('spot_id')->nullable()->after('id'); // spot_idカラムを追加
            $table->foreign('spot_id')->references('id')->on('spots')->onDelete('cascade'); // 外部キー制約
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['spot_id']);
            $table->dropColumn('spot_id');
            //
        });
    }
};
