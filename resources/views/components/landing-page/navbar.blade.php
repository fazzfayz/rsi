@props(['navLinks'])

<!-- Top Enterprise Utility Header (Contact & NOC Live Indicator) -->
<div class="hidden sm:block bg-gradient-to-r from-[#071938] via-[#0b244d] to-[#071938] text-blue-100/90 text-xs border-b border-blue-900/60 relative z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex items-center justify-between">
        <!-- Left: Status & Highlights -->
        <div class="flex items-center gap-4 sm:gap-6">
            <div class="flex items-center gap-2">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-[11px] font-semibold text-emerald-400">Live NOC 24/7 Monitoring</span>
            </div>
            <span class="hidden md:inline text-blue-400/40">|</span>
            <div class="hidden md:flex items-center gap-1.5 text-[11px] text-blue-200">
                <i class="fas fa-shield-alt text-blue-400 text-xs"></i>
                <span>SLA Uptime 99.9% Guarantee</span>
            </div>
            <span class="hidden lg:inline text-blue-400/40">|</span>
            <div class="hidden lg:flex items-center gap-1.5 text-[11px] text-blue-200">
                <i class="fas fa-coins text-blue-400 text-xs"></i>
                <span>Model Sewa Hardware OPEX Fleksibel</span>
            </div>
        </div>

        <!-- Right: Fast Contact & WMS Trial Prompt -->
        <div class="flex items-center gap-4 text-[11px]">
            <a href="mailto:info@ruang-solusi.com" class="hover:text-white transition-colors flex items-center gap-1.5">
                <i class="fas fa-envelope text-blue-400"></i>
                <span>info@ruang-solusi.com</span>
            </a>
            <span class="text-blue-400/40">|</span>
            <a href="https://wa.me/6281519407954" target="_blank" class="hover:text-emerald-400 transition-colors flex items-center gap-1.5 font-semibold text-emerald-400">
                <i class="fab fa-whatsapp"></i>
                <span>+62 815-1940-7954</span>
            </a>
        </div>
    </div>
</div>

