@props(['settings' => []])
@php
    $phone = !empty($settings['phone']) ? $settings['phone'] : config('rsi.phone', '+62 815-1940-7954');
    $email = !empty($settings['email']) ? $settings['email'] : config('rsi.email', 'info@ruang-solusi.com');
    $address = !empty($settings['address']) ? $settings['address'] : config('rsi.address');
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
@endphp

<footer class="bg-[#081635] text-slate-300 pt-16 pb-12 border-t border-blue-900/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12 pb-12 border-b border-blue-900/50">
            <!-- Col 1: Brand & Overview (4 Cols) -->
            <div class="lg:col-span-4">
                <a href="#beranda" class="flex items-center gap-3 mb-5 no-underline">
                    <div class="w-10 h-10 rounded-xl bg-blue-900/60 border border-blue-700/50 flex items-center justify-center p-1.5">
                        <img src="{{ asset('img/rsi.png') }}" alt="Ruang Solusi Internusa" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="font-extrabold text-xl tracking-tight text-white block">
                            Ruang Solusi Internusa
                        </span>
                        <span class="text-[11px] font-semibold uppercase tracking-wider text-blue-400">
                            Digital & Managed IT Provider
                        </span>
                    </div>
                </a>

                <p class="text-sm text-slate-400 leading-relaxed mb-6 max-w-sm">
                    Mitra strategis Anda dalam mewujudkan transformasi digital, efisiensi belanja teknologi melalui model OPEX, dan perlindungan infrastruktur IT berkelanjutan.
                </p>

                <!-- Social Icons -->
                <div class="flex items-center gap-3">
                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener" aria-label="WhatsApp"
                       class="w-9 h-9 rounded-lg bg-blue-900/50 border border-blue-700/50 text-slate-300 hover:text-white hover:bg-blue-700 flex items-center justify-center transition-colors">
                        <i class="fab fa-whatsapp text-base"></i>
                    </a>
                    <a href="https://www.instagram.com/distwnty/" target="_blank" rel="noopener" aria-label="Instagram"
                       class="w-9 h-9 rounded-lg bg-blue-900/50 border border-blue-700/50 text-slate-300 hover:text-white hover:bg-blue-700 flex items-center justify-center transition-colors">
                        <i class="fab fa-instagram text-base"></i>
                    </a>
                    <a href="mailto:{{ $email }}" aria-label="Email"
                       class="w-9 h-9 rounded-lg bg-blue-900/50 border border-blue-700/50 text-slate-300 hover:text-white hover:bg-blue-700 flex items-center justify-center transition-colors">
                        <i class="fas fa-envelope text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Col 2: Navigation Links (2 Cols) -->
            <div class="lg:col-span-2">
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-5">Navigasi</h4>
                <ul class="space-y-3 list-none p-0 m-0 text-sm">
                    <li><a href="#beranda" class="text-slate-400 hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="#core-bisnis" class="text-slate-400 hover:text-white transition-colors">Core Bisnis</a></li>
                    <li><a href="#wms-product" class="text-slate-400 hover:text-white transition-colors">Produk WMS</a></li>
                    <li><a href="#portfolio" class="text-slate-400 hover:text-white transition-colors">Portofolio</a></li>
                    <li><a href="#layanan" class="text-slate-400 hover:text-white transition-colors">Layanan IT</a></li>
                    <li><a href="#tentang" class="text-slate-400 hover:text-white transition-colors">Tentang Kami</a></li>
                    <li><a href="#kontak" class="text-slate-400 hover:text-white transition-colors">Kontak</a></li>
                </ul>
            </div>

            <!-- Col 3: Layanan & Produk (3 Cols) -->
            <div class="lg:col-span-3">
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-5">Core & Produk</h4>
                <ul class="space-y-3 list-none p-0 m-0 text-sm">
                    <li><a href="#core-hardware" class="text-slate-400 hover:text-white transition-colors">IT Hardware Solutions & Sewa</a></li>
                    <li><a href="#core-managed" class="text-slate-400 hover:text-white transition-colors">24/7 IT Managed Services</a></li>
                    <li><a href="#wms-product" class="text-slate-400 hover:text-white transition-colors">Aplikasi WMS (Trial Realtime)</a></li>
                    <li><a href="#core-software" class="text-slate-400 hover:text-white transition-colors">Tailor-Made Web Apps</a></li>
                    <li><a href="#core-software" class="text-slate-400 hover:text-white transition-colors">Mobile & Desktop Apps</a></li>
                    <li><a href="#portfolio" class="text-slate-400 hover:text-white transition-colors">Studi Kasus Proyek</a></li>
                </ul>
            </div>

            <!-- Col 4: Quick Contact & Helpdesk (3 Cols) -->
            <div class="lg:col-span-3">
                <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-5">Kontak Langsung</h4>
                <div class="space-y-3 text-sm text-slate-400">
                    <p class="flex items-start gap-2.5">
                        <i class="fas fa-map-marker-alt text-blue-400 mt-1 shrink-0"></i>
                        <span>{{ $address }}</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <i class="fas fa-phone-alt text-blue-400 shrink-0"></i>
                        <a href="tel:{{ $phone }}" class="hover:text-white transition-colors">{{ $phone }}</a>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <i class="fas fa-envelope text-blue-400 shrink-0"></i>
                        <a href="mailto:{{ $email }}" class="hover:text-white transition-colors">{{ $email }}</a>
                    </p>

                    <div class="pt-3">
                        <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors w-full justify-center">
                            <i class="fab fa-whatsapp text-base"></i>
                            <span>Chat Helpdesk via WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar / Copyright -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <p>© {{ date('Y') }} Ruang Solusi Internusa. Seluruh hak cipta dilindungi.</p>
            <p>Integrated Managed Service Provider • Indonesia</p>
        </div>
    </div>
</footer>
