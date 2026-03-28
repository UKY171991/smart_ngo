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
            // Required subdirectories in our new flat 'uploads' folder
            $directories = [
                'brand',
                'news',
                'campaigns',
                'events',
                'avatars',
                'qr_codes',
                'certificates',
                'donations',
                'signatures',
                'stamps',
            ];

            $uploadPath = base_path('uploads');
            if (!file_exists($uploadPath)) {
                \mkdir($uploadPath, 0755, true);
            }

            foreach ($directories as $dir) {
                $absoluteDir = $uploadPath . '/' . $dir;
                if (!file_exists($absoluteDir)) {
                    \mkdir($absoluteDir, 0755, true);
                }
                // Ensure permissions
                if (PHP_OS_FAMILY !== 'Windows') {
                    @\chmod($absoluteDir, 0755);
                }
            }

            // Still attempt storage:link for anything else that might use it, but ignore failure
            try {
                \Illuminate\Support\Facades\Artisan::call('storage:link');
            } catch (\Exception $e) {
                // Silently skip if it fails on shared hosting
            }

            return back()->with('success', 'System folders verified in the uploads directory.');
        } catch (\Exception $e) {
            return back()->with('error', 'System fix failed: ' . $e->getMessage());
        }
    }

    public function exportReport()
    {
        $stats = [
            'total_members' => User::where('role', 'member')->count(),
            'total_donations' => Donation::where('status', 'completed')->sum('amount'),
            'total_campaigns' => \App\Models\Campaign::count(),
            'pending_enquiries' => \App\Models\Enquiry::where('status', 'pending')->count(),
            'recent_donations' => Donation::with('user')->where('status', 'completed')->latest()->take(10)->get(),
            'top_members' => User::where('role', 'member')->withCount('referrals')->orderBy('referrals_count', 'desc')->take(5)->get(),
        ];
        
        $siteSettings = \App\Models\Setting::pluck('value', 'setting_key')->toArray();
        $generated_at = now()->format('d M, Y H:i A');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pdfs.report', compact('stats', 'siteSettings', 'generated_at'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('NGO-REPORT-' . now()->format('Y-m-d') . '.pdf');
    }
}
