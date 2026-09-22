<section id="portfolio" class="py-20 md:py-28 bg-slate-50 relative overflow-hidden">
    <!-- Ambient Background Light -->
    <div class="absolute top-1/2 left-0 w-80 h-80 bg-blue-100/40 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-100/40 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex items-center gap-2 text-xs sm:text-sm font-extrabold tracking-wider text-blue-700 uppercase bg-blue-100/80 border border-blue-200 px-4 py-1.5 rounded-full mb-4 shadow-sm">
                <i class="fas fa-briefcase text-blue-600"></i>
                <span>Rekam Jejak Implementasi Solusi</span>
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                Portofolio Proyek & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-blue-600">Studi Kasus Klien</span>
            </h2>
            <p class="text-base sm:text-lg text-gray-600 leading-relaxed font-normal">
                Eksplorasi bagaimana RSI mengintegrasikan perangkat keras, mengelola operasional IT harian, dan membangun aplikasi kustom untuk memecahkan tantangan riil di berbagai sektor.
            </p>
        </div>

        <!-- Filterable Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-12">
            <button type="button"
                    class="portfolio-tab-btn active px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-200 bg-blue-700 text-white shadow-md shadow-blue-700/20"
                    data-filter="all">
                Semua Proyek
            </button>
            <button type="button"
                    class="portfolio-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 bg-white text-gray-600 hover:text-blue-700 border border-gray-200 hover:border-blue-300"
                    data-filter="hardware">
                Hardware & Infra
            </button>
            <button type="button"
                    class="portfolio-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 bg-white text-gray-600 hover:text-blue-700 border border-gray-200 hover:border-blue-300"
                    data-filter="managed">
                Managed Service 24/7
            </button>
            <button type="button"
                    class="portfolio-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 bg-white text-gray-600 hover:text-blue-700 border border-gray-200 hover:border-blue-300"
                    data-filter="wms">
                WMS Enterprise
            </button>
            <button type="button"
                    class="portfolio-tab-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 bg-white text-gray-600 hover:text-blue-700 border border-gray-200 hover:border-blue-300"
                    data-filter="software">
                Web & Mobile Apps
            </button>
        </div>

        <!-- Portfolio Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="portfolio-grid">
            <!-- Project 1: Hardware & Infrastructure -->
            <div class="portfolio-card bg-white rounded-3xl p-7 border border-blue-100/90 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col justify-between group"
                 data-category="hardware">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-blue-800 border border-blue-100">
                            <i class="fas fa-server text-blue-600"></i> Hardware & Infra
                        </span>
                        <span class="text-xs text-gray-400 font-medium">Manufaktur Otomotif</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors mb-2.5 leading-snug">
                        Implementasi Server Rack & All-Flash SAN Storage Redundant
                    </h3>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6">
                        Pengadaan skema sewa OPEX untuk 4 server blade, storage SAN All-Flash NVMe 40TB, serta instalasi UPS sentral 20kVA dengan sistem failover otomatis tanpa henti produksi.
                    </p>

                    <div class="p-3.5 bg-slate-50 rounded-xl border border-gray-100 mb-6 space-y-1.5">
                        <div class="text-[11px] font-bold text-gray-700 uppercase tracking-wider">Hasil Terukur:</div>
                        <div class="text-xs text-emerald-700 font-semibold flex items-center gap-1.5">
                            <i class="fas fa-arrow-trend-up"></i>
                            <span>Zero Downtime produksi pabrik & 40% efisiensi biaya modal CAPEX</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                    <span class="font-medium">Perangkat: HPE ProLiant, SAN NVMe</span>
                    <a href="#kontak" class="font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
                        Konsultasi <i class="fas fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Project 2: Managed Service -->
            <div class="portfolio-card bg-white rounded-3xl p-7 border border-blue-100/90 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col justify-between group"
                 data-category="managed">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-blue-800 border border-blue-100">
                            <i class="fas fa-network-wired text-blue-600"></i> Managed Service 24/7
                        </span>
                        <span class="text-xs text-gray-400 font-medium">Retail Chain 35 Cabang</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors mb-2.5 leading-snug">
                        24/7 NOC Monitoring & IT Support Multi-Cabang Terpadu
                    </h3>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6">
                        Pengelolaan konektivitas SD-WAN 35 cabang toko ritel, pemantauan status mesin kasir POS, backup database transaksi tiap malam, dan respons teknisi onsite &lt; 2 jam.
                    </p>

                    <div class="p-3.5 bg-slate-50 rounded-xl border border-gray-100 mb-6 space-y-1.5">
                        <div class="text-[11px] font-bold text-gray-700 uppercase tracking-wider">Hasil Terukur:</div>
                        <div class="text-xs text-emerald-700 font-semibold flex items-center gap-1.5">
                            <i class="fas fa-arrow-trend-up"></i>
                            <span>SLA tercapai 99.94% & pengurangan biaya helpdesk internal sebesar 35%</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                    <span class="font-medium">Cakupan: 24/7 NOC, Onsite SLA</span>
                    <a href="#kontak" class="font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
                        Konsultasi <i class="fas fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Project 3: WMS Implementation -->
            <div class="portfolio-card bg-white rounded-3xl p-7 border border-blue-100/90 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col justify-between group"
                 data-category="wms">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-100">
                            <i class="fas fa-boxes-stacked text-emerald-600"></i> WMS Enterprise
                        </span>
                        <span class="text-xs text-gray-400 font-medium">Distribusi FMCG</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors mb-2.5 leading-snug">
                        Deployment WMS Realtime & Integrasi Barcode Scanner PDA
                    </h3>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6">
                        Penerapan sistem WMS RSI pada gudang seluas 8.000 m² mencakup 15 unit handheld PDA barcode scanner, pemetaan lokasi rak bin 3D, dan alur FIFO/FEFO terotomatisasi.
                    </p>

                    <div class="p-3.5 bg-slate-50 rounded-xl border border-gray-100 mb-6 space-y-1.5">
                        <div class="text-[11px] font-bold text-gray-700 uppercase tracking-wider">Hasil Terukur:</div>
                        <div class="text-xs text-emerald-700 font-semibold flex items-center gap-1.5">
                            <i class="fas fa-arrow-trend-up"></i>
                            <span>Akurasi stok meningkat jadi 99.92% & kecepatan picking naik 2.8x lipat</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                    <span class="font-medium">Modul: Inbound, PDA, Bin Map</span>
                    <a href="#wms-product" class="font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
                        Coba Demo <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Project 4: Web & Mobile Software -->
            <div class="portfolio-card bg-white rounded-3xl p-7 border border-blue-100/90 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col justify-between group"
                 data-category="software">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-800 border border-indigo-100">
                            <i class="fas fa-laptop-code text-indigo-600"></i> Web & Mobile Apps
                        </span>
                        <span class="text-xs text-gray-400 font-medium">Logistik & Cargo</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors mb-2.5 leading-snug">
                        Custom ERP & Portal Pelacakan Muatan Kargo Terintegrasi
                    </h3>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6">
                        Pembangunan aplikasi web ERP logistik kustom beserta aplikasi mobile driver dengan tanda tangan elektronik (e-POD) dan live GPS tracking untuk ekspedisi antarpulau.
                    </p>

                    <div class="p-3.5 bg-slate-50 rounded-xl border border-gray-100 mb-6 space-y-1.5">
                        <div class="text-[11px] font-bold text-gray-700 uppercase tracking-wider">Hasil Terukur:</div>
                        <div class="text-xs text-emerald-700 font-semibold flex items-center gap-1.5">
                            <i class="fas fa-arrow-trend-up"></i>
                            <span>Penagihan invoice lebih cepat 5 hari kerja & transparansi pengiriman 100%</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                    <span class="font-medium">Stack: Laravel, Flutter, PostgreSQL</span>
                    <a href="#kontak" class="font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
                        Konsultasi <i class="fas fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Project 5: Hardware & Infrastructure -->
            <div class="portfolio-card bg-white rounded-3xl p-7 border border-blue-100/90 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col justify-between group"
                 data-category="hardware">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-blue-800 border border-blue-100">
                            <i class="fas fa-wifi text-blue-600"></i> Hardware & Infra
                        </span>
                        <span class="text-xs text-gray-400 font-medium">Rumah Sakit Swasta</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors mb-2.5 leading-snug">
                        Infrastruktur Jaringan Wi-Fi Terisolasi & Next-Gen Firewall
                    </h3>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6">
                        Pemasangan 60 unit Access Point enterprise, pemisahan VLAN rekam medis pasien dan Wi-Fi pengunjung, serta instalasi Fortinet NGFW untuk keamanan siber berstandar HIPAA.
                    </p>

                    <div class="p-3.5 bg-slate-50 rounded-xl border border-gray-100 mb-6 space-y-1.5">
                        <div class="text-[11px] font-bold text-gray-700 uppercase tracking-wider">Hasil Terukur:</div>
                        <div class="text-xs text-emerald-700 font-semibold flex items-center gap-1.5">
                            <i class="fas fa-arrow-trend-up"></i>
                            <span>Koneksi tanpa dead-zone di 5 lantai gedung & perlindungan data medis aman</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                    <span class="font-medium">Perangkat: Cisco, Fortinet NGFW</span>
                    <a href="#kontak" class="font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
                        Konsultasi <i class="fas fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Project 6: Software & Managed Service -->
            <div class="portfolio-card bg-white rounded-3xl p-7 border border-blue-100/90 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 flex flex-col justify-between group"
                 data-category="software">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-800 border border-indigo-100">
                            <i class="fas fa-mobile-alt text-indigo-600"></i> Web & Mobile Apps
                        </span>
                        <span class="text-xs text-gray-400 font-medium">Distributor Farmasi</span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors mb-2.5 leading-snug">
                        Aplikasi Sales Force Automation (SFA) & Order Mobile
                    </h3>

                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6">
                        Aplikasi mobile tenaga penjualan lapangan untuk pembuatan pesanan obat langsung ke apotek dengan validasi batas kredit, kalkulasi diskon bertingkat, dan sinkronisasi realtime.
                    </p>

                    <div class="p-3.5 bg-slate-50 rounded-xl border border-gray-100 mb-6 space-y-1.5">
                        <div class="text-[11px] font-bold text-gray-700 uppercase tracking-wider">Hasil Terukur:</div>
                        <div class="text-xs text-emerald-700 font-semibold flex items-center gap-1.5">
                            <i class="fas fa-arrow-trend-up"></i>
                            <span>Proses PO dari 2 hari terpangkas jadi 15 menit & akurasi pesanan 100%</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                    <span class="font-medium">Stack: Flutter, REST API, MySQL</span>
                    <a href="#kontak" class="font-bold text-blue-700 hover:text-blue-900 flex items-center gap-1">
                        Konsultasi <i class="fas fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Consultation Banner Under Portfolio -->
        <div class="mt-14 p-8 rounded-3xl bg-gradient-to-r from-blue-900 to-indigo-900 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
            <div>
                <h4 class="text-xl sm:text-2xl font-bold text-white mb-2">Ingin Mengimplementasikan Solusi Serupa di Perusahaan Anda?</h4>
                <p class="text-sm text-blue-100/80 max-w-2xl">Diskusikan kebutuhan infrastruktur, managed service, atau aplikasi Anda bersama tim IT solution architect RSI tanpa biaya komitmen awal.</p>
            </div>
            <a href="#kontak" class="px-8 py-3.5 rounded-xl bg-white text-blue-900 font-bold text-sm hover:bg-blue-50 shadow-md transition-all shrink-0">
                Minta Proposal Proyek
            </a>
        </div>
    </div>
</section>

<!-- Vanilla JS Filter Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabBtns = document.querySelectorAll('.portfolio-tab-btn');
        const cards = document.querySelectorAll('.portfolio-card');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active tab styles
                tabBtns.forEach(b => {
                    b.classList.remove('bg-blue-700', 'text-white', 'shadow-md', 'shadow-blue-700/20', 'active');
                    b.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
                });
                this.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200');
                this.classList.add('bg-blue-700', 'text-white', 'shadow-md', 'shadow-blue-700/20', 'active');

                const filter = this.getAttribute('data-filter');

                // Filter cards
                cards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        card.style.display = 'flex';
                        card.classList.remove('opacity-0', 'scale-95');
                        card.classList.add('opacity-100', 'scale-100');
                    } else {
                        card.style.display = 'none';
                        card.classList.remove('opacity-100', 'scale-100');
                        card.classList.add('opacity-0', 'scale-95');
                    }
                });
            });
        });
    });
</script>
