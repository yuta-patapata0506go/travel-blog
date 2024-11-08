<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('spots', function (Blueprint $table) {
            $table->string('weather_condition')->nullable()->after('longitude'); // 天気
            $table->float('temperature')->nullable()->after('weather_condition'); // 気温
            $table->float('humidity')->nullable()->after('temperature'); // 湿度
            $table->float('wind_speed')->nullable()->after('humidity'); // 風速
            $table->float('precipitation')->nullable()->after('wind_speed'); // 降水量
            $table->float('uv_index')->nullable()->after('precipitation'); // UV指数
        });
    }

    public function down()
    {
        Schema::table('spots', function (Blueprint $table) {
            $table->dropColumn(['weather_condition', 'temperature', 'humidity', 'wind_speed', 'precipitation', 'uv_index']);
        });
    }
};

