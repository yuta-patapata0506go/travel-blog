<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('category_post_pivot', function (Blueprint $table) {
            $table->timestamp('updated_at')->nullable(); // updated_at カラムを追加
        });
    }
    
    public function down()
    {
        Schema::table('category_post_pivot', function (Blueprint $table) {
            $table->dropColumn('updated_at'); // ロールバック時に updated_at カラムを削除
        });
    }
    
};
