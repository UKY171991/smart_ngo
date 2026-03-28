<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Dynamic Vite Manifest Detection (FOOLPROOF FIX FOR LAYOUT)
        $this->app->bind(\Illuminate\Foundation\Vite::class, function ($app) {
            $vite = new \Illuminate\Foundation\Vite;
            // Try different paths where manifest might exist on Hostinger vs Local
            if (file_exists(base_path('build/manifest.json'))) {
                return $vite->useManifestFilename('build/manifest.json');
            }
            return $vite;
        });

        // Load settings from database
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::pluck('value', 'setting_key')->toArray();
                
                if (!empty($settings)) {
                    // Apply Mail Settings
                    $config = [
                        'transport' => $settings['mail_mailer'] ?? config('mail.default'),
                        'host' => $settings['mail_host'] ?? config('mail.mailers.smtp.host'),
                        'port' => $settings['mail_port'] ?? config('mail.mailers.smtp.port'),
                        'encryption' => $settings['mail_encryption'] ?? config('mail.mailers.smtp.encryption'),
                        'username' => $settings['mail_username'] ?? config('mail.mailers.smtp.username'),
                        'password' => $settings['mail_password'] ?? config('mail.mailers.smtp.password'),
                        'from' => [
                            'address' => $settings['mail_from_address'] ?? config('mail.from.address'),
                            'name' => $settings['mail_from_name'] ?? config('mail.from.name'),
                        ],
                    ];

                    config([
                        'mail.default' => $config['transport'],
                        'mail.mailers.smtp.host' => $config['host'],
                        'mail.mailers.smtp.port' => $config['port'],
                        'mail.mailers.smtp.encryption' => $config['encryption'],
                        'mail.mailers.smtp.username' => $config['username'],
                        'mail.mailers.smtp.password' => $config['password'],
                        'mail.from.address' => $config['from']['address'],
                        'mail.from.name' => $config['from']['name'],
                    ]);

                    // If driver is sendmail/mail
                    if ($config['transport'] === 'sendmail') {
                        config(['mail.mailers.sendmail.transport' => 'sendmail']);
                    }
                }
            }
        } catch (\Exception $e) {
            // Silently fail if DB is not ready
        }
    }
}
