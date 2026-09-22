<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $service->title }} - Ruang Solusi Internusa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $metaDescription = $service->excerpt ?: \Illuminate\Support\Str::limit(trim(strip_tags($service->description)), 160);
        $metaImage = $service->image ? url('/storage/' . ltrim($service->image, '/')) : asset('img/rsi.png');
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ route('services.public.show', $service->slug) }}">
    <link rel="icon" type="image/png" href="{{ asset('img/rsi.png') }}">

    <meta property="og:type" content="article">
    <meta property="og:site_name" content="Ruang Solusi Internusa">
    <meta property="og:title" content="{{ $service->title }} - Ruang Solusi Internusa">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ route('services.public.show', $service->slug) }}">
    <meta property="og:image" content="{{ $metaImage }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $service->title }} - Ruang Solusi Internusa">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $metaImage }}">
           
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-white via-blue-50 to-indigo-100 text-gray-800 font-inter antialiased">
    @php
        $typeLabels = [
            'managed_service' => 'Managed Service',
            'infrastruktur_teknologi' => 'Technology Infrastructure',
            'web_software_development' => 'Web & Software Development',
            'cloud_hosting' => 'Cloud Hosting',
        ];
        $serviceType = $service->service_type ?: 'managed_service';
        $links = collect($service->extra_links ?? []);
        $coverPath = $service->image ?: optional($service->images->first())->path;
        $waDigits = preg_replace('/\D/', '', (string) config('rsi.whatsapp'));
        $waPrefill = rawurlencode('Hello Ruang Solusi Internusa, I would like to inquire about: ' . $service->title);
        $showServiceInquiry = in_array($serviceType, ['managed_service', 'web_software_development', 'infrastruktur_teknologi', 'cloud_hosting'], true);
    @endphp

    <!-- HEADER -->
    <header class="sticky top-0 w-full bg-white/90 shadow-sm z-10 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between py-5">
            <a href="{{ route('landing') }}" class="flex items-center gap-2 text-blue-800 font-bold tracking-tight text-lg">
                <img src="{{ asset('img/rsi.png') }}" alt="RSI" class="h-10   p-1 object-contain" style="width:auto; max-width:2.5rem;">
                Ruang Solusi Internusa
            </a>
            <a href="{{ route('landing') }}#layanan"
                class="flex items-center gap-2 rounded-lg px-4 py-1 bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold text-sm transition">
                <svg class="w-5 h-5 -ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main>
        <div class="max-w-7xl mx-auto px-4 py-12">
            @if(session('success'))
                <div class="mb-8 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 text-base font-medium shadow" role="status">
                    {{ session('success') }}
                </div>
            @endif

            <section class="flex flex-col md:flex-row md:items-end gap-6 md:gap-10 mb-8">
                <div class="flex-1 min-w-0">
                    <h1 class="text-3xl md:text-5xl font-extrabold text-blue-900 leading-tight mb-1 break-words">{{ $service->title }}</h1>
                    <div class="flex items-center gap-3 text-sm text-gray-400">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                        Last updated: {{ optional($service->updated_at)->format('M d, Y') }}
                    </div>
                </div>
                <div>
                    @if($service->label)
                        <span class="inline-flex items-center bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-base font-semibold shadow-sm border border-blue-100">
                            {{ $service->label }}
                        </span>
                    @elseif(isset($typeLabels[$serviceType]))
                        <span class="inline-flex items-center bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-base font-semibold shadow-sm border border-blue-100">
                            {{ $typeLabels[$serviceType] }}
                        </span>
                    @endif
                </div>
            </section>

            @if($coverPath)
            <section class="mb-10">
                <div class="w-full">
                    <div class="rounded-3xl overflow-hidden border border-blue-100 bg-white shadow-lg">
                        <img src="{{ url('/storage/' . ltrim($coverPath, '/')) }}" alt="{{ $service->title }}"
                             class="w-full h-64 md:h-[32rem] object-cover object-center transition-transform duration-400 hover:scale-105">
                    </div>
                </div>
            </section>
            @endif

            <!-- Offerings Cards -->
            @if($serviceType === 'managed_service')
                <style>
                    @keyframes cardFadeInUp {
                        0% {
                            opacity: 0;
                            transform: translateY(40px) scale(0.98);
                        }
                        60% {
                            opacity: 1;
                            transform: translateY(-8px) scale(1.02);
                        }
                        100% {
                            opacity: 1;
                            transform: translateY(0) scale(1);
                        }
                    }
                    .service-animated-card {
                        opacity: 0;
                        animation: cardFadeInUp 0.8s cubic-bezier(.74,.12,.23,1.05) forwards;
                    }
                    .service-animated-card:nth-child(1) { animation-delay: 0.05s; }
                    .service-animated-card:nth-child(2) { animation-delay: 0.17s; }
                    .service-animated-card:nth-child(3) { animation-delay: 0.29s; }
                    .service-animated-card:nth-child(4) { animation-delay: 0.41s; }
                    .service-animated-icon svg {
                        transition: transform 0.5s cubic-bezier(.47,1.64,.41,.8);
                    }
                    .service-animated-card:hover .service-animated-icon svg {
                        transform: rotate(-6deg) scale(1.11);
                    }
                </style>
                <section class="mb-12">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-id-cols-4 gap-8">
                        <div class="service-animated-card bg-white rounded-2xl border border-blue-100 shadow p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                </svg>
                           
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">Manage Service Internet</h3>
                            <p class="text-gray-600 leading-relaxed">Comprehensive network management with routers and access points, supported by SLA to meet your business needs.</p>
                        </div>
                        <div class="service-animated-card bg-white rounded-2xl border border-blue-100 shadow p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3V6a3 3 0 013-3h13.5a3 3 0 013 3v5.25a3 3 0 01-3 3m-16.5 0a3 3 0 003 3h13.5a3 3 0 003-3m-19.5 0v7.125c0 .621.504 1.125 1.125 1.125h16.5c.621 0 1.125-.504 1.125-1.125V18.75"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">IT Manage Service</h3>
                            <p class="text-gray-600 leading-relaxed">Daily tech support for all office devices & networks, including troubleshooting and IT security to maintain seamless company operations.</p>
                        </div>
                        <div class="service-animated-card bg-white rounded-2xl border border-blue-100 shadow p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">Manage Service Email</h3>
                            <p class="text-gray-600 leading-relaxed">Proactive management of your company's email system: setup, security, backup, and troubleshooting.</p>
                        </div>
                        <div class="service-animated-card bg-white rounded-2xl border border-blue-100 shadow p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">Engineer Onsite</h3>
                            <p class="text-gray-600 leading-relaxed">Professional IT engineers on-site to support your infrastructure and technology needs directly at your location.</p>
                        </div>
                    </div>
                </section>
            @endif

            @if($serviceType === 'infrastruktur_teknologi')
                <style>
                    .service-animated-icon svg {
                        transition: transform 0.5s cubic-bezier(.47,1.64,.41,.8);
                    }
                    .service-animated-card:hover .service-animated-icon svg {
                        transform: rotate(-6deg) scale(1.11);
                    }
                </style>
                <section class="mb-12">
                    <h2 class="sr-only">Technology Infrastructure Offerings</h2>
                    <div class="mx-auto w-full flex flex-col md:flex-row gap-8 max-w-6xl justify-center">
                        <div class="service-animated-card flex-1 min-w-[230px] max-w-xs bg-white rounded-2xl border border-blue-100 shadow-sm p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.012 18.012h.008v.008h-.008v-.008z"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">Indoor &amp; Outdoor WIFI</h3>
                            <p class="text-gray-600 leading-relaxed">Site survey, design, and robust wireless coverage solutions for your whole business area.</p>
                        </div>
                        <div class="service-animated-card flex-1 min-w-[230px] max-w-xs bg-white rounded-2xl border border-blue-100 shadow-sm p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3V6a3 3 0 013-3h13.5a3 3 0 013 3v5.25a3 3 0 01-3 3m-16.5 0a3 3 0 003 3h13.5a3 3 0 003-3m-19.5 0v7.125c0 .621.504 1.125 1.125 1.125h16.5c.621 0 1.125-.504 1.125-1.125V18.75"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">IT Infrastructure</h3>
                            <p class="text-gray-600 leading-relaxed">Structured cabling, racks, hardware, and devices—neatly deployed and documented for operational efficiency.</p>
                        </div>
                        <div class="service-animated-card flex-1 min-w-[230px] max-w-xs bg-white rounded-2xl border border-blue-100 shadow-sm p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">Network Security</h3>
                            <p class="text-gray-600 leading-relaxed">Firewall, segmentation and hardening policies to keep your business network and data safe.</p>
                        </div>
                        <div class="service-animated-card flex-1 min-w-[230px] max-w-xs bg-white rounded-2xl border border-blue-100 shadow-sm p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">Server &amp; Storage</h3>
                            <p class="text-gray-600 leading-relaxed">Critical servers, storage and backup solutions to ensure operational continuity and recovery.</p>
                        </div>
                        <div class="service-animated-card flex-1 min-w-[230px] max-w-xs bg-white rounded-2xl border border-blue-100 shadow-sm p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">CCTV System</h3>
                            <p class="text-gray-600 leading-relaxed">High definition/IP cameras and recording for security with remote viewing convenience.</p>
                        </div>
                    </div>
                </section>
            @endif

            @if($serviceType === 'cloud_hosting')
                <style>
                    .service-animated-icon svg {
                        transition: transform 0.5s cubic-bezier(.47,1.64,.41,.8);
                    }
                    .service-animated-card:hover .service-animated-icon svg {
                        transform: rotate(-6deg) scale(1.11);
                    }
                </style>
                <section class="mb-12">
                    <h2 class="sr-only">Cloud Hosting Offerings</h2>
                    <div class="mx-auto w-full flex flex-col md:flex-row gap-8 max-w-6xl justify-center">
                        <div class="service-animated-card flex-1 min-w-[230px] max-w-xs bg-white rounded-2xl border border-blue-100 shadow-sm p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 6.75A4.5 4.5 0 007.5 11h-.225a3.375 3.375 0 100 6.75H17.25a3 3 0 100-6H16.5A4.5 4.5 0 0012 6.75z"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">Cloud Hosting</h3>
                            <p class="text-gray-600 leading-relaxed">Reliable cloud-based hosting for your websites and applications with high uptime and easy scaling.</p>
                        </div>
                        <div class="service-animated-card flex-1 min-w-[230px] max-w-xs bg-white rounded-2xl border border-blue-100 shadow-sm p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 17v-2a4 4 0 014-4h1.5a1.5 1.5 0 000-3A4.5 4.5 0 1012 21h5.25a3 3 0 100-6h-.75"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">Cloud VPS</h3>
                            <p class="text-gray-600 leading-relaxed">Flexible Virtual Private Servers with full root access and scalable resources for business needs.</p>
                        </div>
                        <div class="service-animated-card flex-1 min-w-[230px] max-w-xs bg-white rounded-2xl border border-blue-100 shadow-sm p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19.5 13.5V11A7.5 7.5 0 005 11v2.5A2.5 2.5 0 007.5 16h9A2.5 2.5 0 0021 13.5z"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">Email Hosting</h3>
                            <p class="text-gray-600 leading-relaxed">Professional email solutions with custom domains, spam filtering, and robust security features.</p>
                        </div>
                        <div class="service-animated-card flex-1 min-w-[230px] max-w-xs bg-white rounded-2xl border border-blue-100 shadow-sm p-7 text-center flex flex-col items-center hover:shadow-lg transition">
                            <span class="service-animated-icon mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-700 text-2xl">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.5 9.75v-3A3.75 3.75 0 0012.75 3h-1.5A3.75 3.75 0 007.5 6.75v3m12 0H4.5m15 0a3 3 0 013 3v6.75a3 3 0 01-3 3H4.5a3 3 0 01-3-3V12.75a3 3 0 013-3"/>
                                </svg>
                            </span>
                            <h3 class="text-lg font-bold text-blue-900 mb-2">Domain Management</h3>
                            <p class="text-gray-600 leading-relaxed">Full domain registration and DNS management to keep your web presence online and secure.</p>
                        </div>
                    </div>
                </section>
            @endif

            <div class="@if($serviceType === 'managed_service') flex flex-col items-center justify-center @elseif($serviceType === 'web_software_development') flex flex-col items-center justify-center @elseif($serviceType === 'cloud_hosting') flex flex-col items-center justify-center @else grid lg:grid-cols-3 gap-10 items-start justify-center @endif">
                @if($serviceType !== 'managed_service')
                <div class="@if($serviceType === 'web_software_development') w-full max-w-7xl flex flex-col items-center justify-center mx-auto gap-8 @elseif($serviceType === 'cloud_hosting') w-full max-w-4xl flex flex-col items-center justify-center mx-auto gap-8 @else lg:col-span-2 flex flex-col gap-8 mx-auto w-full max-w-2xl @endif">
                    @if($serviceType === 'web_software_development')
                    <article class="bg-white rounded-3xl shadow-lg border border-blue-100 p-10 w-full max-w-5xl mx-auto mb-8">
                
                            <p class="text-gray-600 mb-6 text-justify text-lg">
                                Explore our <strong>Warehouse Management System (WMS)</strong> with the demo environment and credentials below. Features include stock monitoring, goods in/out, and basic reporting.<br> 
                                <span class="block text-sm text-gray-500 mt-2">Note: This demo is for evaluation only and may differ from production.</span>
                            </p>
                       
                            <div class="w-full text-lg text-gray-800 text-left px-2">
                      <div class="mb-3">
    <span class="font-semibold text-gray-600">Demo URL:</span>
    
    <a href="https://wm.ruang-solusi.com"
       target="_blank"
       class="text-blue-700 hover:underline break-all font-mono text-base font-bold text-xl transition ml-2">
        Warehouse Management System
    </a>
