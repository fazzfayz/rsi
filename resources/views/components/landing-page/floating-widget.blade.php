@props(['settings' => []])
@php
    $whatsapp = !empty($settings['whatsapp']) ? $settings['whatsapp'] : config('rsi.whatsapp', '6281519407954');
    $cleanPhone = preg_replace('/[^0-9]/', '', $whatsapp);
@endphp

<!-- Floating Assistance / Quick WhatsApp Widget (Like Hypernet's Floating Assistant) -->
<div class="fixed bottom-6 right-6 z-50 flex items-center">
    <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20Ruang%20Solusi%20Internusa,%20saya%20tertarik%20konsultasi%20layanan%20IT."
       target="_blank"
       rel="noopener"
       aria-label="Chat WhatsApp Ruang Solusi Internusa"
       class="group relative flex items-center gap-3 bg-white/95 backdrop-blur-md pl-3.5 pr-5 py-2.5 rounded-full border border-blue-200/90 shadow-xl shadow-blue-900/15 hover:shadow-2xl hover:border-blue-400 hover:scale-105 transition-all duration-300">
        <!-- Ripple Pulse Effect Around Avatar/Icon -->
        <div class="relative flex items-center justify-center">
            <span class="absolute w-10 h-10 rounded-full bg-emerald-400 opacity-75 animate-ping"></span>
            <div class="relative w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center text-lg shadow-md">
                <i class="fab fa-whatsapp"></i>
            </div>
        </div>

        <div class="flex flex-col text-left">
            <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Online Helpdesk</span>
            </span>
            <span class="text-sm font-extrabold text-blue-950 group-hover:text-blue-700 transition-colors">
                Tanya Tim Solusi
            </span>
        </div>
    </a>
</div>
