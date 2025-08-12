<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\About;

class LandingController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $about = About::first();
        return view('landing', compact('services', 'about'));
    }
}