</div>
                                <div class="mb-2 flex flex-wrap items-baseline gap-x-4 gap-y-1">
                                    <span class="font-semibold text-gray-600">Username:</span>
                                    <span><code class="font-mono bg-gray-50 px-2 py-1 border border-gray-200 text-lg ml-1">guest@mail.com</code></span>
                                </div>
                                <div class="flex flex-wrap items-baseline gap-x-4 gap-y-1">
                                    <span class="font-semibold text-gray-600">Password:</span>
                                    <span><code class="font-mono bg-gray-50 px-2 py-1 border border-gray-200 text-lg ml-1">12345678</code></span>
                                </div>
                            </div>
                       
                        </article>
                    @endif
               
                    @if($service->images->count())
                        <div class="bg-white rounded-3xl shadow border border-blue-100 p-8 w-full max-w-3xl mx-auto">
                            <h2 class="text-xl font-bold text-blue-900 mb-4">Gallery</h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($service->images as $img)
                                    <a href="{{ url('/storage/' . ltrim($img->path, '/')) }}" target="_blank" rel="noopener"
                                       class="group rounded-xl overflow-hidden border border-blue-100 bg-white hover:shadow-xl transition">
                                        <img src="{{ url('/storage/' . ltrim($img->path, '/')) }}"
                                             alt="{{ $img->alt ?: $service->title }}"
                                             class="w-full h-24 md:h-28 object-cover object-center group-hover:scale-105 transition duration-300">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                @endif

                <!-- Bagian kanan (catalog, partners, link), mode full-width & tengah jika managed_service/cloud_hosting -->
                <div class="w-full">
           
                    @if($serviceType === 'managed_service' || $serviceType === 'infrastruktur_teknologi' || $serviceType === 'cloud_hosting')
                        @if($service->catalog_file)
                            <div class="flex justify-center mb-4">
                                <a href="{{ url('/storage/' . ltrim($service->catalog_file, '/')) }}" download
                                    class="justify-center rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-3 transition shadow">
                                    Download Catalog
                                </a>
                            </div>
                        @endif
                   

                        @if($service->logos->count())
                            <div class="bg-white rounded-2xl shadow border border-blue-100 p-0 mb-6 w-full">
                                <h2 class="text-lg font-bold text-blue-800 mb-4 text-center pt-6" style="font-family: Tahoma, Geneva, Verdana, sans-serif; font-weight: bold;">
                                    Trusted by
                                </h2>
                           
                                <div class="relative w-full overflow-hidden px-0 mb-4">
                                    <div id="partners-carousel"
                                         class="flex items-center w-full"
                                         style="transition: transform 0.8s cubic-bezier(.24,.91,.49,1.04); will-change: transform;">
                                        @foreach($service->logos as $logo)
                                            <div class="flex-shrink-0 p-3" style="width: 180px;">
                                                <div class="border-2 border-blue-100 p-4 bg-white shadow-sm flex items-center justify-center rounded-xl"
                                                     style="height: 120px;">
                                                    <img src="{{ url('/storage/' . ltrim($logo->path, '/')) }}"
                                                         alt="{{ $logo->alt ?: $service->title }}"
                                                         class="max-w-full max-h-full object-contain object-center transition-transform duration-300">
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- duplicate for seamless infinite loop --}}
                                        @foreach($service->logos as $logo)
                                            <div class="flex-shrink-0 p-3" style="width: 180px;">
                                                <div class="border-2 border-blue-100 p-4 bg-white shadow-sm flex items-center justify-center rounded-xl"
                                                     style="height: 120px;">
                                                    <img src="{{ url('/storage/' . ltrim($logo->path, '/')) }}"
                                                         alt="{{ $logo->alt ?: $service->title }}"
                                                         class="max-w-full max-h-full object-contain object-center transition-transform duration-300">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        @endif
                   
                    @endif

                    @if($links->count())
                        {{-- Hapus/Hide link portfolio project untuk web_software_development --}}
                        @if($serviceType !== 'web_software_development')
                            <div class="bg-white rounded-2xl shadow border border-blue-100 p-6">
                                <h2 class="text-lg font-bold text-blue-800 mb-4 text-center">
                                    @if($serviceType === 'infrastruktur_teknologi')
                                        Marketplace Link
                                    @elseif($serviceType === 'cloud_hosting')
                                      
                                    @else
                                        Related Link
                                    @endif
                                </h2>
                                @if($serviceType === 'cloud_hosting')
                                    <div class="flex flex-col gap-1 items-center">
                                        @foreach($links as $link)
                                            <a href="{{ $link['url'] ?? '#' }}" target="_blank" rel="noopener"
                                                class="rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 transition text-center min-w-[180px] shadow">
                                                Cloud Hosting Link
                                           
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="flex flex-col gap-2">
                                        @foreach($links as $link)
                                            <a href="{{ $link['url'] ?? '#' }}" target="_blank" rel="noopener"
                                               class="block rounded-xl border border-blue-200 px-4 py-3 text-blue-700 font-medium hover:bg-blue-50 transition text-center">
                                                {{ $link['label'] ?? ($link['url'] ?? '-') }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            @if($showServiceInquiry)
            <section class="mt-16">
                <div class="flex justify-center">
                    <div class="w-full max-w-xl">
                        <div class="bg-white rounded-3xl shadow border border-blue-100 p-8">
                            <h3 class="text-lg font-bold text-blue-800 mb-1 text-center">Service Inquiry</h3>
                            <p class="text-sm text-gray-600 mb-6 text-center">Fill in the form below. Your request will be sent to our team via email.</p>
                            @if($errors->any())
                                <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="{{ route('contact.service-inquiry') }}" class="space-y-4">
                                @csrf
                                <input type="hidden" name="inquiry_source" value="{{ $serviceType }}">
                                <input type="hidden" name="service_title" value="{{ $service->title }}">
                                <div>
                                    <label for="inquiry-name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <input id="inquiry-name" name="name" type="text" required maxlength="255" value="{{ old('name') }}"
                                           class="w-full rounded-xl border border-gray-200 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-gray-900 transition">
                                </div>
                                <div>
                                    <label for="inquiry-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input id="inquiry-email" name="email" type="email" required maxlength="255" value="{{ old('email') }}"
                                           class="w-full rounded-xl border border-gray-200 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-gray-900 transition">
                                </div>
                                <div>
                                    <label for="inquiry-message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                    <textarea id="inquiry-message" name="message" rows="4" required maxlength="2000"
                                              class="w-full rounded-xl border border-gray-200 px-4 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-gray-900 transition resize-y">{{ old('message') }}</textarea>
                                </div>
                                <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 w-full mt-4">
                                    <button type="submit"
                                            class="w-full md:w-1/2 inline-flex justify-center rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 transition mb-3 md:mb-0">
                                        Send Inquiry
                                    </button>
                                    @if($waDigits !== '')
                                        <button type="button"
                                            onclick="window.open('https://wa.me/{{ $waDigits }}?text={{ $waPrefill }}', '_blank')"
                                            class="w-full md:w-1/2 inline-flex items-center justify-center gap-2 rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 transition mb-3 md:mb-0">
                                            <svg width="24" height="24" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5"><circle cx="22" cy="22" r="22" fill="#25D366"/><path d="M31.905 29.308c-.533.266-3.157 1.489-3.64 1.658-.483.178-.843.267-1.204.09s-1.845-.682-3.362-2.03c-1.247-1.106-2.073-2.467-2.454-2.876-.38-.406-.821-.513-1.355-.684-.421-.137-.803-.274-1.188-.434-.85-.348-1.457-.737-1.782-1.167-.325-.43-.325-.794-.226-.991.1-.196.362-.484.747-.799.192-.161.338-.287.463-.397.125-.11.273-.153.425-.112.151.04.382.063.747.063.35 0 .585-.009.83-.19.201-.144.366-.358.484-.612.227-.499.304-1.125.169-1.516-.134-.391-1.207-2.975-1.667-3.565-.461-.59-1.039-.496-1.345-.484-.306.013-.555.108-.855.224a7.28 7.28 0 00-2.04 1.367c-.98.844-1.68 2.08-1.733 3.472-.089 2.186 1.415 4.793 2.098 5.848.205.323 1.205 1.956 2.944 3.163C19.11 32.222 21.576 33.126 22.83 33.31c2.072.291 3.287-.08 3.893-.277.608-.197 1.882-.753 2.247-.95.366-.198.631-.282.769-.45.14-.169.14-.648.099-.679-.039-.032-.331-.126-.864-.393z" fill="#fff"/></svg>
                                            <span class="text-white" style="font-family: Tahoma, Geneva, Verdana, sans-serif; font-weight: normal;">Get In Touch</span>
                                       
                                        </button>
                                    @endif
                               
                                </div>
                           
                           
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            @endif
        </div>
    </main>
</body>
<style>
        #partners-carousel {
            animation: scroll-partners 40s linear infinite;
        }
        @keyframes scroll-partners {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-{{ sizeof($service->logos) * 180 }}px);
            }
        }
        @media (max-width: 640px) {
            #partners-carousel > div {
                width: 120px !important;
            }
            #partners-carousel {
                animation-duration: {{ 2 * sizeof($service->logos) }}s;
            }
        }
    </style>
                
</html>
