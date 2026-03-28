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
        // Dynamic Vite Manifest Detection (ACTUALLY FOOLPROOF FIX)
        $this->app->bind(\Illuminate\Foundation\Vite::class, function ($app) {
            $vite = new \Illuminate\Foundation\Vite;
            
            // On Hostinger, pathing might vary — check all possible locations
            $manifests = [
                public_path('build/manifest.json'),
                public_path('build/.vite/manifest.json'),
                base_path('public/build/manifest.json'),
                base_path('build/manifest.json'),         // If build is in root
                base_path('manifest.json'),                // If manifest is in root
            ];

            foreach ($manifests as $path) {
                if (file_exists($path)) {
                    if (str_contains($path, 'public/build')) {
                        return $vite->useBuildDirectory('build')->useManifestFilename('manifest.json');
                    }
                    if (str_contains($path, 'public/build/.vite')) {
                        return $vite->useBuildDirectory('build')->useManifestFilename('.vite/manifest.json');
                    }
                    if ($path === base_path('build/manifest.json')) {
                        // If it's in the root build folder, we need to go up from public/
                        return $vite->useBuildDirectory('../build')->useManifestFilename('manifest.json');
                    }
                    if ($path === base_path('manifest.json')) {
                        return $vite->useBuildDirectory('../')->useManifestFilename('manifest.json');
                    }
                }
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
