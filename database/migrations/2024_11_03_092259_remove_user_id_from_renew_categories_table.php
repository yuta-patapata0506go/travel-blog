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
        Schema::table('renew_categories', function (Blueprint $table) {
            // 外部キー制約を先に削除
            $table->dropForeign(['user_id']);
            // カラムの削除
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('renew_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            // 外部キー制約を再設定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
