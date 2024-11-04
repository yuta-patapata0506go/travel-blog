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
        Schema::table('categories', function (Blueprint $table) {

            $table->tinyInteger('status')->default(0)->comment('0: visible, 1: hidden')->change();

            $table->timestamp('updated_at')->useCurrent()->nullable()->after('created_at');
        });
        //

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('status', 255)->change();

            // updated_atカラムを削除
            $table->dropColumn('updated_at');
        });
        //
    }
};
