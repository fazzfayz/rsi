@props(['about'])

@php
    $vision = $about->vision ?? 'Menjadi mitra teknologi terpercaya yang membantu bisnis bertumbuh secara eksponensial melalui solusi digital dan managed service yang berdampak nyata.';
    $missionText = $about->mission ?? "Memberikan layanan IT yang cepat, rapi, dan terukur\nMengutamakan kualitas, keamanan data, dan keandalan sistem\nBerinovasi dengan teknologi yang tepat guna dan efisien";
    $missionItems = array_values(array_filter(array_map('trim', explode("\n", $missionText))));
@endphp

<section id="tentang" class="py-20 md:py-28 bg-gradient-to-b from-white via-blue-50/40 to-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block text-xs sm:text-sm font-bold tracking-widest text-blue-700 uppercase bg-blue-50 border border-blue-200 px-4 py-1.5 rounded-full mb-4">
                Tentang Ruang Solusi Internusa
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                Mitra Strategis <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-blue-600">Transformasi Digital</span> Anda
            </h2>
            <p class="text-base sm:text-lg text-gray-600 leading-relaxed font-normal">
                Berkomitmen menghadirkan layanan teknologi informasi berstandar enterprise yang adaptif, aman, dan berorientasi pada hasil bisnis yang terukur.
            </p>
        </div>

        <!-- 2-Column Split Content -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center mb-16">
            <!-- Left Column: Story & Vision/Mission -->
            <div class="lg:col-span-7 flex flex-col justify-center">
                <!-- Description Quote Block -->
                <div class="relative pl-6 border-l-4 border-blue-600 mb-10">
                    <p class="text-base sm:text-lg text-gray-700 leading-relaxed font-medium">
                        {{ $about->description ?? 'Kami adalah tim profesional di bidang teknologi informasi yang berkomitmen menghadirkan solusi digital terbaik untuk bisnis Anda. Dengan pengalaman mumpuni, kami telah membantu berbagai perusahaan dalam integrasi sistem, infrastruktur jaringan, dan keamanan informasi.' }}
                    </p>
                </div>

                <!-- Vision & Mission Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <!-- Vision Card -->
                    <div class="bg-white rounded-2xl p-6 border border-blue-100/90 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-lg mb-4">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Visi Kami</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                {{ $vision }}
                            </p>
                        </div>
                    </div>

                    <!-- Mission Card -->
                    <div class="bg-white rounded-2xl p-6 border border-blue-100/90 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-lg mb-4">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Misi Kami</h3>
                            <ul class="space-y-2 text-sm text-gray-600">
                                @foreach ($missionItems as $item)
                                    <li class="flex items-start gap-2">
                                        <span class="text-blue-600 mt-0.5"><i class="fas fa-check-circle text-xs"></i></span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Right Column: Visual Frame with Floating Card -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-md lg:max-w-none">
                    <!-- Image Card -->
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white ring-1 ring-blue-100/80">
                        @if (isset($about) && $about->image)
                            <img src="{{ asset('storage/' . $about->image) }}" alt="Tentang Ruang Solusi Internusa"
                                 class="w-full h-80 sm:h-[460px] object-cover object-center">
                        @else
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" alt="Tim IT Ruang Solusi Internusa"
                                 class="w-full h-80 sm:h-[460px] object-cover object-center">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-950/70 via-transparent to-transparent"></div>
                    </div>

                    <!-- Floating Experience Badge -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-5 rounded-2xl border border-blue-100 shadow-xl max-w-xs hidden sm:flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-700 text-white flex items-center justify-center text-xl font-extrabold shrink-0 shadow-md">
                            2+
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-gray-900">Tahun Dedikasi</h4>
                            <p class="text-xs text-gray-500">Menghadirkan solusi teknologi terukur di Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
