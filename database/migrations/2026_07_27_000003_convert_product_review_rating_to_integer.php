<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        match (DB::connection()->getDriverName()) {
            'pgsql' => DB::statement(
                'ALTER TABLE product_reviews ALTER COLUMN rating TYPE INTEGER USING rating::integer'
            ),
            'mysql' => DB::statement(
                'ALTER TABLE product_reviews MODIFY rating INTEGER NOT NULL'
            ),
            default => null,
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        match (DB::connection()->getDriverName()) {
            'pgsql' => DB::statement(
                'ALTER TABLE product_reviews ALTER COLUMN rating TYPE VARCHAR(255) USING rating::varchar'
            ),
            'mysql' => DB::statement(
                'ALTER TABLE product_reviews MODIFY rating VARCHAR(255) NOT NULL'
            ),
            default => null,
        };
    }
};
