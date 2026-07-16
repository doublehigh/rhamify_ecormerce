<?php

namespace App\Providers;

use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Models\PusherSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $generalSetting = null;
        $logoSetting = null;
        $mailSetting = null;
        $pusherSetting = null;

        try {
            $generalSetting = GeneralSetting::first();
            $logoSetting = LogoSetting::first();
            $mailSetting = EmailConfiguration::first();
            $pusherSetting = PusherSetting::first();
        } catch (Throwable) {
            //
        }

        $generalSetting ??= new GeneralSetting([
            'site_name' => config('app.name', 'Laravel'),
            'layout' => 'LTR',
            'contact_email' => config('mail.from.address', 'hello@example.com'),
            'contact_phone' => null,
            'contact_address' => null,
            'map' => null,
            'currency_name' => 'USD',
            'currency_icon' => '$',
            'time_zone' => config('app.timezone', 'UTC'),
        ]);

        $logoSetting ??= new LogoSetting([
            'logo' => '',
            'favicon' => '',
        ]);

        $mailSetting ??= new EmailConfiguration([
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'encryption' => config('mail.mailers.smtp.encryption'),
            'username' => config('mail.mailers.smtp.username'),
            'password' => config('mail.mailers.smtp.password'),
        ]);

        $pusherSetting ??= new PusherSetting([
            'pusher_key' => config('broadcasting.connections.pusher.key'),
            'pusher_secret' => config('broadcasting.connections.pusher.secret'),
            'pusher_app_id' => config('broadcasting.connections.pusher.app_id'),
            'pusher_cluster' => config('broadcasting.connections.pusher.options.cluster'),
        ]);

        /** set time zone */
        Config::set('app.timezone', $generalSetting->time_zone);

        /** Set Mail Config */
        Config::set('mail.mailers.smtp.host', $mailSetting->host);
        Config::set('mail.mailers.smtp.port', $mailSetting->port);
        Config::set('mail.mailers.smtp.encryption', $mailSetting->encryption);
        Config::set('mail.mailers.smtp.username', $mailSetting->username);
        Config::set('mail.mailers.smtp.password', $mailSetting->password);

        /** Set Broadcasting Config */
        Config::set('broadcasting.connections.pusher.key', $pusherSetting->pusher_key);
        Config::set('broadcasting.connections.pusher.secret', $pusherSetting->pusher_secret);
        Config::set('broadcasting.connections.pusher.app_id', $pusherSetting->pusher_app_id);
        Config::set('broadcasting.connections.pusher.options.host', "api-".$pusherSetting->pusher_cluster.".pusher.com");



        /** Share variable at all view */
        View::composer('*', function($view) use ($generalSetting, $logoSetting, $pusherSetting){
            $view->with(['settings' => $generalSetting, 'logoSetting' => $logoSetting, 'pusherSetting' => $pusherSetting]);
        });
    }
}
