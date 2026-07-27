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
                'ALTER TABLE order_products ALTER COLUMN unit_price TYPE NUMERIC(10, 2) USING unit_price::numeric'
            ),
            'mysql' => DB::statement(
                'ALTER TABLE order_products MODIFY unit_price DECIMAL(10, 2) NOT NULL'
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
                'ALTER TABLE order_products ALTER COLUMN unit_price TYPE VARCHAR(255) USING unit_price::varchar'
            ),
            'mysql' => DB::statement(
                'ALTER TABLE order_products MODIFY unit_price VARCHAR(255) NOT NULL'
            ),
            default => null,
        };
    }
};
