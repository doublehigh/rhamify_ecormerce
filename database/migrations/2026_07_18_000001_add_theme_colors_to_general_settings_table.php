<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('theme_primary', 20)->default('#f68b1e')->after('time_zone');
            $table->string('theme_primary_dark', 20)->default('#d97812')->after('theme_primary');
            $table->string('theme_secondary', 20)->default('#313133')->after('theme_primary_dark');
            $table->string('theme_accent', 20)->default('#f68b1e')->after('theme_secondary');
        });
    }

    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn([
                'theme_primary',
                'theme_primary_dark',
                'theme_secondary',
                'theme_accent',
            ]);
        });
    }
};
