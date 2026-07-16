<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class EcommerceCsvSeeder extends Seeder
{
    /**
     * The CSV is a combined export with repeated header rows, one section per table.
     *
     * @var array<int, string|null>
     */
    private array $sectionTables = [
        1 => 'abouts',
        2 => 'adverisements',
        3 => null,
        4 => null,
        5 => null,
        6 => 'brands',
        7 => 'categories',
        8 => 'chats',
        9 => 'child_categories',
        10 => 'cod_settings',
        11 => 'coupons',
        12 => 'email_configurations',
        13 => 'failed_jobs',
        14 => 'flash_sales',
        15 => 'flash_sale_items',
        16 => 'footer_grid_threes',
        17 => 'footer_grid_twos',
        18 => 'footer_infos',
        19 => 'footer_socials',
        20 => 'footer_titles',
        21 => 'general_settings',
        22 => 'home_page_settings',
        23 => 'logo_settings',
        24 => null,
        25 => 'newsletter_subscribers',
        26 => 'orders',
        27 => 'order_products',
        28 => 'password_reset_tokens',
        29 => 'paypal_settings',
        30 => 'personal_access_tokens',
        31 => 'products',
        32 => 'product_image_galleries',
        33 => 'product_reviews',
        34 => 'product_review_galleries',
        35 => 'product_variants',
        36 => 'product_variant_items',
        37 => 'pusher_settings',
        38 => 'razorpay_settings',
        39 => 'shipping_rules',
        40 => 'sliders',
        41 => 'stripe_settings',
        42 => 'sub_categories',
        43 => 'terms_and_conditions',
        44 => 'transactions',
        45 => 'users',
        46 => 'user_addresses',
        47 => 'vendors',
        48 => 'vendor_conditions',
        49 => 'wishlists',
        50 => 'withdraw_methods',
        51 => 'withdraw_requests',
    ];

    public function run(): void
    {
        $path = database_path('data/ecommerce.csv');

        if (! file_exists($path)) {
            throw new RuntimeException("Seeder CSV not found at {$path}");
        }

        $sections = $this->readSections($path);
        $tables = array_values(array_filter($this->sectionTables));

        DB::connection()->getSchemaBuilder()->disableForeignKeyConstraints();

        try {
            foreach (array_reverse($tables) as $table) {
                DB::table($table)->truncate();
            }

            foreach ($sections as $index => $section) {
                $table = $this->sectionTables[$index] ?? null;

                if (! $table || empty($section['rows'])) {
                    continue;
                }

                foreach (array_chunk($section['rows'], 250) as $rows) {
                    DB::table($table)->insert($rows);
                }
            }
        } finally {
            DB::connection()->getSchemaBuilder()->enableForeignKeyConstraints();
        }
    }

    /**
     * @return array<int, array{headers: array<int, string>, rows: array<int, array<string, mixed>>}>
     */
    private function readSections(string $path): array
    {
        $file = fopen($path, 'r');

        if ($file === false) {
            throw new RuntimeException("Unable to open {$path}");
        }

        $sections = [];
        $sectionIndex = 0;
        $headers = [];

        while (($row = fgetcsv($file)) !== false) {
            if ($this->isHeaderRow($row)) {
                $sectionIndex++;
                $headers = $row;
                $sections[$sectionIndex] = [
                    'headers' => $headers,
                    'rows' => [],
                ];

                continue;
            }

            if (! $sectionIndex || ! $headers) {
                continue;
            }

            $sections[$sectionIndex]['rows'][] = $this->combineRow($headers, $row);
        }

        fclose($file);

        return $sections;
    }

    /**
     * @param array<int, string|null> $row
     */
    private function isHeaderRow(array $row): bool
    {
        if (($row[0] ?? null) === 'id' && isset($row[1]) && ! is_numeric($row[1])) {
            return true;
        }

        return implode('|', $row) === 'email|token|created_at';
    }

    /**
     * @param array<int, string> $headers
     * @param array<int, string|null> $row
     * @return array<string, mixed>
     */
    private function combineRow(array $headers, array $row): array
    {
        $combined = [];

        foreach ($headers as $index => $header) {
            $value = $row[$index] ?? null;
            $combined[$header] = $this->normalizeValue($value, $header);
        }

        return $combined;
    }

    private function normalizeValue(?string $value, string $header): mixed
    {
        if ($header === 'coupon' && ($value === null || strtoupper($value) === 'NULL')) {
            return '';
        }

        if ($value === null || strtoupper($value) === 'NULL') {
            return null;
        }

        return $value;
    }
}
