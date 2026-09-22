<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display the site settings form.
     */
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();

        return view('dashboard.settings.index', compact('settings'));
    }

    /**
     * Update site settings.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'wms_demo_url' => 'nullable|url|max:255',
            'hero_badge' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:500',
            'hero_subtitle' => 'nullable|string|max:1000',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:100',
            'contact_whatsapp' => 'nullable|string|max:100',
            'contact_address' => 'nullable|string|max:500',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan website berhasil diperbarui!');
    }
}
