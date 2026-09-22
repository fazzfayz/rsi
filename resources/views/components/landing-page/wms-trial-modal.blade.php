@props(['settings' => []])
@php
    $defaultDemoUrl = route('wms.demo');
    $wmsDemoUrl = (!empty($settings['wms_demo_url']) && $settings['wms_demo_url'] !== 'https://demo-wms.ruang-solusi.com') 
        ? $settings['wms_demo_url'] 
        : (config('rsi.wms_demo_url') && config('rsi.wms_demo_url') !== 'https://demo-wms.ruang-solusi.com' ? config('rsi.wms_demo_url') : $defaultDemoUrl);
    $wmsHost = parse_url($wmsDemoUrl, PHP_URL_HOST) ?? request()->getHost();
@endphp

<!-- Interactive WMS Trial Modal -->
<div id="wmsTrialModal"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/70 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300"
     role="dialog"
     aria-modal="true"
     aria-labelledby="wmsModalTitle">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-blue-100 transform scale-95 transition-all duration-300 relative overflow-hidden"
         id="wmsModalContent">
        <!-- Top Gradient Strip -->
        <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700"></div>

        <!-- Close Button -->
        <button type="button"
                onclick="window.closeWmsTrialModal()"
                class="absolute top-5 right-5 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 hover:text-gray-800 flex items-center justify-center transition-colors">
            <i class="fas fa-times"></i>
        </button>

        <!-- Header -->
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl">
                <i class="fas fa-boxes-stacked"></i>
            </div>
            <div>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span> Live Realtime
                </span>
                <h3 id="wmsModalTitle" class="text-xl font-bold text-gray-900">Trial Online Aplikasi WMS RSI</h3>
            </div>
        </div>

        <p class="text-sm text-gray-600 leading-relaxed mb-6">
            Eksplorasi seluruh modul manajemen gudang mulai dari inbound, barcode scanning rak, hingga outbound dispatch secara langsung di lingkungan realtime.
        </p>

        <!-- Option 1: Instant Sandbox Access -->
        <div class="bg-blue-50/70 rounded-2xl p-4 border border-blue-200/80 mb-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold text-blue-900 uppercase tracking-wider">Akses Demo Sandbox Instan</span>
                <span class="text-[11px] font-semibold text-blue-700 bg-white px-2 py-0.5 rounded border border-blue-100">Siap Digunakan</span>
            </div>
            <div class="space-y-1 text-xs text-gray-700 font-mono mb-3">
                <div><strong>Portal:</strong> <span class="text-blue-700 underline">{{ $wmsHost }}</span></div>
                <div><strong>Role:</strong> Warehouse Supervisor (Full Access)</div>
            </div>
            <a href="{{ $wmsDemoUrl }}"
               target="_blank"
               rel="noopener noreferrer"
               class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-white bg-blue-700 hover:bg-blue-800 transition-colors shadow-sm">
                <span>Buka Demo Sandbox Sekarang</span>
                <i class="fas fa-external-link-alt text-xs"></i>
            </a>
        </div>

        <!-- Option 2: Request Dedicated Trial for Company -->
        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200 mb-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-bold text-gray-900 uppercase tracking-wider">Request Akun Trial Khusus Perusahaan</span>
                <span class="text-[11px] font-medium text-gray-500">Kustom Data</span>
            </div>
            <p class="text-xs text-gray-600 mb-3">
                Dapatkan database sandbox terisolasi dengan data master barang & layout gudang perusahaan Anda sendiri (gratis hingga 14 hari).
            </p>
            <a href="https://wa.me/6281519407954?text=Halo%20RSI,%20perusahaan%20saya%20ingin%20request%20Trial%20Akun%20Khusus%20WMS%20dengan%20data%20gudang%20kami"
               target="_blank"
               class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-emerald-800 bg-emerald-50 hover:bg-emerald-100 border border-emerald-300 transition-colors">
                <i class="fab fa-whatsapp text-emerald-600 text-base"></i>
                <span>Hubungi Tim Sales WMS via WhatsApp</span>
            </a>
        </div>

        <!-- Footer Note -->
        <div class="text-center text-[11px] text-gray-500">
            Tanpa perlu instalasi software. Dapat diakses langsung melalui browser desktop & mobile scanner.
        </div>
    </div>
</div>

<script>
    window.openWmsTrialModal = function() {
        const modal = document.getElementById('wmsTrialModal');
        const content = document.getElementById('wmsModalContent');
        if (modal && content) {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeWmsTrialModal = function() {
        const modal = document.getElementById('wmsTrialModal');
        const content = document.getElementById('wmsModalContent');
        if (modal && content) {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            document.body.style.overflow = '';
        }
    };

    // Close on outside click or Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            window.closeWmsTrialModal();
        }
    });

    document.getElementById('wmsTrialModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            window.closeWmsTrialModal();
        }
    });
</script>
