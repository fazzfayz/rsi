@props(['services'])

@php
    use Illuminate\Support\Str;
    $serviceCount = count($services);
@endphp

<section id="layanan" class="py-20 md:py-28 bg-slate-50/50 relative overflow-hidden">
    <!-- Subtle Background Accents -->
    <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-blue-200 to-transparent"></div>
    <div class="absolute -top-32 right-0 w-96 h-96 bg-blue-100/40 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block text-xs sm:text-sm font-bold tracking-widest text-blue-700 uppercase bg-blue-50 border border-blue-200 px-4 py-1.5 rounded-full mb-4">
                Ekosistem Layanan IT Terpadu
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                Layanan Unggulan <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-blue-600">Ruang Solusi Internusa</span>
            </h2>
            <p class="text-base sm:text-lg text-gray-600 leading-relaxed font-normal">
                Tingkatkan efisiensi dengan mengubah CAPEX menjadi OPEX. Kami mengintegrasikan infrastruktur teknologi, pengembangan sistem, dan keahlian IT agar Anda fokus penuh pada inovasi bisnis.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
                <div class="bg-white rounded-3xl border border-blue-100/80 shadow-sm hover:shadow-xl hover:border-blue-400 hover:-translate-y-2 transition-all duration-300 p-6 sm:p-7 flex flex-col justify-between group">
                    <div>
                        <!-- Image Cover -->
                        <div class="w-full h-52 rounded-2xl overflow-hidden relative bg-blue-50/60 mb-6">
                            @if ($service->image)
                                <img src="{{ url('/storage/' . ltrim($service->image, '/')) }}" alt="{{ $service->title }}"
                                     class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100/50 text-blue-400">
                                    <i class="fas fa-network-wired text-4xl mb-2"></i>
                                    <span class="text-xs font-semibold text-blue-600">Enterprise Service</span>
                                </div>
                            @endif

                            @if ($service->label)
                                <div class="absolute top-3 left-3 z-10">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/95 text-blue-800 shadow-sm border border-blue-100 backdrop-blur-sm">
                                        {{ $service->label }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Content -->
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors duration-200 mb-3">
                            {{ $service->title }}
                        </h3>

                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 mb-6">
                            {{ $service->excerpt ?: Str::limit(trim(strip_tags($service->description)), 130) }}
                        </p>
                    </div>

                    <!-- CTA Link -->
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <a href="{{ route('services.public.show', $service->slug) }}"
                           class="inline-flex items-center gap-2 text-sm font-bold text-blue-700 group-hover:text-blue-800 transition-colors no-underline">
                            <span>Lihat Detail Layanan</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <span class="w-8 h-8 rounded-full bg-blue-50 group-hover:bg-blue-600 text-blue-600 group-hover:text-white flex items-center justify-center text-xs transition-colors duration-200">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                </div>
            @empty
                <!-- Fallback Featured Services if Database is Empty -->
                <!-- Service 1 -->
                <div class="bg-white rounded-3xl border border-blue-100/80 shadow-sm hover:shadow-xl hover:border-blue-400 hover:-translate-y-2 transition-all duration-300 p-6 sm:p-7 flex flex-col justify-between group">
                    <div>
                        <div class="w-full h-52 rounded-2xl overflow-hidden relative bg-blue-50/60 mb-6">
                            <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=700&q=80" alt="Managed IT Services"
                                 class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/95 text-blue-800 shadow-sm border border-blue-100">
                                    Managed Service
                                </span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors duration-200 mb-3">
                            Managed IT Services & Infrastructure
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed mb-6">
                            Pengelolaan operasional teknologi, pemeliharaan server, jaringan lokal & internet, serta bantuan teknisi profesional secara proaktif dan menyeluruh.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <a href="#kontak" class="inline-flex items-center gap-2 text-sm font-bold text-blue-700 group-hover:text-blue-800 transition-colors">
                            <span>Konsultasikan Kebutuhan</span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="bg-white rounded-3xl border border-blue-100/80 shadow-sm hover:shadow-xl hover:border-blue-400 hover:-translate-y-2 transition-all duration-300 p-6 sm:p-7 flex flex-col justify-between group">
                    <div>
                        <div class="w-full h-52 rounded-2xl overflow-hidden relative bg-blue-50/60 mb-6">
                            <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=700&q=80" alt="Cyber Security"
                                 class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/95 text-blue-800 shadow-sm border border-blue-100">
                                    Cyber Security
                                </span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors duration-200 mb-3">
                            Network & Cyber Security Solutions
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed mb-6">
                            Proteksi data perusahaan, firewall terintegrasi, pemindaian kerentanan jaringan, dan sistem backup pemulihan bencana standar ISO.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <a href="#kontak" class="inline-flex items-center gap-2 text-sm font-bold text-blue-700 group-hover:text-blue-800 transition-colors">
                            <span>Konsultasikan Kebutuhan</span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="bg-white rounded-3xl border border-blue-100/80 shadow-sm hover:shadow-xl hover:border-blue-400 hover:-translate-y-2 transition-all duration-300 p-6 sm:p-7 flex flex-col justify-between group">
                    <div>
                        <div class="w-full h-52 rounded-2xl overflow-hidden relative bg-blue-50/60 mb-6">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=700&q=80" alt="Software Development"
                                 class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute top-3 left-3 z-10">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/95 text-blue-800 shadow-sm border border-blue-100">
                                    Software & Web
                                </span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors duration-200 mb-3">
                            Custom Web & Software Development
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed mb-6">
                            Pengembangan aplikasi web bisnis, portal ERP kustom, integrasi API, dan sistem automasi untuk meningkatkan produktivitas internal.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <a href="#kontak" class="inline-flex items-center gap-2 text-sm font-bold text-blue-700 group-hover:text-blue-800 transition-colors">
                            <span>Konsultasikan Kebutuhan</span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
