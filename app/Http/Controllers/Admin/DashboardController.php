<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donation;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_members' => User::where('role', 'member')->count(),
            'total_donations' => Donation::where('status', 'completed')->sum('amount'),
            'pending_enquiries' => \App\Models\Enquiry::where('status', 'pending')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function clearCache()
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('view:clear');
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            \Illuminate\Support\Facades\Artisan::call('route:clear');
            
            return back()->with('success', 'System cache cleared successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to clear cache: ' . $e->getMessage());
        }
    }

    public function fixSystemFolders()
    {
        try {
            // Required subdirectories in the storage public folder
            $directories = [
                'brand',
                'news',
                'campaigns',
                'events',
                'avatars',
                'qr_codes',
                'certificates',
                'donations',
            ];

            foreach ($directories as $dir) {
                $absoluteDir = storage_path('app/public/' . $dir);
                if (!file_exists($absoluteDir)) {
                    mkdir($absoluteDir, 0755, true);
                }
                // Ensure permissions
                if (PHP_OS_FAMILY !== 'Windows') {
                    chmod($absoluteDir, 0755);
                }
            }

            $storagePublic = storage_path('app/public');
            if (PHP_OS_FAMILY !== 'Windows') {
                 chmod($storagePublic, 0755);
            }

            $publicPath = public_path('storage');

            // Force recreate symlink if broken or directory
            if (file_exists($publicPath) || is_link($publicPath)) {
                if (PHP_OS_FAMILY === 'Windows') {
                    if (is_dir($publicPath) && !is_link($publicPath)) {
                        shell_exec("rd /s /q \"$publicPath\"");
                    } else {
                        shell_exec("del /f /q \"$publicPath\"");
                    }
                } else {
                    shell_exec("rm -rf \"$publicPath\"");
                }
            }

            // Run artisan storage link
            \Illuminate\Support\Facades\Artisan::call('storage:link');

            // If still not working (shared hosting issue), attempt manual link
            if (!file_exists($publicPath)) {
                $target = storage_path('app/public');
                $link = public_path('storage');
                if (PHP_OS_FAMILY === 'Windows') {
                    shell_exec("mklink /J \"$link\" \"$target\"");
                } else {
                    @symlink($target, $link);
                }
            }

            return back()->with('success', 'System folders verified and storage link recreated.');
        } catch (\Exception $e) {
            return back()->with('error', 'System fix failed: ' . $e->getMessage());
        }
    }
}
