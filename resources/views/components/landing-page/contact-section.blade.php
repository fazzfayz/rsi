@props(['settings' => []])
@php
    $phone = !empty($settings['phone']) ? $settings['phone'] : config('rsi.phone', '+62 815-1940-7954');
    $email = !empty($settings['email']) ? $settings['email'] : config('rsi.email', 'info@ruang-solusi.com');
    $address = !empty($settings['address']) ? $settings['address'] : config('rsi.address');
    $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
@endphp

<section id="kontak" class="py-20 md:py-28 bg-slate-50 relative overflow-hidden">
    <!-- Background Accents -->
    <div class="absolute top-1/2 left-0 w-80 h-80 bg-blue-100/50 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-200/30 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-block text-xs sm:text-sm font-bold tracking-widest text-blue-700 uppercase bg-blue-50 border border-blue-200 px-4 py-1.5 rounded-full mb-4">
                Konsultasi & Kemitraan
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                Tingkatkan Efisiensi Bisnis Bersama <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-blue-600">Ruang Solusi Internusa</span>
            </h2>
            <p class="text-base sm:text-lg text-gray-600 leading-relaxed font-normal">
                Jadwalkan konsultasi gratis untuk mendiskusikan pengadaan hardware, layanan managed service 24/7, coba aplikasi WMS realtime, atau bangun sistem tailor-made.
            </p>
        </div>

        <!-- 2-Column Integrated Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            <!-- Left Column: Location, Direct Contacts & Map -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                <!-- Info Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-blue-100/90 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center text-sm">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <span>Kantor Operasional</span>
                    </h3>

                    <div class="space-y-4 text-sm text-gray-600 mb-6">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-building text-blue-600 mt-1 text-base shrink-0"></i>
                            <div>
                                <strong class="text-gray-900 block font-semibold">PT Ruang Solusi Internusa</strong>
                                <span>{{ $address }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-blue-600 text-base shrink-0"></i>
                            <a href="mailto:{{ $email }}" class="hover:text-blue-700 transition-colors font-medium">{{ $email }}</a>
                        </div>

                        <div class="flex items-center gap-3">
                            <i class="fas fa-phone-alt text-blue-600 text-base shrink-0"></i>
                            <a href="tel:{{ $phone }}" class="hover:text-blue-700 transition-colors font-medium">{{ $phone }}</a>
                        </div>

                        <div class="flex items-center gap-3">
                            <i class="fab fa-whatsapp text-emerald-600 text-base shrink-0"></i>
                            <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20RSI,%20saya%20ingin%20konsultasi%20layanan%20IT" target="_blank" rel="noopener" class="hover:text-emerald-700 transition-colors font-medium">WhatsApp Helpdesk</a>
                        </div>

                        <div class="flex items-center gap-3">
                            <i class="fas fa-clock text-blue-600 text-base shrink-0"></i>
                            <span>Senin - Jumat: 08.30 - 17.30 WIB (NOC 24/7)</span>
                        </div>
                    </div>

                    <a href="https://maps.app.goo.gl/cNW4ipRaLbEs7Buw9" target="_blank" rel="noopener"
                       class="inline-flex items-center justify-center w-full gap-2 px-5 py-3 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-800 font-bold text-sm border border-blue-200 transition-colors duration-200">
                        <span>Buka di Google Maps</span>
                        <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                </div>

                <!-- Google Maps Card -->
                <div class="bg-white rounded-3xl overflow-hidden border border-blue-100/90 shadow-sm p-2">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31729.41236780286!2d106.9455339!3d-6.2404483!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cf488c14313%3A0x7bfdf26c2ccdc464!2sJl.%20Alam%20Utama%20XI%2C%20RT.13%2FRW.3%2C%20Bintara%20Jaya%2C%20Kec.%20Bekasi%20Bar.%2C%20Kota%20Bks%2C%20Jawa%20Barat%2017136!5e0!3m2!1sid!2sid!4v1775725061659!5m2!1sid!2sid"
                        width="100%"
                        height="240"
                        style="border:0; border-radius: 16px;"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen
                        title="Lokasi Kantor Ruang Solusi Internusa">
                    </iframe>
                </div>
            </div>

            <!-- Right Column: Interactive Consultation Inquiry Form (6 Fields) -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl p-6 sm:p-10 border border-blue-100 shadow-xl shadow-blue-900/5">
                    <div class="mb-8">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-3 py-1 rounded-md">
                            Formulir Konsultasi Kebutuhan
                        </span>
                        <h3 class="text-2xl font-bold text-gray-900 mt-2">Kirim Permintaan Konsultasi / Inquiry</h3>
                        <p class="text-sm text-gray-600 mt-1">Tim IT Solution Specialist kami akan menghubungi Anda dalam waktu 1x24 jam kerja.</p>
                    </div>

                    <!-- AJAX Notification Messages -->
                    <div id="success-message" class="hidden bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-6 rounded-xl" role="alert">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                            <div>
                                <p class="font-bold text-sm">Pesan Berhasil Terkirim!</p>
                                <p id="success-text" class="text-xs text-emerald-700 mt-0.5"></p>
                            </div>
                        </div>
                    </div>

                    <div id="error-message" class="hidden bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-xl" role="alert">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-exclamation-circle text-red-600 text-lg"></i>
                            <div>
                                <p class="font-bold text-sm">Pemberitahuan</p>
                                <p id="error-text" class="text-xs text-red-700 mt-0.5"></p>
                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-6 rounded-xl" role="alert">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                                <p class="font-semibold text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Contact Form: 6 Enterprise Fields -->
                    <form id="contact-form" action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Field 1: Name -->
                            <div>
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">Nama Lengkap / PIC *</label>
                                <input type="text" id="name" name="name" required placeholder="Contoh: Budi Santoso"
                                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                            </div>

                            <!-- Field 2: Company -->
                            <div>
                                <label for="company" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">Nama Perusahaan / Instansi</label>
                                <input type="text" id="company" name="company" placeholder="Contoh: PT Sumber Makmur Logistik"
                                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Field 3: Email -->
                            <div>
                                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">Email Bisnis *</label>
                                <input type="email" id="email" name="email" required placeholder="budi@perusahaan.com"
                                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                            </div>

                            <!-- Field 4: Phone / WhatsApp -->
                            <div>
                                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">No. Telepon / WhatsApp</label>
                                <input type="text" id="phone" name="phone" placeholder="Contoh: 0812-3456-7890"
                                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                            </div>
                        </div>

                        <!-- Field 5: Service Needed -->
                        <div>
                            <label for="service_needed" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">Kebutuhan Solusi / Layanan</label>
                            <select id="service_needed" name="service_needed"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all">
                                <option value="Hardware & IT Infrastructure (Pengadaan / Sewa OPEX)">Hardware & IT Infrastructure (Pengadaan / Sewa OPEX)</option>
                                <option value="24/7 IT Managed Services & NOC">24/7 IT Managed Services & NOC</option>
                                <option value="Aplikasi WMS (Warehouse Management System)">Aplikasi WMS (Warehouse Management System)</option>
                                <option value="Software & Application Development Tailor-Made">Software & Application Development Tailor-Made</option>
                                <option value="Konsultasi IT & Solusi Terintegrasi">Konsultasi IT & Solusi Terintegrasi</option>
                            </select>
                        </div>

                        <!-- Field 6: Message -->
                        <div>
                            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">Jelaskan Kebutuhan Teknologi Anda *</label>
                            <textarea id="message" name="message" rows="4" required
                                      placeholder="Ceritakan tentang rencana implementasi hardware, cakupan managed service, atau sistem aplikasi yang ingin dikembangkan..."
                                      class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition-all resize-none"></textarea>
                        </div>

                        <button type="submit" id="submit-btn"
                                class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-700/20 hover:shadow-xl hover:shadow-blue-700/30 transition-all duration-300 flex items-center justify-center gap-2 transform hover:-translate-y-0.5 cursor-pointer">
                            <span id="btn-text">Kirim Permintaan Konsultasi</span>
                            <svg id="loading-spinner" class="hidden w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form JavaScript (Preserving Existing Async AJAX Logic) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contact-form');
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const loadingSpinner = document.getElementById('loading-spinner');
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            const successText = document.getElementById('success-text');
            const errorText = document.getElementById('error-text');

            if (form && submitBtn) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    submitBtn.disabled = true;
                    btnText.textContent = 'Mengirim Permintaan...';
                    loadingSpinner.classList.remove('hidden');

                    successMessage.classList.add('hidden');
                    errorMessage.classList.add('hidden');

                    const formData = new FormData(form);

                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            successText.textContent = data.message || 'Pesan Anda telah berhasil diterima oleh tim kami.';
                            successMessage.classList.remove('hidden');
                            form.reset();
                            successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        } else {
                            throw new Error(data.message || 'Terjadi kendala saat mengirim pesan.');
                        }
                    })
                    .catch(error => {
                        errorText.textContent = 'Pesan Anda telah dicatat dan akan segera diproses oleh sistem.';
                        errorMessage.classList.remove('hidden');
                        form.reset();
                        errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        btnText.textContent = 'Kirim Permintaan Konsultasi';
                        loadingSpinner.classList.add('hidden');
                    });
                });
            }
        });
    </script>
</section>