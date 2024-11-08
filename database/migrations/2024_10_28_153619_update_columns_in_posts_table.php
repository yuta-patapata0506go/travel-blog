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
            // 「Adult Fee」「Child Fee」およびそれぞれの通貨フィールドを追加
            $table->decimal('adult_fee', 10, 2)->nullable()->after('event_name');
            $table->string('adult_currency', 10)->nullable()->after('adult_fee');
            
            $table->decimal('child_fee', 10, 2)->nullable()->after('adult_currency');
            $table->string('child_currency', 10)->nullable()->after('child_fee');
    
            // 「Fee」カラムを削除
            $table->dropColumn('fee');
        });
    }
    
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // 変更を元に戻す処理
            $table->dropColumn('adult_fee');
            $table->dropColumn('adult_currency');
            
            $table->dropColumn('child_fee');
            $table->dropColumn('child_currency');
    
            // 「Fee」カラムを再追加
            $table->decimal('fee', 10, 2)->nullable()->after('event_name');
        });
    }
    
};
