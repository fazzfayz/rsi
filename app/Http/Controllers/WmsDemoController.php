<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class WmsDemoController extends Controller
{
    /**
     * Display the Realtime Interactive WMS Demo Sandbox.
     */
    public function index()
    {
        try {
            $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            $settings = [];
        }

        $phone = !empty($settings['phone']) ? $settings['phone'] : config('rsi.phone', '+62 815-1940-7954');
        $whatsapp = !empty($settings['whatsapp']) ? $settings['whatsapp'] : config('rsi.whatsapp', '6281519407954');
        $email = !empty($settings['email']) ? $settings['email'] : config('rsi.email', 'info@ruang-solusi.com');

        return view('wms-demo.index', compact('settings', 'phone', 'whatsapp', 'email'));
    }
}
