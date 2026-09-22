<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\About;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Log;

class LandingController extends Controller
{
    public function index()
    {
        try {
            $services = Service::with('images')->get();
        } catch (\Throwable $e) {
            Log::warning("Database query error for services: " . $e->getMessage());
            $services = collect([]);
        }

        try {
            $about = About::first();
        } catch (\Throwable $e) {
            Log::warning("Database query error for about: " . $e->getMessage());
            $about = null;
        }

        try {
            $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            Log::warning("Database query error for site_settings: " . $e->getMessage());
            $settings = [];
        }

        // Defaults from config / local interactive demo
        $configuredWmsUrl = !empty($settings['wms_demo_url']) ? $settings['wms_demo_url'] : config('rsi.wms_demo_url');
        if (empty($configuredWmsUrl) || $configuredWmsUrl === 'https://demo-wms.ruang-solusi.com') {
            $settings['wms_demo_url'] = route('wms.demo');
        } else {
            $settings['wms_demo_url'] = $configuredWmsUrl;
        }
        $settings['phone'] = !empty($settings['phone']) ? $settings['phone'] : config('rsi.phone', '+62 815-1940-7954');
        $settings['whatsapp'] = !empty($settings['whatsapp']) ? $settings['whatsapp'] : config('rsi.whatsapp', '6281519407954');
        $settings['email'] = !empty($settings['email']) ? $settings['email'] : config('rsi.email', 'info@ruang-solusi.com');
        $settings['address'] = !empty($settings['address']) ? $settings['address'] : config('rsi.address');

        return view('landing', compact('services', 'about', 'settings'));
    }
}