<!-- Main Sticky Glassmorphism Navigation Bar -->
<nav id="mainNavbar" class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-200/80 shadow-[0_4px_25px_-5px_rgba(15,35,85,0.06)] transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Logo & Identification -->
            <a href="#beranda" class="flex items-center gap-3 group no-underline flex-shrink-0">
                <div class="relative w-11 h-11 rounded-2xl bg-gradient-to-tr from-blue-50 via-white to-blue-100/70 border border-blue-200/90 flex items-center justify-center p-2 shadow-sm shadow-blue-600/10 group-hover:scale-105 group-hover:shadow-md group-hover:border-blue-400 transition-all duration-300 flex-shrink-0">
                    <img src="{{ asset('img/rsi.png') }}" alt="Ruang Solusi Internusa" class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col whitespace-nowrap">
                    <div class="flex items-center gap-2">
                        <span class="font-extrabold text-base sm:text-lg tracking-tight text-slate-900 group-hover:text-blue-700 transition-colors duration-200 whitespace-nowrap">
                            Ruang Solusi
                        </span>
                        <span class="inline-block px-1.5 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-200 flex-shrink-0">
                            MSP
                        </span>
                    </div>
                    <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-blue-600 whitespace-nowrap">
                        Internusa • IT Solutions
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <div class="hidden lg:flex items-center gap-1 xl:gap-2">
                <ul class="flex items-center gap-0.5 xl:gap-1 list-none m-0 p-0">
                    @foreach ($navLinks as $link)
                        <li>
                            <a href="{{ $link['href'] }}"
                               class="navbar-link relative px-2.5 xl:px-3.5 py-2 text-[13px] xl:text-sm font-semibold text-slate-600 hover:text-blue-700 hover:bg-slate-100/80 rounded-xl transition-all duration-200 flex items-center gap-1.5 whitespace-nowrap">
                                <span>{{ $link['text'] }}</span>
                                @if(str_contains($link['href'], 'wms'))
                                    <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold uppercase tracking-wide bg-blue-100 text-blue-700 border border-blue-200">
                                        Trial
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Desktop Quick Actions CTA -->
                <div class="flex items-center gap-2 xl:gap-2.5 ml-2 xl:ml-4 flex-shrink-0">
                    <!-- Trial WMS Realtime Pill Button -->
                    <button type="button"
                            onclick="window.openWmsTrialModal ? window.openWmsTrialModal() : location.href='#wms-product'"
                            class="inline-flex items-center gap-2 px-3 xl:px-3.5 py-2 rounded-xl text-xs font-bold text-blue-800 bg-blue-50/90 hover:bg-blue-100 border border-blue-200/90 shadow-xs hover:shadow-sm transition-all duration-200 cursor-pointer whitespace-nowrap flex-shrink-0">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                        </span>
                        <span>Trial WMS</span>
                    </button>

                    <!-- Primary Consultation Button -->
                    <a href="#kontak"
                       class="inline-flex items-center gap-2 px-4 xl:px-5 py-2.5 rounded-xl text-xs xl:text-sm font-bold text-white bg-gradient-to-r from-blue-700 via-blue-800 to-indigo-800 hover:from-blue-800 hover:to-indigo-900 shadow-md shadow-blue-600/25 hover:shadow-lg hover:shadow-blue-600/35 transition-all duration-200 transform hover:-translate-y-0.5 whitespace-nowrap flex-shrink-0">
                        <span>Hubungi Kami</span>
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex items-center lg:hidden">
                <button id="navbarHamburger"
                        type="button"
                        aria-label="Toggle navigation menu"
                        aria-expanded="false"
                        class="p-2.5 rounded-2xl text-blue-900 bg-blue-50/90 hover:bg-blue-100 border border-blue-200/80 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg id="hamburgerIcon" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div id="navbarLinks"
         class="fixed inset-x-0 top-[76px] sm:top-[112px] bg-white z-50 border-b border-gray-200/90 shadow-2xl p-6 lg:hidden transition-all duration-300 ease-in-out transform -translate-y-full opacity-0 pointer-events-none max-h-[calc(100vh-5rem)] overflow-y-auto">
        <!-- Mobile Header Card -->
        <div class="flex items-center gap-3.5 pb-5 mb-5 border-b border-gray-100">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-50 to-white border border-blue-200 flex items-center justify-center p-2 shadow-sm">
                <img src="{{ asset('img/rsi.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h4 class="font-extrabold text-base text-blue-950">Ruang Solusi Internusa</h4>
                <p class="text-xs text-blue-600 font-semibold">Managed Service Provider & IT Solutions</p>
            </div>
        </div>

        <!-- Navigation Links -->
        <ul class="flex flex-col gap-1.5 list-none p-0 m-0 mb-6">
            @foreach ($navLinks as $link)
                <li>
                    <a href="{{ $link['href'] }}"
                       class="navbar-link flex items-center justify-between px-4 py-3 rounded-xl text-sm font-bold text-gray-700 hover:text-blue-700 hover:bg-blue-50/80 transition-all duration-200">
                        <div class="flex items-center gap-2">
                            <span>{{ $link['text'] }}</span>
                            @if(str_contains($link['href'], 'wms'))
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-blue-100 text-blue-700">
                                    Trial Realtime
                                </span>
                            @endif
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- Fast Actions inside Mobile Drawer -->
        <div class="pt-4 border-t border-gray-100 flex flex-col gap-3">
            <button type="button"
                    onclick="window.openWmsTrialModal ? window.openWmsTrialModal() : location.href='#wms-product'"
                    class="w-full py-3.5 px-4 rounded-xl text-center text-sm font-bold text-blue-800 bg-blue-50 hover:bg-blue-100 border border-blue-200 flex items-center justify-center gap-2 transition-colors duration-200 cursor-pointer">
                <span class="w-2 h-2 rounded-full bg-blue-600 animate-ping"></span>
                <span>Coba Trial WMS Online Realtime</span>
            </button>
            <a href="#kontak"
               class="w-full py-3.5 px-4 rounded-xl text-center text-sm font-bold text-white bg-gradient-to-r from-blue-700 to-blue-800 hover:from-blue-800 hover:to-blue-900 shadow-md transition-colors duration-200">
                Konsultasi Kebutuhan IT
            </a>
            <a href="https://wa.me/6281519407954" target="_blank"
               class="w-full py-3 px-4 rounded-xl text-center text-sm font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 flex items-center justify-center gap-2 transition-colors duration-200">
                <i class="fab fa-whatsapp text-lg"></i>
                <span>Hubungi via WhatsApp (+62 815-1940-7954)</span>
            </a>
        </div>
    </div>
</nav>
