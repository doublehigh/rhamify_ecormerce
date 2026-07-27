<?php

namespace App\Console\Commands;

use Database\Seeders\EcommerceCsvSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshEcommerceSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecommerce:refresh-seed {--force : Required when running in production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replace ecommerce seed data from database/data/ecommerce.csv and clear app caches.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (app()->environment('production') && ! $this->option('force')) {
            $this->error('Use --force to refresh seed data in production.');

            return self::FAILURE;
        }

        $this->warn('This will truncate and replace ecommerce seed tables.');

        if (! $this->option('force') && ! $this->confirm('Continue?')) {
            return self::FAILURE;
        }

        $this->call('db:seed', [
            '--class' => EcommerceCsvSeeder::class,
            '--force' => true,
        ]);

        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');

        $this->info('Ecommerce seed data refreshed and caches cleared.');

        return self::SUCCESS;
    }
}
