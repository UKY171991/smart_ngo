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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|file|mimes:ico,png,jpg,jpeg|max:512',
        ]);

        $data = $request->except(['_token', 'logo', 'favicon']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['setting_key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('logo')) {
            // Delete old logo
            $oldLogo = Setting::where('setting_key', 'logo')->first();
            if ($oldLogo && $oldLogo->value) {
                // If it's a full URL, attempt to extract relative path
                $oldPath = $oldLogo->value;
                if (filter_var($oldPath, FILTER_VALIDATE_URL)) {
                    $oldPath = parse_url($oldPath, PHP_URL_PATH);
                    $oldPath = str_replace('/storage/', '', $oldPath);
                }
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('logo')->store('brand', 'public');
            Setting::updateOrCreate(['setting_key' => 'logo'], ['value' => $path]);
        }

        if ($request->hasFile('favicon')) {
            // Delete old favicon
            $oldFavicon = Setting::where('setting_key', 'favicon')->first();
            if ($oldFavicon && $oldFavicon->value) {
                $oldPath = $oldFavicon->value;
                if (filter_var($oldPath, FILTER_VALIDATE_URL)) {
                    $oldPath = parse_url($oldPath, PHP_URL_PATH);
                    $oldPath = str_replace('/storage/', '', $oldPath);
                }
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('favicon')->store('brand', 'public');
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
}
