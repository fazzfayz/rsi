@props(['settings' => []])
@php
    $defaultDemoUrl = route('wms.demo');
    $wmsDemoUrl = (!empty($settings['wms_demo_url']) && $settings['wms_demo_url'] !== 'https://demo-wms.ruang-solusi.com') 
        ? $settings['wms_demo_url'] 
        : (config('rsi.wms_demo_url') && config('rsi.wms_demo_url') !== 'https://demo-wms.ruang-solusi.com' ? config('rsi.wms_demo_url') : $defaultDemoUrl);
@endphp

<section id="wms-product" class="py-20 md:py-28 bg-[#0b224a] text-white relative overflow-hidden">
    <!-- Ambient Background Glows -->
    <div class="absolute -top-40 right-10 w-[550px] h-[550px] bg-blue-600/20 blur-3xl rounded-full pointer-events-none"></div>
    <div class="absolute -bottom-40 left-10 w-[550px] h-[550px] bg-indigo-600/20 blur-3xl rounded-full pointer-events-none"></div>
    <div class="absolute inset-0 bg-[radial-gradient(#1e40af_1px,transparent_1px)] [background-size:24px_24px] opacity-20 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/20 border border-blue-400/40 text-blue-300 text-xs sm:text-sm font-bold mb-4 shadow-sm backdrop-blur-md">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                <span>Produk Siap Pakai • Bisa Trial Online Realtime</span>
            </div>

            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-4 text-white">
                Aplikasi WMS <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-sky-300">(Warehouse Management System)</span>
            </h2>
            <p class="text-base sm:text-lg text-blue-100/80 leading-relaxed font-normal">
                RSI telah mengembangkan produk software WMS enterprise mandiri yang teruji. Anda tidak perlu menunggu lama atau membeli sistem tanpa bukti nyata — <strong class="text-white font-semibold">coba langsung sistem WMS kami secara online dan realtime</strong> sekarang!
            </p>
        </div>

        <!-- 2-Column Split Showcase: Features vs Interactive Live Demo Preview -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center mb-16">
            <!-- Left Column: 5 Core WMS Features -->
            <div class="lg:col-span-6 space-y-4">
                <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-5 hover:bg-white/10 transition-colors flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-600/30 border border-blue-400/30 text-blue-300 flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-white mb-1">Live Real-Time Inventory Visibility</h3>
                        <p class="text-xs sm:text-sm text-blue-100/70 leading-relaxed">
                            Cek posisi stok, kuantitas per batch, hingga level ketersediaan barang secara akurat di setiap detik tanpa selisih.
                        </p>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-5 hover:bg-white/10 transition-colors flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-600/30 border border-blue-400/30 text-blue-300 flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-barcode"></i>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-white mb-1">Integrasi Barcode & Mobile Scanner PDA</h3>
                        <p class="text-xs sm:text-sm text-blue-100/70 leading-relaxed">
                            Dukungan pemindaian barcode 1D/2D dan QR Code menggunakan perangkat mobile scanner genggam (Android PDA) untuk kecepatan tim lapangan.
                        </p>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-5 hover:bg-white/10 transition-colors flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-600/30 border border-blue-400/30 text-blue-300 flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-white mb-1">Multi-Warehouse & Bin Rack Mapping</h3>
                        <p class="text-xs sm:text-sm text-blue-100/70 leading-relaxed">
                            Kelola multi cabang gudang secara terpusat dengan sistem pemetaan rak, lorong (aisle), dan bin lokasi yang presisi.
                        </p>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-5 hover:bg-white/10 transition-colors flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-600/30 border border-blue-400/30 text-blue-300 flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-truck-ramp-box"></i>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-white mb-1">Inbound, Putaway & Outbound Picking</h3>
                        <p class="text-xs sm:text-sm text-blue-100/70 leading-relaxed">
                            Alur barang masuk otomatis tersinkronisasi PO, optimasi rute pengambilan barang (picking list), dan validasi dispatch akurat.
                        </p>
                    </div>
                </div>

                <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-2xl p-5 hover:bg-white/10 transition-colors flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-600/30 border border-blue-400/30 text-blue-300 flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-white mb-1">Aturan FIFO, FEFO & Expiry Alert</h3>
                        <p class="text-xs sm:text-sm text-blue-100/70 leading-relaxed">
                            Menjamin barang keluar sesuai masa kadaluwarsa (FEFO) atau urutan masuk (FIFO) untuk meminimalkan kerugian rusak/usang.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Live Realtime Preview Card -->
            <div class="lg:col-span-6">
                <div class="bg-slate-900/90 border-2 border-blue-500/40 rounded-3xl p-6 sm:p-8 shadow-2xl backdrop-blur-xl relative">
                    <!-- Live Header Bar -->
                    <div class="flex items-center justify-between pb-5 border-b border-white/10 mb-6">
                        <div class="flex items-center gap-3">
                            <span class="w-3.5 h-3.5 rounded-full bg-red-500/80 inline-block"></span>
                            <span class="w-3.5 h-3.5 rounded-full bg-yellow-500/80 inline-block"></span>
                            <span class="w-3.5 h-3.5 rounded-full bg-emerald-500/80 inline-block"></span>
                            <span class="text-xs font-mono text-blue-200 ml-2">demo-wms.ruang-solusi.com</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                            <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-wider">Online Realtime</span>
                        </div>
                    </div>

                    <!-- Live Metrics Row -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
                        <div class="p-3 bg-blue-950/70 rounded-xl border border-blue-500/20 text-center">
                            <div class="text-lg sm:text-xl font-extrabold text-blue-300">12,450</div>
                            <div class="text-[10px] text-blue-200/70 uppercase font-semibold">Total SKU</div>
                        </div>
                        <div class="p-3 bg-blue-950/70 rounded-xl border border-blue-500/20 text-center">
                            <div class="text-lg sm:text-xl font-extrabold text-emerald-400">840</div>
                            <div class="text-[10px] text-blue-200/70 uppercase font-semibold">Inbound Hari Ini</div>
                        </div>
                        <div class="p-3 bg-blue-950/70 rounded-xl border border-blue-500/20 text-center">
                            <div class="text-lg sm:text-xl font-extrabold text-sky-400">620</div>
                            <div class="text-[10px] text-blue-200/70 uppercase font-semibold">Outbound Hari Ini</div>
                        </div>
                        <div class="p-3 bg-blue-950/70 rounded-xl border border-blue-500/20 text-center">
                            <div class="text-lg sm:text-xl font-extrabold text-amber-300">99.9%</div>
                            <div class="text-[10px] text-blue-200/70 uppercase font-semibold">Akurasi Stok</div>
                        </div>
                    </div>

                    <!-- Simulated Realtime Activity Log Table -->
                    <div class="bg-black/30 rounded-2xl p-4 border border-white/10 mb-6 font-mono text-xs">
                        <div class="flex items-center justify-between text-blue-300 pb-2 border-b border-white/10 mb-2 font-sans font-bold">
                            <span>Aktivitas Gudang Real-Time</span>
                            <span class="text-[10px] text-blue-400 font-normal">Sinkronisasi Otomatis</span>
                        </div>
                        <div class="space-y-2 text-blue-100/80">
                            <div class="flex items-center justify-between py-1 border-b border-white/5">
                                <span class="flex items-center gap-2">
                                    <span class="text-emerald-400">✓ Inbound</span>
                                    <span>[PO-2026-8812] 120 Unit Elektronik</span>
                                </span>
                                <span class="text-gray-400 text-[10px]">Baru saja</span>
                            </div>
                            <div class="flex items-center justify-between py-1 border-b border-white/5">
                                <span class="flex items-center gap-2">
                                    <span class="text-sky-400">⚡ Barcode Scan</span>
                                    <span>Lokasi Rak A-04-02 Terisi</span>
                                </span>
                                <span class="text-gray-400 text-[10px]">1 mnt lalu</span>
                            </div>
                            <div class="flex items-center justify-between py-1">
                                <span class="flex items-center gap-2">
                                    <span class="text-amber-400">📦 Picking</span>
                                    <span>[DO-9921] Siap Dispatch Kurir</span>
                                </span>
                                <span class="text-gray-400 text-[10px]">3 mnt lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dual Action Buttons Container -->
                    <div class="bg-gradient-to-r from-blue-700/80 to-blue-600/80 rounded-2xl p-5 border border-blue-400/40 text-center">
                        <h4 class="text-base font-bold text-white mb-2">
                            Ingin Mencoba Langsung Aplikasi WMS Ini?
                        </h4>
                        <p class="text-xs text-blue-100 mb-4">
                            Uji langsung sistem demo online kami di browser Anda secara interaktif dan realtime.
                        </p>
                        <div class="flex items-center justify-center">
                            <!-- Primary Button: Direct Link to WMS Demo URL -->
                            <a href="{{ $wmsDemoUrl }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-xs sm:text-sm font-bold text-blue-900 bg-white hover:bg-blue-50 shadow-lg transition-all duration-200 group">
                                <i class="fas fa-play-circle text-blue-600"></i>
                                <span>Try WMS Live Sekarang</span>
                                <i class="fas fa-external-link-alt text-xs text-blue-500 group-hover:translate-x-0.5 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Highlight Bar -->
        <div class="p-6 rounded-2xl bg-white/5 border border-white/10 flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-600/30 text-blue-300 flex items-center justify-center text-xl shrink-0">
                    <i class="fas fa-sliders"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-white">Butuh Penyesuaian Alur Gudang Spesifik?</h4>
                    <p class="text-xs text-blue-100/70">Aplikasi WMS kami dapat dikustomisasi (tailor-made) mengikuti SOP dan arsitektur gudang perusahaan Anda.</p>
                </div>
            </div>
            <a href="#kontak"
               class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition-colors shrink-0">
                <span>Diskusi Kustomisasi WMS</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>
