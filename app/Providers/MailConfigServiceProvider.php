<?php

namespace App\Providers;

use App\Models\MailerSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('mailer_settings'))
        {
            $mailerSetting = MailerSetting::query()->first();

            if($mailerSetting)
            {
                $data = [
                    'transport' => $mailerSetting->mailer,
                    'host' => $mailerSetting->host,
                    'port' => $mailerSetting->port,
                    'encryption' => $mailerSetting->encryption,
                    'username' => $mailerSetting->username,
                    'password' => $mailerSetting->password,
                    'from' => [
                        'name' => $mailerSetting->from_name,
                        'address' => $mailerSetting->from_address,
                    ]
                ];

                Config::set('mail.default', $mailerSetting->mailer);
                Config::set('mail.mailers.smtp', $data);
            }
        }
    }
}
