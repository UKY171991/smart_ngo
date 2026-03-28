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
        // Fix for Hostinger — explicitly point to the public directory
        if (str_contains(base_path(), 'public_html')) {
            $this->app->usePublicPath(base_path('public'));
        }

        // Super-Robust Vite Manifest Locator for Hostinger/Shared Hosting
        $this->app->singleton(\Illuminate\Foundation\Vite::class, function ($app) {
            $vite = new \Illuminate\Foundation\Vite;
            
            // Priority list of manifest locations (Vite 4, Vite 5+, and root overrides)
            $manifests = [
                public_path('build/manifest.json'),
                public_path('build/.vite/manifest.json'),
                base_path('public/build/manifest.json'),
                base_path('public/build/.vite/manifest.json'),
                base_path('build/manifest.json'),
                base_path('build/.vite/manifest.json'),
                base_path('manifest.json'),
            ];

            foreach ($manifests as $path) {
                if (file_exists($path)) {
                    // 1. Detect Standard Public Subfolder
                    if (str_contains($path, 'public/build')) {
                        $filename = str_contains($path, '.vite') ? '.vite/manifest.json' : 'manifest.json';
                        return $vite->useBuildDirectory('build')->useManifestFilename($filename);
                    }
                    
                    // 2. Detect Root Build Folder (Relative to public/ which is typical on Hostinger)
                    if (str_contains($path, DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR)) {
                        $filename = str_contains($path, '.vite') ? '.vite/manifest.json' : 'manifest.json';
                        return $vite->useBuildDirectory('../build')->useManifestFilename($filename);
                    }

                    // 3. Root Manifest File directly
                    if (basename($path) === 'manifest.json') {
                         return $vite->useBuildDirectory('../')->useManifestFilename('manifest.json');
                    }
                }
            }
            
            return $vite;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
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
