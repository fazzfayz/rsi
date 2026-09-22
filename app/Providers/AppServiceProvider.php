<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // AdminLTE 3 uses Bootstrap 4 pagination views
        Paginator::useBootstrapFour();

        $navLinks = [
            ['href' => '#beranda', 'text' => 'Beranda'],
            ['href' => '#core-bisnis', 'text' => 'Core Bisnis'],
            ['href' => '#wms-product', 'text' => 'Produk WMS'],
            ['href' => '#portfolio', 'text' => 'Portofolio'],
            ['href' => '#layanan', 'text' => 'Layanan'],
            ['href' => '#tentang', 'text' => 'Tentang Kami'],
            ['href' => '#kontak', 'text' => 'Kontak'],
        ];

    $tags = [
        ['tag' => '#DigitalTransformation',],
        ['tag' => '#ITProfessional',],
        ['tag' => '#SolusiBisnis'],
    ];

     View::share([
        'navLinks' => $navLinks,
        'tags' => $tags
    ]);
    }
}
