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
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', 'logo']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('public/logo');
            $url = Storage::url($path);
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $url]);
        }

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
    public function websiteQr()
    {
        $qrData = config('app.url');
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->format('svg')->generate($qrData);
        
        return view('admin.settings.website-qr', compact('qrCode', 'qrData'));
    }
}
