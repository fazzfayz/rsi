@props(['settings' => []])
@php
    $defaultDemoUrl = route('wms.demo');
    $wmsDemoUrl = (!empty($settings['wms_demo_url']) && $settings['wms_demo_url'] !== 'https://demo-wms.ruang-solusi.com') 
        ? $settings['wms_demo_url'] 
        : (config('rsi.wms_demo_url') && config('rsi.wms_demo_url') !== 'https://demo-wms.ruang-solusi.com' ? config('rsi.wms_demo_url') : $defaultDemoUrl);
@endphp

<section id="beranda" class="relative pt-12 pb-20 md:pt-16 md:pb-24 overflow-hidden bg-gradient-to-b from-blue-50/60 via-white to-white">
    <!-- Ambient Background Lighting / Gradients -->
    <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[850px] h-[500px] bg-gradient-to-tr from-blue-400/20 via-sky-300/15 to-indigo-600/10 blur-3xl rounded-full pointer-events-none -z-10"></div>
    <div class="absolute top-1/3 -left-32 w-80 h-80 bg-blue-300/15 blur-3xl rounded-full pointer-events-none -z-10"></div>
    <div class="absolute top-1/4 -right-32 w-80 h-80 bg-indigo-300/15 blur-3xl rounded-full pointer-events-none -z-10"></div>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- ========================================================================= -->
        <!-- CENTER HERO CONTENT (Minimalist Editorial Enterprise Layout)              -->
        <!-- ========================================================================= -->
        <div class="w-full max-w-4xl mx-auto text-center relative z-20">
            <!-- Top Credibility Badge -->
            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-blue-100/90 border border-blue-200 text-blue-900 text-xs sm:text-sm font-bold mb-6 shadow-sm backdrop-blur-sm">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-600 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-700"></span>
                </span>
                <span>Integrated Managed Service Provider & IT Infrastructure</span>
            </div>

            <!-- Main Headline -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-extrabold text-gray-900 tracking-tight leading-[1.18] mb-6">
                Mitra Teknologi Terpercaya untuk <br class="hidden sm:inline">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-800 via-blue-700 to-blue-600">Infrastruktur IT</span>, 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700">Managed Service 24/7</span>, & 
                <span class="text-gray-900">Aplikasi Tailor-Made</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-base sm:text-lg lg:text-xl text-gray-600 leading-relaxed max-w-3xl mx-auto mb-8 font-normal">
                PT Ruang Solusi Internusa (RSI) menghadirkan efisiensi operasional terintegrasi: ubah investasi modal besar (<strong class="text-gray-900 font-semibold">CAPEX</strong>) menjadi biaya terencana (<strong class="text-gray-900 font-semibold">OPEX</strong>) melalui <span class="text-gray-900 font-semibold">pengadaan & sewa hardware</span>, <span class="text-gray-900 font-semibold">NOC monitoring 24/7</span>, produk unggulan <span class="text-blue-700 font-semibold">WMS Realtime</span>, dan rekayasa software kustom yang presisi.
            </p>

            <!-- Action Buttons: Dual CTA -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-10">
                <!-- Primary Button: Direct to WMS Realtime -->
                <a href="{{ $wmsDemoUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-3.5 rounded-full text-sm sm:text-base font-bold text-white bg-blue-700 hover:bg-blue-800 shadow-lg shadow-blue-600/25 hover:shadow-xl hover:shadow-blue-600/35 transition-all duration-300 transform hover:-translate-y-0.5 group">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-300 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-white"></span>
                    </span>
                    <span>Coba WMS Realtime</span>
                    <i class="fas fa-external-link-alt text-xs opacity-90 group-hover:translate-x-0.5 transition-transform"></i>
                </a>

                <!-- Secondary Button: Explore Core Business -->
                <a href="#core-bisnis"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-sm sm:text-base font-semibold text-blue-900 bg-white hover:bg-blue-50 border border-blue-200 shadow-sm transition-all duration-300 hover:border-blue-300">
                    <span>Pelajari Solusi Bisnis RSI</span>
                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
            </div>

            <!-- Trust Bar: 4 Credibility Badges -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-6 pb-2 border-t border-blue-100/90 max-w-3xl mx-auto mb-10">
                <div class="flex items-center justify-center gap-2 text-gray-700 text-xs sm:text-sm font-semibold">
                    <i class="fas fa-shield-halved text-blue-600 text-sm"></i>
                    <span>SLA Uptime 99.9%</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-gray-700 text-xs sm:text-sm font-semibold">
                    <i class="fas fa-coins text-blue-600 text-sm"></i>
                    <span>Model Sewa OPEX</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-gray-700 text-xs sm:text-sm font-semibold">
                    <i class="fas fa-headset text-blue-600 text-sm"></i>
                    <span>NOC Standby 24/7/365</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-gray-700 text-xs sm:text-sm font-semibold">
                    <i class="fas fa-certificate text-blue-600 text-sm"></i>
                    <span>Dedicated Engineers</span>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- 4 SLIM & COMPACT CAPABILITY ANCHOR CARDS                                  -->
            <!-- ========================================================================= -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-3 text-left max-w-4xl mx-auto">
                <!-- Card 1: Core Hardware -->
                <a href="#core-hardware" class="bg-white/95 backdrop-blur-md py-3 px-3.5 sm:py-3.5 sm:px-4 rounded-xl border border-blue-100/90 shadow-sm hover:shadow-md hover:border-blue-400 hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 group-hover:bg-blue-600 text-blue-700 group-hover:text-white flex items-center justify-center text-sm font-bold shrink-0 transition-colors duration-200">
                        <i class="fas fa-server"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="text-[10px] text-blue-600 font-bold uppercase tracking-wider leading-none truncate">01 • Core Business</div>
                        <div class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-blue-700 leading-tight mt-1 transition-colors truncate">Hardware & Infra</div>
                    </div>
                </a>

                <!-- Card 2: Core Managed Service -->
                <a href="#core-managed" class="bg-white/95 backdrop-blur-md py-3 px-3.5 sm:py-3.5 sm:px-4 rounded-xl border border-blue-100/90 shadow-sm hover:shadow-md hover:border-blue-400 hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 group-hover:bg-blue-600 text-blue-700 group-hover:text-white flex items-center justify-center text-sm font-bold shrink-0 transition-colors duration-200">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-1.5 leading-none">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                            <span class="text-[10px] text-blue-600 font-bold uppercase tracking-wider truncate">02 • Core Business</span>
                        </div>
                        <div class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-blue-700 leading-tight mt-1 transition-colors truncate">Managed Service 24/7</div>
                    </div>
                </a>

                <!-- Card 3: WMS Product -->
                <a href="#wms-product" class="bg-white/95 backdrop-blur-md py-3 px-3.5 sm:py-3.5 sm:px-4 rounded-xl border border-blue-100/90 shadow-sm hover:shadow-md hover:border-blue-400 hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 group-hover:bg-blue-600 text-blue-700 group-hover:text-white flex items-center justify-center text-sm font-bold shrink-0 transition-colors duration-200">
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="text-[10px] text-emerald-600 font-bold uppercase tracking-wider leading-none truncate">Produk Siap Pakai</div>
                        <div class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-blue-700 leading-tight mt-1 transition-colors truncate">WMS Trial Realtime</div>
                    </div>
                </a>

                <!-- Card 4: Tailor-Made Apps -->
                <a href="#core-software" class="bg-white/95 backdrop-blur-md py-3 px-3.5 sm:py-3.5 sm:px-4 rounded-xl border border-blue-100/90 shadow-sm hover:shadow-md hover:border-indigo-400 hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 group-hover:bg-blue-600 text-blue-700 group-hover:text-white flex items-center justify-center text-sm font-bold shrink-0 transition-colors duration-200">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="text-[10px] text-indigo-600 font-bold uppercase tracking-wider leading-none truncate">03 • Tailor-Made</div>
                        <div class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-blue-700 leading-tight mt-1 transition-colors truncate">Software Engineering</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>