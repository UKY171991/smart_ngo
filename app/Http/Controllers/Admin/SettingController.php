<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'setting_key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Increased to 5MB for flexibility
            'favicon' => 'nullable|file|mimes:ico,png,jpg,jpeg|max:1024',
        ]);

        $data = $request->except(['_token', 'logo', 'favicon']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['setting_key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('logo')) {
            // Delete old logo
            $oldLogo = Setting::where('setting_key', 'logo')->first();
            if ($oldLogo && $oldLogo->value) {
                $oldPath = $oldLogo->value;
                if (filter_var($oldPath, FILTER_VALIDATE_URL)) {
                    $oldPath = (string) \parse_url($oldPath, PHP_URL_PATH);
                    $oldPath = \str_replace(['/storage/', '/uploads/', '/media/'], '', $oldPath);
                }
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            
            $path = $request->file('logo')->store('brand', 'public');
            
            if (!$path || !Storage::disk('public')->exists($path)) {
                return redirect()->back()->with('error', 'Server Error: Failed to save logo. Please check folder permissions.');
            }

            Setting::updateOrCreate(['setting_key' => 'logo'], ['value' => $path]);
        }

        if ($request->hasFile('favicon')) {
            // Delete old favicon
            $oldFavicon = Setting::where('setting_key', 'favicon')->first();
            if ($oldFavicon && $oldFavicon->value) {
                $oldPath = $oldFavicon->value;
                if (filter_var($oldPath, FILTER_VALIDATE_URL)) {
                    $oldPath = (string) \parse_url($oldPath, PHP_URL_PATH);
                    $oldPath = \str_replace(['/storage/', '/uploads/', '/media/', '/images/'], '', $oldPath);
                }
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            
            $path = $request->file('favicon')->store('brand', 'public');

            if (!$path || !Storage::disk('public')->exists($path)) {
                return redirect()->back()->with('error', 'Server Error: Failed to save favicon. Please check folder permissions.');
            }

            Setting::updateOrCreate(['setting_key' => 'favicon'], ['value' => $path]);
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
    public function websiteQr()
    {
        $qrData = config('app.url');
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->format('svg')->generate($qrData);
        
        return view('admin.settings.website-qr', compact('qrCode', 'qrData'));
    }

    public function footerLinks()
    {
        $settings = Setting::pluck('value', 'setting_key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    public function mailSettings()
    {
        $settings = Setting::pluck('value', 'setting_key')->toArray();
        return view('admin.settings.mail', compact('settings'));
    }

    public function updateMailSettings(Request $request)
    {
        $data = $request->except(['_token']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['setting_key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Mail settings updated successfully!');
    }

    public function certificateSettings()
    {
        $settings = Setting::pluck('value', 'setting_key')->toArray();
        return view('admin.settings.certificate', compact('settings'));
    }

    public function updateCertificateSettings(Request $request)
    {
        $request->validate([
            'certificate_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'certificate_signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'certificate_stamp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'certificate_logo', 'certificate_signature', 'certificate_stamp']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['setting_key' => $key], ['value' => $value]);
        }

        // Handle File Uploads
        $files = ['certificate_logo', 'certificate_signature', 'certificate_stamp'];
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                // Delete old file if exists
                $oldFile = Setting::where('setting_key', $fileKey)->first();
                if ($oldFile && $oldFile->value) {
                    $oldPath = $oldFile->value;
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $path = $request->file($fileKey)->store('brand', 'public');
                Setting::updateOrCreate(['setting_key' => $fileKey], ['value' => $path]);
            }
        }

        return redirect()->back()->with('success', 'Certificate settings updated successfully!');
    }

    public function receiptSettings()
    {
        $settings = Setting::pluck('value', 'setting_key')->toArray();
        return view('admin.settings.receipt', compact('settings'));
    }

    public function updateReceiptSettings(Request $request)
    {
        $request->validate([
            'receipt_signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'receipt_stamp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'receipt_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', 'receipt_signature', 'receipt_stamp', 'receipt_logo']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['setting_key' => $key], ['value' => $value]);
        }

        // Handle File Uploads
        $files = ['receipt_signature', 'receipt_stamp', 'receipt_logo'];
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                // Delete old file if exists
                $oldFile = Setting::where('setting_key', $fileKey)->first();
                if ($oldFile && $oldFile->value) {
                    $oldPath = $oldFile->value;
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                $path = $request->file($fileKey)->store($fileKey == 'receipt_signature' ? 'signatures' : 'brand', 'public');
                Setting::updateOrCreate(['setting_key' => $fileKey], ['value' => $path]);
            }
        }

        return redirect()->back()->with('success', 'Receipt settings updated successfully!');
    }
}
