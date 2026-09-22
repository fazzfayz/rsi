<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSI WMS • Warehouse Management System (Demo Standar)</title>
    <meta name="description" content="Sistem Manajemen Pergudangan (WMS) RSI. Kelola master barang, inbound PO, outbound Surat Jalan, denah rak, dan mutasi stok secara mudah dan efisien.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS (Clean Enterprise Palette) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        /* Clean corporate scrollbars */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Subtle scan flash */
        @keyframes scanFlash {
            0% { background-color: rgba(37, 99, 235, 0.15); }
            100% { background-color: transparent; }
        }
        .scan-flash-anim {
            animation: scanFlash 0.5s ease-out;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 font-sans min-h-screen antialiased flex flex-col"
      x-data="wmsApp()"
      x-init="initApp()"
      x-cloak>

    <!-- Scanner Beep Audio Synthesizer -->
    <script>
        window.playBeepSound = function() {
            try {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (!AudioContext) return;
                const ctx = new AudioContext();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(1800, ctx.currentTime);
                gain.gain.setValueAtTime(0.15, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.1);
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.start();
                osc.stop(ctx.currentTime + 0.1);
            } catch(e) {}
        };

        window.playSuccessSound = function() {
            try {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (!AudioContext) return;
                const ctx = new AudioContext();
                const now = ctx.currentTime;
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.type = 'triangle';
                osc.frequency.setValueAtTime(587.33, now);
                osc.frequency.setValueAtTime(880, now + 0.08);
                gain.gain.setValueAtTime(0.15, now);
                gain.gain.exponentialRampToValueAtTime(0.001, now + 0.25);
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.start(now);
                osc.stop(now + 0.25);
            } catch(e) {}
        };
    </script>

    <!-- Top Simple Corporate Header Bar -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm">
        <div class="px-4 sm:px-6 py-3 flex items-center justify-between">
            
            <!-- Left: Brand & Warehouse Info -->
            <div class="flex items-center gap-3">
                <button type="button"
                        @click="sidebarOpen = !sidebarOpen"
                        class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none">
                    <i class="fas fa-bars text-lg"></i>
                </button>

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-blue-700 text-white flex items-center justify-center font-bold text-base shadow-sm">
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-extrabold text-slate-900 text-sm tracking-tight">RSI WMS</span>
                            <span class="px-1.5 py-0.5 rounded bg-blue-50 border border-blue-200 text-blue-700 text-[10px] font-bold">Standard ERP</span>
                        </div>
                        <p class="text-[11px] text-slate-500 font-medium">Warehouse Management System</p>
                    </div>
                </div>

                <div class="hidden lg:flex items-center gap-2 ml-6 pl-6 border-l border-slate-200 text-xs text-slate-600">
                    <i class="fas fa-warehouse text-blue-600"></i>
                    <span>Lokasi: <strong class="text-slate-800">Gudang Pusat RSI - Jakarta Barat</strong></span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-semibold border border-emerald-200 ml-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Online
                    </span>
                </div>
            </div>

            <!-- Right: Action Buttons -->
            <div class="flex items-center gap-2 sm:gap-3">
                
                <!-- Reset Data Demo Button -->
                <button type="button"
                        @click="resetDemoData()"
                        title="Kembalikan data barang, PO, dan DO ke kondisi awal"
                        class="px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold flex items-center gap-1.5 shadow-sm transition-colors">
                    <i class="fas fa-arrow-rotate-left text-slate-400"></i>
                    <span class="hidden sm:inline">Reset Data Demo</span>
                </button>

                <!-- Back to Landing Page -->
                <a href="{{ route('landing') }}"
                   class="px-3 py-1.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 text-xs font-semibold flex items-center gap-1.5 shadow-sm transition-colors">
                    <i class="fas fa-arrow-left text-slate-400"></i>
                    <span class="hidden sm:inline">Kembali ke Web RSI</span>
                </a>

                <!-- CTA Konsultasi WMS -->
                <button type="button"
                        @click="openLeadModal()"
                        class="px-3.5 py-1.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-colors">
                    <i class="fab fa-whatsapp text-sm"></i>
                    <span>Konsultasi WMS</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main App Body: Sidebar + Main Content -->
    <div class="flex-1 flex overflow-hidden">
        
        <!-- ============================================================= -->
        <!-- STANDARD WMS SIDEBAR NAVIGATION                               -->
        <!-- ============================================================= -->
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col justify-between shrink-0 transition-all z-20"
               :class="sidebarOpen ? 'fixed inset-y-0 left-0 shadow-2xl md:static md:shadow-none' : 'hidden md:flex'">
            
            <div class="p-4 space-y-6 overflow-y-auto">
                
                <!-- Warehouse Quick Switcher -->
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-xs">
                    <div class="text-[11px] text-slate-500 font-semibold uppercase tracking-wider mb-1">Gudang Aktif</div>
                    <div class="font-bold text-slate-900 flex items-center justify-between">
                        <span>Gudang Utama (HUB-01)</span>
                        <i class="fas fa-check text-emerald-600 text-xs"></i>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-0.5">Kapasitas Rak: <strong class="text-blue-700" x-text="occupancyRate + '%'"></strong></div>
                </div>

                <!-- Navigation Menu Links -->
                <nav class="space-y-1">
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-3 mb-2">Menu Operasional</div>
                    
                    <!-- 1. Dashboard -->
                    <button type="button"
                            @click="activeTab = 'overview'; sidebarOpen = false"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold transition-colors"
                            :class="activeTab === 'overview' ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'">
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-gauge-high w-4 text-center" :class="activeTab === 'overview' ? 'text-blue-700' : 'text-slate-400'"></i>
                            <span>Dashboard Utama</span>
                        </div>
                    </button>

                    <!-- 2. Master Data Barang (CRUD) -->
                    <button type="button"
                            @click="activeTab = 'items'; sidebarOpen = false"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold transition-colors"
                            :class="activeTab === 'items' ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'">
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-boxes-stacked w-4 text-center" :class="activeTab === 'items' ? 'text-blue-700' : 'text-slate-400'"></i>
                            <span>Master Data Barang</span>
                        </div>
                        <span class="px-1.5 py-0.2 rounded text-[10px] font-mono font-bold bg-slate-200 text-slate-700" x-text="inventoryList.length"></span>
                    </button>

                    <!-- 3. Inbound (PO Masuk CRUD) -->
                    <button type="button"
                            @click="activeTab = 'inbound'; sidebarOpen = false"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold transition-colors"
                            :class="activeTab === 'inbound' ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'">
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-truck-ramp-box w-4 text-center" :class="activeTab === 'inbound' ? 'text-blue-700' : 'text-slate-400'"></i>
                            <span>Inbound (Penerimaan PO)</span>
                        </div>
                        <span class="px-1.5 py-0.2 rounded text-[10px] font-mono font-bold"
                              :class="inboundList.length > 0 ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-500'"
                              x-text="inboundList.length"></span>
                    </button>

                    <!-- 4. Outbound (Surat Jalan & Picking CRUD) -->
                    <button type="button"
                            @click="activeTab = 'outbound'; sidebarOpen = false"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold transition-colors"
                            :class="activeTab === 'outbound' ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'">
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-dolly w-4 text-center" :class="activeTab === 'outbound' ? 'text-blue-700' : 'text-slate-400'"></i>
                            <span>Outbound (Surat Jalan)</span>
                        </div>
                        <span class="px-1.5 py-0.2 rounded text-[10px] font-mono font-bold"
                              :class="outboundList.length > 0 ? 'bg-rose-100 text-rose-800' : 'bg-slate-100 text-slate-500'"
                              x-text="outboundList.length"></span>
                    </button>

                    <!-- 5. Lokasi Rak Gudang -->
                    <button type="button"
                            @click="activeTab = 'racks'; sidebarOpen = false"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold transition-colors"
                            :class="activeTab === 'racks' ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'">
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-table-cells w-4 text-center" :class="activeTab === 'racks' ? 'text-blue-700' : 'text-slate-400'"></i>
                            <span>Denah & Lokasi Rak</span>
                        </div>
                        <span class="px-1.5 py-0.2 rounded text-[10px] font-mono font-bold bg-slate-100 text-slate-600" x-text="racks.length + ' Rak'"></span>
                    </button>

                    <!-- 6. Riwayat Mutasi Stok -->
                    <button type="button"
                            @click="activeTab = 'logs'; sidebarOpen = false"
                            class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-semibold transition-colors"
                            :class="activeTab === 'logs' ? 'bg-blue-50 text-blue-700 font-bold border border-blue-200' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'">
                        <div class="flex items-center gap-2.5">
                            <i class="fas fa-clock-rotate-left w-4 text-center" :class="activeTab === 'logs' ? 'text-blue-700' : 'text-slate-400'"></i>
                            <span>Riwayat Mutasi Stok</span>
                        </div>
                    </button>
                </nav>

            </div>

            <!-- Bottom Sidebar Lead Banner -->
            <div class="p-4 border-t border-slate-200 bg-slate-50">
                <div class="text-xs">
                    <strong class="text-slate-800 block">Kustomisasi WMS Perusahaan</strong>
                    <p class="text-[11px] text-slate-500 mt-1 leading-snug">Butuh modul barcode scanner Zebra, integrasi SAP/ERP, atau kustom alur gudang?</p>
                    <button type="button"
                            @click="openLeadModal()"
                            class="mt-2.5 w-full py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs flex items-center justify-center gap-1.5 shadow-sm transition-colors">
                        <i class="fas fa-envelope-open-text"></i>
                        <span>Minta Penawaran Resmi</span>
                    </button>
                </div>
            </div>
        </aside>

        <!-- ============================================================= -->
        <!-- MAIN CONTENT AREA                                             -->
        <!-- ============================================================= -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 space-y-6">
            
            <!-- Simple Breadcrumb & Page Title Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-200">
                <div>
                    <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                        <span>WMS RSI</span>
                        <i class="fas fa-chevron-right text-[10px]"></i>
                        <span class="text-slate-800 font-semibold"
                              x-text="{
                                  'overview': 'Dashboard Utama',
                                  'items': 'Master Data Barang (Stok & SKU)',
                                  'inbound': 'Inbound / Penerimaan Barang (PO)',
                                  'outbound': 'Outbound / Surat Jalan & Picking',
                                  'racks': 'Peta & Lokasi Rak Gudang',
                                  'logs': 'Riwayat Mutasi Stok'
                              }[activeTab]"></span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-bold text-slate-900"
                        x-text="{
                            'overview': 'Dashboard Operasional Pergudangan',
                            'items': 'Master Data Barang Gudang',
                            'inbound': 'Penerimaan Barang Masuk (Inbound)',
                            'outbound': 'Pengeluaran Barang & Surat Jalan (Outbound)',
                            'racks': 'Tata Letak & Kapasitas Rak Gudang',
                            'logs': 'Laporan Mutasi & Audit Log Realtime'
                        }[activeTab]"></h1>
                </div>

                <!-- Action Button Depending on Current Tab -->
                <div class="flex items-center gap-2">
                    <template x-if="activeTab === 'items'">
                        <button type="button"
                                @click="openAddItemModal()"
                                class="px-4 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-colors">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Barang Baru</span>
                        </button>
                    </template>

                    <template x-if="activeTab === 'inbound'">
                        <button type="button"
                                @click="openAddPOModal()"
                                class="px-4 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-colors">
                            <i class="fas fa-plus"></i>
                            <span>Buat Inbound PO Baru</span>
                        </button>
                    </template>

                    <template x-if="activeTab === 'outbound'">
                        <button type="button"
                                @click="openAddOrderModal()"
                                class="px-4 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition-colors">
                            <i class="fas fa-plus"></i>
                            <span>Buat Surat Jalan (DO) Baru</span>
                        </button>
                    </template>
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- 1. DASHBOARD OVERVIEW                                     -->
            <!-- ========================================================= -->
            <div x-show="activeTab === 'overview'" class="space-y-6">
                
                <!-- 4 Simple KPI Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between text-slate-500 text-xs mb-2">
                            <span>Total Stok Fisik</span>
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center font-bold">
                                <i class="fas fa-boxes-stacked"></i>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-slate-900" x-text="totalPhysicalStock.toLocaleString() + ' Unit'"></div>
                        <div class="text-xs text-slate-500 mt-1" x-text="inventoryList.length + ' Macam SKU Terdaftar'"></div>
                    </div>

                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between text-slate-500 text-xs mb-2">
                            <span>Kapasitas Rak Terpakai</span>
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center font-bold">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-slate-900" x-text="occupancyRate + '%'"></div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2 overflow-hidden">
                            <div class="h-1.5 rounded-full bg-blue-700" :style="`width: ${occupancyRate}%`"></div>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between text-slate-500 text-xs mb-2">
                            <span>Inbound (PO Pending)</span>
                            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center font-bold">
                                <i class="fas fa-truck-ramp-box"></i>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-slate-900" x-text="inboundList.length + ' Shipment'"></div>
                        <div class="text-xs text-amber-700 mt-1 font-semibold flex items-center gap-1">
                            <i class="fas fa-clock text-[10px]"></i> Siap diproses terima
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between text-slate-500 text-xs mb-2">
                            <span>Outbound (DO Pending)</span>
                            <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center font-bold">
                                <i class="fas fa-dolly"></i>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-slate-900" x-text="outboundList.length + ' Order'"></div>
                        <div class="text-xs text-rose-700 mt-1 font-semibold flex items-center gap-1">
                            <i class="fas fa-box text-[10px]"></i> Menunggu picking & packing
                        </div>
                    </div>
                </div>

                <!-- Two Column Dashboard Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Left: Quick Links & Guide -->
                    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 p-6 shadow-sm space-y-4">
                        <h2 class="text-base font-bold text-slate-900">Alur Standar Penggunaan Warehouse Management System</h2>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Aplikasi WMS ini dirancang dengan standar tata kelola pergudangan modern. Anda dapat menambah, mengedit, dan menghapus data barang, memproses penerimaan faktur pembelian (PO), hingga membuat surat jalan untuk pengiriman pelanggan.
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                            <div @click="activeTab = 'items'" class="p-4 rounded-lg border border-slate-200 hover:border-blue-400 hover:bg-blue-50/50 cursor-pointer transition-all">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold mb-2">
                                    <i class="fas fa-boxes-stacked"></i>
                                </div>
                                <h4 class="text-xs font-bold text-slate-900">1. Kelola Barang (CRUD)</h4>
                                <p class="text-[11px] text-slate-500 mt-1">Tambah barang baru, ubah stok, atau hapus item dari katalog gudang.</p>
                            </div>

                            <div @click="activeTab = 'inbound'" class="p-4 rounded-lg border border-slate-200 hover:border-blue-400 hover:bg-blue-50/50 cursor-pointer transition-all">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold mb-2">
                                    <i class="fas fa-truck-arrow-right"></i>
                                </div>
                                <h4 class="text-xs font-bold text-slate-900">2. Terima Barang (PO)</h4>
                                <p class="text-[11px] text-slate-500 mt-1">Catat kedatangan barang supplier dan tempatkan langsung ke rak tujuan.</p>
                            </div>

                            <div @click="activeTab = 'outbound'" class="p-4 rounded-lg border border-slate-200 hover:border-blue-400 hover:bg-blue-50/50 cursor-pointer transition-all">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-700 flex items-center justify-center font-bold mb-2">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <h4 class="text-xs font-bold text-slate-900">3. Kirim Barang (DO)</h4>
                                <p class="text-[11px] text-slate-500 mt-1">Buat surat jalan pesanan pelanggan, ambil barang dari rak, dan potong stok.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Recent Activity Log -->
                    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-base font-bold text-slate-900">Aktivitas Terkini</h2>
                                <button type="button" @click="activeTab = 'logs'" class="text-xs text-blue-700 hover:underline font-semibold">Lihat Semua</button>
                            </div>
                            
                            <div class="space-y-3 overflow-y-auto max-h-72 pr-1 text-xs">
                                <template x-for="log in auditLogs.slice(0, 5)" :key="log.id">
                                    <div class="p-3 rounded-lg bg-slate-50 border border-slate-200">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="px-1.5 py-0.2 rounded text-[10px] font-bold font-mono"
                                                  :class="{
                                                      'bg-emerald-100 text-emerald-800': log.type === 'INBOUND',
                                                      'bg-rose-100 text-rose-800': log.type === 'OUTBOUND',
                                                      'bg-blue-100 text-blue-800': log.type === 'TAMBAH' || log.type === 'EDIT',
                                                      'bg-red-100 text-red-800': log.type === 'HAPUS'
                                                  }"
                                                  x-text="log.type"></span>
                                            <span class="text-[10px] text-slate-400 font-mono" x-text="log.time"></span>
                                        </div>
                                        <div class="text-slate-800 font-medium text-[11px]" x-text="log.message"></div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- 2. MASTER DATA BARANG (CRUD LENGKAP: TAMBAH, EDIT, HAPUS) -->
            <!-- ========================================================= -->
            <div x-show="activeTab === 'items'" class="space-y-4">
                
                <!-- Table Controls: Search, Category Filter, and Add Button -->
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3">
                    
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                        <!-- Search Box -->
                        <div class="w-full sm:w-72 relative">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text"
                                   x-model="searchQuery"
                                   placeholder="Cari SKU, Nama Barang, Rak..."
                                   class="w-full pl-9 pr-3 py-2 rounded-lg border border-slate-300 text-xs text-slate-800 placeholder:text-slate-400 focus:outline-none focus:border-blue-600">
                        </div>

                        <!-- Category Filter -->
                        <select x-model="selectedCategoryFilter"
                                class="w-full sm:w-auto px-3 py-2 rounded-lg border border-slate-300 text-xs text-slate-700 bg-white focus:outline-none focus:border-blue-600">
                            <option value="ALL">Semua Kategori</option>
                            <option value="IT & Elektronik">IT & Elektronik</option>
                            <option value="FMCG & Retail">FMCG & Ritel</option>
                            <option value="Sparepart Industri">Sparepart Industri</option>
                        </select>
                    </div>

                    <!-- Right Add Button -->
                    <button type="button"
                            @click="openAddItemModal()"
                            class="w-full sm:w-auto px-4 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold flex items-center justify-center gap-1.5 shadow-sm transition-colors shrink-0">
                        <i class="fas fa-plus"></i>
                        <span>+ Tambah Barang Baru</span>
                    </button>
                </div>

                <!-- Main Inventory Table -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-200">
                                <tr>
                                    <th class="p-3.5">Kode SKU</th>
                                    <th class="p-3.5">Nama Barang</th>
                                    <th class="p-3.5">Kategori</th>
                                    <th class="p-3.5">Lokasi Rak</th>
                                    <th class="p-3.5">Stok Fisik</th>
                                    <th class="p-3.5">No. Batch / Lot</th>
                                    <th class="p-3.5">Status</th>
                                    <th class="p-3.5 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 font-medium">
                                <template x-for="(item, index) in filteredInventory" :key="item.sku">
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="p-3.5 font-mono font-bold text-blue-700" x-text="item.sku"></td>
                                        <td class="p-3.5">
                                            <div class="font-bold text-slate-900" x-text="item.name"></div>
                                            <div class="text-[11px] text-slate-500" x-text="'Barcode: ' + item.barcode"></div>
                                        </td>
                                        <td class="p-3.5">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-700 border border-slate-200" x-text="item.category"></span>
                                        </td>
                                        <td class="p-3.5 font-mono font-bold text-slate-800">
                                            <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-200" x-text="item.rack"></span>
                                        </td>
                                        <td class="p-3.5 font-mono font-bold text-slate-900" x-text="item.qty + ' ' + item.unit"></td>
                                        <td class="p-3.5 font-mono text-slate-600 text-[11px]" x-text="item.lot"></td>
                                        <td class="p-3.5">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold"
                                                  :class="item.qty > 20 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200'"
                                                  x-text="item.qty > 20 ? 'Stok Aman' : 'Stok Menipis'"></span>
                                        </td>
                                        <td class="p-3.5 text-right space-x-1">
                                            <!-- Scan Sound Beep Test -->
                                            <button type="button"
                                                    @click="testScanItem(item)"
                                                    title="Tes Scan Barcode"
                                                    class="p-1.5 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 transition-colors">
                                                <i class="fas fa-barcode text-xs"></i>
                                            </button>

                                            <!-- Edit Item Button -->
                                            <button type="button"
                                                    @click="openEditItemModal(item)"
                                                    title="Edit Data Barang"
                                                    class="p-1.5 rounded-lg border border-slate-200 hover:bg-blue-50 text-blue-700 hover:border-blue-300 transition-colors">
                                                <i class="fas fa-pencil text-xs"></i>
                                            </button>

                                            <!-- Delete Item Button -->
                                            <button type="button"
                                                    @click="confirmDeleteItem(item)"
                                                    title="Hapus Barang dari Master"
                                                    class="p-1.5 rounded-lg border border-slate-200 hover:bg-rose-50 text-rose-600 hover:border-rose-300 transition-colors">
                                                <i class="fas fa-trash-can text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </template>

                                <tr x-show="filteredInventory.length === 0">
                                    <td colspan="8" class="text-center py-10 text-slate-500 text-xs">
                                        <i class="fas fa-inbox text-3xl text-slate-300 mb-2"></i>
                                        <p class="font-semibold text-slate-700">Tidak ada barang yang ditemukan.</p>
                                        <p class="mt-0.5">Silakan tambah barang baru atau sesuaikan kata kunci pencarian.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- 3. INBOUND (PENERIMAAN PO CRUD & PROSES)                  -->
            <!-- ========================================================= -->
            <div x-show="activeTab === 'inbound'" class="space-y-4">
                
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Daftar Faktur Pembelian / PO Masuk (Incoming)</h2>
                        <p class="text-xs text-slate-500">Barang dari pemasok yang tiba di dermaga penerimaan untuk dibongkar dan ditempatkan ke rak.</p>
                    </div>

                    <button type="button"
                            @click="openAddPOModal()"
                            class="w-full sm:w-auto px-4 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold flex items-center justify-center gap-1.5 shadow-sm transition-colors shrink-0">
                        <i class="fas fa-plus"></i>
                        <span>+ Buat PO Masuk Baru</span>
                    </button>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-200">
                                <tr>
                                    <th class="p-3.5">Nomor PO</th>
                                    <th class="p-3.5">Supplier / Vendor</th>
                                    <th class="p-3.5">Item Barang</th>
                                    <th class="p-3.5">Jumlah Masuk</th>
                                    <th class="p-3.5">Rak Alokasi</th>
                                    <th class="p-3.5">Plat Truk</th>
                                    <th class="p-3.5">Status</th>
                                    <th class="p-3.5 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 font-medium">
                                <template x-for="po in inboundList" :key="po.id">
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="p-3.5 font-mono font-bold text-blue-700" x-text="po.number"></td>
                                        <td class="p-3.5 font-bold text-slate-900" x-text="po.vendor"></td>
                                        <td class="p-3.5">
                                            <div class="font-semibold text-slate-800" x-text="po.itemName"></div>
                                            <div class="text-[11px] text-slate-500 font-mono" x-text="'SKU: ' + po.sku"></div>
                                        </td>
                                        <td class="p-3.5 font-mono font-bold text-slate-900" x-text="po.qty + ' ' + po.unit"></td>
                                        <td class="p-3.5 font-mono font-bold text-amber-800">
                                            <span class="px-2 py-0.5 rounded bg-amber-50 border border-amber-200" x-text="po.targetRack"></span>
                                        </td>
                                        <td class="p-3.5 font-mono text-slate-600" x-text="po.truckPlate"></td>
                                        <td class="p-3.5">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200" x-text="po.status"></span>
                                        </td>
                                        <td class="p-3.5 text-right space-x-1">
                                            <!-- Process Receiving Button -->
                                            <button type="button"
                                                    @click="processReceivePO(po)"
                                                    class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition-colors">
                                                <i class="fas fa-barcode mr-1"></i> Terima & Masuk Rak
                                            </button>

                                            <!-- Delete PO Button -->
                                            <button type="button"
                                                    @click="deletePO(po)"
                                                    title="Batalkan / Hapus PO"
                                                    class="p-1.5 rounded-lg border border-slate-200 hover:bg-rose-50 text-rose-600 transition-colors">
                                                <i class="fas fa-trash-can text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </template>

                                <tr x-show="inboundList.length === 0">
                                    <td colspan="8" class="text-center py-10 text-slate-500 text-xs">
                                        <i class="fas fa-check-circle text-3xl text-emerald-500 mb-2"></i>
                                        <p class="font-semibold text-slate-800">Semua PO telah selesai diterima ke gudang!</p>
                                        <p class="mt-0.5">Gunakan tombol "+ Buat Inbound PO Baru" di atas untuk menambahkan pengiriman berikutnya.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- 4. OUTBOUND (SURAT JALAN & PICKING CRUD)                  -->
            <!-- ========================================================= -->
            <div x-show="activeTab === 'outbound'" class="space-y-4">
                
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Daftar Surat Jalan / Delivery Order (DO)</h2>
                        <p class="text-xs text-slate-500">Pesanan barang keluar untuk pelanggan yang harus diambil (picking), dikemas, dan dikirim.</p>
                    </div>

                    <button type="button"
                            @click="openAddOrderModal()"
                            class="w-full sm:w-auto px-4 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold flex items-center justify-center gap-1.5 shadow-sm transition-colors shrink-0">
                        <i class="fas fa-plus"></i>
                        <span>+ Buat Surat Jalan (DO) Baru</span>
                    </button>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-200">
                                <tr>
                                    <th class="p-3.5">Nomor DO</th>
                                    <th class="p-3.5">Nama Customer</th>
                                    <th class="p-3.5">Item yang Dipesan</th>
                                    <th class="p-3.5">Kurir / Ekspedisi</th>
                                    <th class="p-3.5">Prioritas</th>
                                    <th class="p-3.5">Status Picking</th>
                                    <th class="p-3.5 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 font-medium">
                                <template x-for="order in outboundList" :key="order.id">
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="p-3.5 font-mono font-bold text-blue-700" x-text="order.number"></td>
                                        <td class="p-3.5 font-bold text-slate-900" x-text="order.customer"></td>
                                        <td class="p-3.5">
                                            <div class="space-y-1">
                                                <template x-for="item in order.items" :key="item.sku">
                                                    <div class="flex items-center gap-2">
                                                        <span class="font-medium text-slate-800" x-text="item.name + ' (' + item.qty + ' ' + item.unit + ')'"></span>
                                                        <span class="text-[10px] px-1 rounded bg-slate-100 text-slate-600 font-mono" x-text="'Rak ' + item.fromRack"></span>
                                                    </div>
                                                </template>
                                            </div>
                                        </td>
                                        <td class="p-3.5 text-slate-700" x-text="order.courier"></td>
                                        <td class="p-3.5">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold"
                                                  :class="order.priority === 'Urgent' ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-blue-50 text-blue-700 border border-blue-200'"
                                                  x-text="order.priority"></span>
                                        </td>
                                        <td class="p-3.5">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                                Siap Picking
                                            </span>
                                        </td>
                                        <td class="p-3.5 text-right space-x-1">
                                            <!-- Process Picking & Dispatch Button -->
                                            <button type="button"
                                                    @click="processDispatchOrder(order)"
                                                    class="px-3 py-1.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-sm transition-colors">
                                                <i class="fas fa-dolly mr-1"></i> Picking & Dispatch
                                            </button>

                                            <!-- Delete Order Button -->
                                            <button type="button"
                                                    @click="deleteOrder(order)"
                                                    title="Batalkan / Hapus DO"
                                                    class="p-1.5 rounded-lg border border-slate-200 hover:bg-rose-50 text-rose-600 transition-colors">
                                                <i class="fas fa-trash-can text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </template>

                                <tr x-show="outboundList.length === 0">
                                    <td colspan="7" class="text-center py-10 text-slate-500 text-xs">
                                        <i class="fas fa-truck text-3xl text-emerald-500 mb-2"></i>
                                        <p class="font-semibold text-slate-800">Semua pesanan keluar telah berhasil diproses!</p>
                                        <p class="mt-0.5">Gunakan tombol "+ Buat Surat Jalan (DO) Baru" di atas untuk menambah pesanan keluar.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- 5. DENAH & LOKASI RAK (2D GRID STANDAR)                   -->
            <!-- ========================================================= -->
            <div x-show="activeTab === 'racks'" class="space-y-4">
                
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Tata Letak Lokasi Rak Gudang (Bin Locations)</h2>
                        <p class="text-xs text-slate-500">Klik salah satu kotak rak untuk memeriksa daftar barang yang tersimpan di dalamnya.</p>
                    </div>

                    <!-- Legend Indicator -->
                    <div class="flex items-center gap-3 text-xs text-slate-600">
                        <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-emerald-500"></span> < 70% Aman</span>
                        <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-amber-500"></span> 70-89% Padat</span>
                        <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-rose-500"></span> ≥ 90% Penuh</span>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-3">
                        <template x-for="rack in racks" :key="rack.id">
                            <div @click="inspectRack(rack)"
                                 class="p-3 rounded-lg border text-xs cursor-pointer hover:shadow-md transition-all"
                                 :class="{
                                     'border-slate-200 hover:border-blue-500 bg-white': true,
                                     'border-l-4 border-l-emerald-500': getRackUsage(rack) < 70,
                                     'border-l-4 border-l-amber-500': getRackUsage(rack) >= 70 && getRackUsage(rack) < 90,
                                     'border-l-4 border-l-rose-500': getRackUsage(rack) >= 90
                                 }">
                                
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="font-mono font-bold text-slate-900" x-text="rack.code"></span>
                                    <span class="text-[10px] font-semibold text-slate-500" x-text="'Z-' + rack.zone"></span>
                                </div>

                                <div class="w-full bg-slate-100 rounded-full h-1.5 mb-2 overflow-hidden">
                                    <div class="h-1.5 rounded-full"
                                         :class="getRackUsage(rack) >= 90 ? 'bg-rose-500' : (getRackUsage(rack) >= 70 ? 'bg-amber-500' : 'bg-emerald-500')"
                                         :style="`width: ${getRackUsage(rack)}%`"></div>
                                </div>

                                <div class="font-bold text-slate-800 truncate" x-text="rack.primaryItemName || '(Kosong)'"></div>
                                <div class="flex items-center justify-between text-[10px] text-slate-500 mt-1 font-mono">
                                    <span x-text="rack.currentQty + '/' + rack.maxCapacity"></span>
                                    <span class="font-bold" x-text="getRackUsage(rack) + '%'"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- 6. RIWAYAT MUTASI STOK                                    -->
            <!-- ========================================================= -->
            <div x-show="activeTab === 'logs'" class="space-y-4">
                
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-bold text-slate-900">Riwayat Mutasi & Perubahan Data (Audit Log)</h2>
                        <p class="text-xs text-slate-500">Mencatat setiap aksi penambahan barang, penerimaan PO, pengeluaran pesanan, dan penghapusan data.</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 font-mono text-xs font-bold" x-text="auditLogs.length + ' Entri'"></span>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-200">
                            <tr>
                                <th class="p-3.5">Waktu</th>
                                <th class="p-3.5">Tipe Aksi</th>
                                <th class="p-3.5">Aktivitas / Keterangan</th>
                                <th class="p-3.5">Operator</th>
                                <th class="p-3.5">Referensi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium">
                            <template x-for="log in auditLogs" :key="log.id">
                                <tr class="hover:bg-slate-50">
                                    <td class="p-3.5 font-mono text-slate-500" x-text="log.time"></td>
                                    <td class="p-3.5">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold font-mono"
                                              :class="{
                                                  'bg-emerald-50 text-emerald-700 border border-emerald-200': log.type === 'INBOUND',
                                                  'bg-rose-50 text-rose-700 border border-rose-200': log.type === 'OUTBOUND',
                                                  'bg-blue-50 text-blue-700 border border-blue-200': log.type === 'TAMBAH' || log.type === 'EDIT',
                                                  'bg-red-50 text-red-700 border border-red-200': log.type === 'HAPUS'
                                              }"
                                              x-text="log.type"></span>
                                    </td>
                                    <td class="p-3.5 text-slate-800" x-text="log.message"></td>
                                    <td class="p-3.5 text-slate-600" x-text="log.user"></td>
                                    <td class="p-3.5 font-mono text-blue-700" x-text="log.reference"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- ============================================================= -->
    <!-- MODAL 1: FORM TAMBAH BARANG BARU (CRUD)                       -->
    <!-- ============================================================= -->
    <div x-show="addItemModal"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="display: none;">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-200 relative"
             @click.outside="addItemModal = false">
            
            <button type="button"
                    @click="addItemModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 w-8 h-8 rounded-full flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>

            <h3 class="text-base font-bold text-slate-900 mb-1">Tambah Barang Baru ke Master Data</h3>
            <p class="text-xs text-slate-500 mb-4">Masukkan spesifikasi item untuk disimpan di gudang.</p>

            <form @submit.prevent="saveNewItem()" class="space-y-3 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Barang <span class="text-red-500">*</span></label>
                    <input type="text"
                           x-model="itemForm.name"
                           required
                           placeholder="Contoh: Router Mikrotik RB4011"
                           class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 focus:outline-none focus:border-blue-600">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kode SKU <span class="text-red-500">*</span></label>
                        <input type="text"
                               x-model="itemForm.sku"
                               required
                               placeholder="Contoh: IT-MKT-4011"
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 font-mono text-slate-900 focus:outline-none focus:border-blue-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                        <select x-model="itemForm.category"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                            <option value="IT & Elektronik">IT & Elektronik</option>
                            <option value="FMCG & Retail">FMCG & Retail</option>
                            <option value="Sparepart Industri">Sparepart Industri</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Lokasi Rak</label>
                        <select x-model="itemForm.rack"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                            <template x-for="r in racks" :key="r.code">
                                <option :value="r.code" x-text="r.code + ' (Zona ' + r.zone + ')'"></option>
                            </template>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jumlah Stok Awal</label>
                        <input type="number"
                               min="1"
                               x-model.number="itemForm.qty"
                               required
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 font-mono text-slate-900 focus:outline-none focus:border-blue-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Satuan</label>
                        <select x-model="itemForm.unit"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                            <option value="Unit">Unit</option>
                            <option value="Dus">Dus</option>
                            <option value="Box">Box</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Roll">Roll</option>
                            <option value="Drum">Drum</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor Batch / Lot</label>
                    <input type="text"
                           x-model="itemForm.lot"
                           placeholder="Contoh: LOT-2026-09A"
                           class="w-full px-3 py-2 rounded-lg border border-slate-300 font-mono text-slate-900 focus:outline-none focus:border-blue-600">
                </div>

                <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-200">
                    <button type="button"
                            @click="addItemModal = false"
                            class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-semibold">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-bold shadow-sm">
                        Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================= -->
    <!-- MODAL 2: FORM EDIT BARANG (CRUD)                              -->
    <!-- ============================================================= -->
    <div x-show="editItemModal"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="display: none;">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-200 relative"
             @click.outside="editItemModal = false">
            
            <button type="button"
                    @click="editItemModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 w-8 h-8 rounded-full flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>

            <h3 class="text-base font-bold text-slate-900 mb-1">Edit Data Barang</h3>
            <p class="text-xs text-slate-500 mb-4 font-mono" x-text="'SKU: ' + editForm.sku"></p>

            <form @submit.prevent="saveEditedItem()" class="space-y-3 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Barang <span class="text-red-500">*</span></label>
                    <input type="text"
                           x-model="editForm.name"
                           required
                           class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 focus:outline-none focus:border-blue-600">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kategori</label>
                        <select x-model="editForm.category"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                            <option value="IT & Elektronik">IT & Elektronik</option>
                            <option value="FMCG & Retail">FMCG & Retail</option>
                            <option value="Sparepart Industri">Sparepart Industri</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Lokasi Rak</label>
                        <select x-model="editForm.rack"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                            <template x-for="r in racks" :key="r.code">
                                <option :value="r.code" x-text="r.code + ' (Zona ' + r.zone + ')'"></option>
                            </template>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jumlah Stok Fisik</label>
                        <input type="number"
                               min="0"
                               x-model.number="editForm.qty"
                               required
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 font-mono text-slate-900 focus:outline-none focus:border-blue-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nomor Batch / Lot</label>
                        <input type="text"
                               x-model="editForm.lot"
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 font-mono text-slate-900 focus:outline-none focus:border-blue-600">
                    </div>
                </div>

                <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-200">
                    <button type="button"
                            @click="editItemModal = false"
                            class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-semibold">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-bold shadow-sm">
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================= -->
    <!-- MODAL 3: FORM BUAT INBOUND PO BARU (CRUD)                     -->
    <!-- ============================================================= -->
    <div x-show="addPOModal"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="display: none;">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-200 relative"
             @click.outside="addPOModal = false">
            
            <button type="button"
                    @click="addPOModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 w-8 h-8 rounded-full flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>

            <h3 class="text-base font-bold text-slate-900 mb-1">Buat Faktur Inbound (PO Masuk) Baru</h3>
            <p class="text-xs text-slate-500 mb-4">Daftarkan rencana kedatangan barang dari pemasok.</p>

            <form @submit.prevent="saveNewPO()" class="space-y-3 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor PO / Surat Pembelian</label>
                    <input type="text"
                           x-model="poForm.number"
                           required
                           class="w-full px-3 py-2 rounded-lg border border-slate-300 font-mono text-slate-900 focus:outline-none focus:border-blue-600">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Vendor / Supplier</label>
                    <input type="text"
                           x-model="poForm.vendor"
                           required
                           placeholder="Contoh: PT Sumber Jaya Sentosa"
                           class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 focus:outline-none focus:border-blue-600">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Pilih Item Barang</label>
                    <select x-model="poForm.selectedSku"
                            @change="updatePOItemDetails()"
                            class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                        <template x-for="item in inventoryList" :key="item.sku">
                            <option :value="item.sku" x-text="item.name + ' (' + item.sku + ')'"></option>
                        </template>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jumlah Masuk</label>
                        <input type="number"
                               min="1"
                               x-model.number="poForm.qty"
                               required
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 font-mono text-slate-900 focus:outline-none focus:border-blue-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Rak Tujuan Putaway</label>
                        <select x-model="poForm.targetRack"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                            <template x-for="r in racks" :key="r.code">
                                <option :value="r.code" x-text="r.code + ' (Zona ' + r.zone + ')'"></option>
                            </template>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor Polisi Truk / Ekspedisi</label>
                    <input type="text"
                           x-model="poForm.truckPlate"
                           placeholder="Contoh: B 9912 SXZ (Truk Box)"
                           class="w-full px-3 py-2 rounded-lg border border-slate-300 font-mono text-slate-900 focus:outline-none focus:border-blue-600">
                </div>

                <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-200">
                    <button type="button"
                            @click="addPOModal = false"
                            class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-semibold">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-bold shadow-sm">
                        Simpan PO Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================= -->
    <!-- MODAL 4: FORM BUAT OUTBOUND ORDER / SURAT JALAN BARU (CRUD)   -->
    <!-- ============================================================= -->
    <div x-show="addOrderModal"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="display: none;">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-200 relative"
             @click.outside="addOrderModal = false">
            
            <button type="button"
                    @click="addOrderModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 w-8 h-8 rounded-full flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>

            <h3 class="text-base font-bold text-slate-900 mb-1">Buat Surat Jalan (DO) Pengiriman Baru</h3>
            <p class="text-xs text-slate-500 mb-4">Siapkan pesanan pengeluaran barang untuk customer.</p>

            <form @submit.prevent="saveNewOrder()" class="space-y-3 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor Surat Jalan (DO)</label>
                    <input type="text"
                           x-model="orderForm.number"
                           required
                           class="w-full px-3 py-2 rounded-lg border border-slate-300 font-mono text-slate-900 focus:outline-none focus:border-blue-600">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Customer / Penerima</label>
                    <input type="text"
                           x-model="orderForm.customer"
                           required
                           placeholder="Contoh: PT Datacenter Nusantara"
                           class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 focus:outline-none focus:border-blue-600">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Pilih Barang yang Dikeluarkan</label>
                    <select x-model="orderForm.selectedSku"
                            class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                        <template x-for="item in inventoryList" :key="item.sku">
                            <option :value="item.sku" x-text="item.name + ' (Sisa: ' + item.qty + ' di ' + item.rack + ')'"></option>
                        </template>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jumlah Pengeluaran</label>
                        <input type="number"
                               min="1"
                               x-model.number="orderForm.qty"
                               required
                               class="w-full px-3 py-2 rounded-lg border border-slate-300 font-mono text-slate-900 focus:outline-none focus:border-blue-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Kurir / Ekspedisi</label>
                        <select x-model="orderForm.courier"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                            <option value="Armada Internal RSI">Armada Internal RSI</option>
                            <option value="JNE Trucking Cargo">JNE Trucking Cargo</option>
                            <option value="SiCepat B2B Cargo">SiCepat B2B Cargo</option>
                            <option value="Ambil Sendiri (Pickup)">Ambil Sendiri (Pickup)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Prioritas Pengiriman</label>
                    <select x-model="orderForm.priority"
                            class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                        <option value="Normal">Normal</option>
                        <option value="High">Tinggi (High Priority)</option>
                        <option value="Urgent">Sangat Mendesak (Urgent Same-Day)</option>
                    </select>
                </div>

                <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-200">
                    <button type="button"
                            @click="addOrderModal = false"
                            class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 text-slate-700 font-semibold">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-bold shadow-sm">
                        Simpan Surat Jalan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================= -->
    <!-- MODAL 5: DETAIL RAK INSPECTION                                -->
    <!-- ============================================================= -->
    <div x-show="inspectedRackModal"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="display: none;">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-200 relative"
             @click.outside="inspectedRackModal = false">
            
            <button type="button"
                    @click="inspectedRackModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 w-8 h-8 rounded-full flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>

            <template x-if="activeInspectedRack">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-base font-mono font-bold">
                            <span x-text="activeInspectedRack.code"></span>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold text-slate-500" x-text="'Zona ' + activeInspectedRack.zone + ' • ' + activeInspectedRack.zoneName"></span>
                            <h3 class="text-base font-bold text-slate-900">Rincian Lokasi Rak</h3>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="grid grid-cols-2 gap-2 p-3 bg-slate-50 rounded-lg border border-slate-200">
                            <div>
                                <span class="text-slate-500 block">Kapasitas Maksimal:</span>
                                <strong class="text-slate-800 font-mono text-sm" x-text="activeInspectedRack.maxCapacity + ' ' + activeInspectedRack.unit"></strong>
                            </div>
                            <div>
                                <span class="text-slate-500 block">Keterisian Saat Ini:</span>
                                <strong class="text-blue-700 font-mono text-sm" x-text="activeInspectedRack.currentQty + ' ' + activeInspectedRack.unit + ' (' + getRackUsage(activeInspectedRack) + '%)'"></strong>
                            </div>
                        </div>

                        <div>
                            <span class="text-slate-600 font-semibold block mb-1.5">Barang yang Tersimpan:</span>
                            <div class="space-y-1.5 max-h-40 overflow-y-auto pr-1">
                                <template x-for="item in activeInspectedRack.items" :key="item.sku">
                                    <div class="p-2.5 rounded-lg border border-slate-200 bg-white flex items-center justify-between">
                                        <div>
                                            <div class="font-bold text-slate-800" x-text="item.name"></div>
                                            <div class="text-[10px] text-slate-500 font-mono" x-text="'SKU: ' + item.sku + ' • Lot: ' + item.batch"></div>
                                        </div>
                                        <div class="font-mono font-bold text-blue-700" x-text="item.qty + ' ' + activeInspectedRack.unit"></div>
                                    </div>
                                </template>
                                <div x-show="!activeInspectedRack.items || activeInspectedRack.items.length === 0" class="text-slate-400 py-3 text-center">
                                    Rak ini sedang kosong dan siap dialokasikan.
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 flex justify-end">
                            <button type="button"
                                    @click="inspectedRackModal = false"
                                    class="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- ============================================================= -->
    <!-- MODAL 6: SURAT JALAN PREVIEW                                  -->
    <!-- ============================================================= -->
    <div x-show="dispatchSlipModal"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="display: none;">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200 relative"
             @click.outside="dispatchSlipModal = false">
            
            <button type="button"
                    @click="dispatchSlipModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 w-8 h-8 rounded-full flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>

            <template x-if="lastDispatchedOrder">
                <div>
                    <div class="border-b border-slate-200 pb-3 mb-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-base font-bold text-slate-900">SURAT JALAN PENGIRIMAN</h3>
                                <p class="text-xs text-slate-500 font-mono" x-text="'Nomor: ' + lastDispatchedOrder.number"></p>
                            </div>
                            <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-xs">TERKIRIM (DISPATCHED)</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs mb-3">
                        <div>
                            <span class="text-slate-500 block">Customer:</span>
                            <strong class="text-slate-800" x-text="lastDispatchedOrder.customer"></strong>
                        </div>
                        <div>
                            <span class="text-slate-500 block">Ekspedisi:</span>
                            <strong class="text-slate-800" x-text="lastDispatchedOrder.courier"></strong>
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded-lg overflow-hidden mb-3">
                        <table class="w-full text-xs text-left">
                            <thead class="bg-slate-50 text-slate-600 font-semibold">
                                <tr>
                                    <th class="p-2.5">Item Barang</th>
                                    <th class="p-2.5">Dari Rak</th>
                                    <th class="p-2.5 text-right">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <template x-for="item in lastDispatchedOrder.items" :key="item.sku">
                                    <tr>
                                        <td class="p-2.5 font-medium text-slate-800" x-text="item.name"></td>
                                        <td class="p-2.5 font-mono text-slate-500" x-text="item.fromRack"></td>
                                        <td class="p-2.5 font-mono text-right font-bold text-slate-900" x-text="item.qty + ' ' + item.unit"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-lg text-xs text-emerald-800 flex items-center gap-2 mb-4">
                        <i class="fas fa-check-circle text-emerald-600"></i>
                        <span>Stok berhasil dipotong dari rak secara otomatis dan transaksi tercatat di riwayat mutasi.</span>
                    </div>

                    <div class="flex justify-end">
                        <button type="button"
                                @click="dispatchSlipModal = false"
                                class="px-5 py-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-sm">
                            Tutup Surat Jalan
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- ============================================================= -->
    <!-- MODAL 7: KONSULTASI / PENAWARAN WMS FORM                      -->
    <!-- ============================================================= -->
    <div x-show="leadModal"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="display: none;">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200 relative"
             @click.outside="leadModal = false">
            
            <button type="button"
                    @click="leadModal = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-700 w-8 h-8 rounded-full flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>

            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-lg">
                    <i class="fas fa-handshake"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900">Konsultasi & Penawaran WMS RSI</h3>
                    <p class="text-xs text-slate-500">Kirim detail kebutuhan gudang Anda kepada tim teknis RSI</p>
                </div>
            </div>

            <form @submit.prevent="submitLeadForm()" class="space-y-3 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama PIC / Penanggung Jawab</label>
                    <input type="text"
                           x-model="leadForm.name"
                           required
                           placeholder="Contoh: Budi Santoso"
                           class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 focus:outline-none focus:border-blue-600">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Perusahaan / Gudang</label>
                    <input type="text"
                           x-model="leadForm.company"
                           required
                           placeholder="Contoh: PT Solusi Logistik Mandiri"
                           class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 focus:outline-none focus:border-blue-600">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Jenis Gudang / Industri</label>
                        <select x-model="leadForm.industry"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                            <option value="FMCG & Ritel">FMCG & Ritel</option>
                            <option value="Elektronik & IT">Elektronik & IT</option>
                            <option value="Manufaktur & Sparepart">Manufaktur & Sparepart</option>
                            <option value="Logistik 3PL">Logistik 3PL</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Estimasi Volume SKU</label>
                        <select x-model="leadForm.skuCount"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 bg-white focus:outline-none focus:border-blue-600">
                            <option value="< 500 SKU">< 500 SKU</option>
                            <option value="500 - 2.000 SKU">500 - 2.000 SKU</option>
                            <option value="2.000 - 10.000 SKU">2.000 - 10.000 SKU</option>
                            <option value="> 10.000 SKU">> 10.000 SKU</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Catatan Kustomisasi (Opsional)</label>
                    <textarea x-model="leadForm.notes"
                              rows="2"
                              placeholder="Misal: Butuh scanner barcode wireless Zebra, integrasi SAP / Accurate..."
                              class="w-full px-3 py-2 rounded-lg border border-slate-300 text-slate-900 focus:outline-none focus:border-blue-600"></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold flex items-center justify-center gap-2 shadow-sm transition-colors">
                        <i class="fab fa-whatsapp text-sm"></i>
                        <span>Kirim via WhatsApp Resmi RSI</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div x-show="toast.visible"
         x-transition
         class="fixed bottom-6 right-6 z-50 max-w-sm p-4 rounded-xl bg-slate-900 text-white shadow-xl flex items-center gap-3"
         style="display: none;">
        <i class="fas" :class="toast.type === 'success' ? 'fa-check text-emerald-400' : 'fa-info text-blue-400'"></i>
        <div class="text-xs" x-text="toast.message"></div>
    </div>

    <!-- ============================================================= -->
    <!-- ALPINE JS REACTIVE STORE & CRUD LOGIC                         -->
    <!-- ============================================================= -->
    <script>
        function wmsApp() {
            return {
                activeTab: 'overview',
                sidebarOpen: false,
                searchQuery: '',
                selectedCategoryFilter: 'ALL',

                // Modals
                addItemModal: false,
                editItemModal: false,
                addPOModal: false,
                addOrderModal: false,
                inspectedRackModal: false,
                activeInspectedRack: null,
                dispatchSlipModal: false,
                lastDispatchedOrder: null,
                leadModal: false,

                // Forms
                itemForm: {
                    sku: '',
                    name: '',
                    category: 'IT & Elektronik',
                    rack: 'B-01',
                    qty: 10,
                    unit: 'Unit',
                    lot: 'LOT-2026-09A'
                },

                editForm: {
                    sku: '',
                    name: '',
                    category: '',
                    rack: '',
                    qty: 0,
                    lot: ''
                },

                poForm: {
                    number: '',
                    vendor: '',
                    selectedSku: '',
                    itemName: '',
                    qty: 10,
                    unit: 'Unit',
                    targetRack: 'B-01',
                    truckPlate: 'B 9182 TRL'
                },

                orderForm: {
                    number: '',
                    customer: '',
                    selectedSku: '',
                    qty: 5,
                    courier: 'Armada Internal RSI',
                    priority: 'Normal'
                },

                leadForm: {
                    name: '',
                    company: '',
                    industry: 'FMCG & Ritel',
                    skuCount: '500 - 2.000 SKU',
                    notes: ''
                },

                // Toast
                toast: {
                    visible: false,
                    message: '',
                    type: 'success',
                    timer: null
                },

                // Datasets
                racks: [],
                inboundList: [],
                outboundList: [],
                auditLogs: [],

                initApp() {
                    const saved = localStorage.getItem('rsi_wms_standard_demo_v2');
                    if (saved) {
                        try {
                            const parsed = JSON.parse(saved);
                            this.racks = parsed.racks;
                            this.inboundList = parsed.inboundList;
                            this.outboundList = parsed.outboundList;
                            this.auditLogs = parsed.auditLogs;
                        } catch(e) {
                            this.loadDefaultPresets();
                        }
                    } else {
                        this.loadDefaultPresets();
                    }
                },

                saveToStorage() {
                    localStorage.setItem('rsi_wms_standard_demo_v2', JSON.stringify({
                        racks: this.racks,
                        inboundList: this.inboundList,
                        outboundList: this.outboundList,
                        auditLogs: this.auditLogs
                    }));
                },

                loadDefaultPresets() {
                    // 24 Standard Racks across 3 Zones
                    this.racks = [
                        // Zone A: FMCG & Ritel
                        { id: 1, code: 'A-01', zone: 'A', zoneName: 'FMCG & Ritel', maxCapacity: 100, currentQty: 75, unit: 'Dus', primaryItemName: 'Sabun Cair Industri 5L', items: [{ sku: 'FMCG-SBN-01', name: 'Sabun Cair Industri 5L', qty: 75, batch: 'B26-0811' }] },
                        { id: 2, code: 'A-02', zone: 'A', zoneName: 'FMCG & Ritel', maxCapacity: 120, currentQty: 110, unit: 'Dus', primaryItemName: 'Minyak Goreng Sawit 2L Karton', items: [{ sku: 'FMCG-MYK-02', name: 'Minyak Goreng Sawit 2L Karton', qty: 110, batch: 'B26-0902' }] },
                        { id: 3, code: 'A-03', zone: 'A', zoneName: 'FMCG & Ritel', maxCapacity: 100, currentQty: 60, unit: 'Dus', primaryItemName: 'Susu UHT Coklat 250ml', items: [{ sku: 'FMCG-SSU-03', name: 'Susu UHT Coklat 250ml', qty: 60, batch: 'B26-0744' }] },
                        { id: 4, code: 'A-04', zone: 'A', zoneName: 'FMCG & Ritel', maxCapacity: 80, currentQty: 40, unit: 'Box', primaryItemName: 'Kertas Tissue Pack 250s', items: [{ sku: 'FMCG-TIS-04', name: 'Kertas Tissue Pack 250s', qty: 40, batch: 'B26-0915' }] },
                        { id: 5, code: 'A-05', zone: 'A', zoneName: 'FMCG & Ritel', maxCapacity: 100, currentQty: 90, unit: 'Dus', primaryItemName: 'Deterjen Bubuk 1kg x 12', items: [{ sku: 'FMCG-DET-05', name: 'Deterjen Bubuk 1kg x 12', qty: 90, batch: 'B26-0888' }] },
                        { id: 6, code: 'A-06', zone: 'A', zoneName: 'FMCG & Ritel', maxCapacity: 100, currentQty: 30, unit: 'Dus', primaryItemName: 'Biskuit Kaleng Assorted', items: [{ sku: 'FMCG-BSK-06', name: 'Biskuit Kaleng Assorted', qty: 30, batch: 'B26-0701' }] },
                        { id: 7, code: 'A-07', zone: 'A', zoneName: 'FMCG & Ritel', maxCapacity: 100, currentQty: 10, unit: 'Dus', primaryItemName: 'Kopi Bubuk Robusta 200g', items: [{ sku: 'FMCG-KPI-07', name: 'Kopi Bubuk Robusta 200g', qty: 10, batch: 'B26-0612' }] },
                        { id: 8, code: 'A-08', zone: 'A', zoneName: 'FMCG & Ritel', maxCapacity: 100, currentQty: 0, unit: 'Dus', primaryItemName: '', items: [] },

                        // Zone B: IT & Elektronik
                        { id: 9, code: 'B-01', zone: 'B', zoneName: 'IT & Elektronik', maxCapacity: 50, currentQty: 32, unit: 'Unit', primaryItemName: 'Cisco Catalyst 9200 Switch', items: [{ sku: 'IT-CS-9200', name: 'Cisco Catalyst 9200 Switch', qty: 32, batch: 'LOT-CS-44' }] },
                        { id: 10, code: 'B-02', zone: 'B', zoneName: 'IT & Elektronik', maxCapacity: 80, currentQty: 20, unit: 'Roll', primaryItemName: 'Kabel UTP Belden Cat6 305m', items: [{ sku: 'IT-BLD-CAT6', name: 'Kabel UTP Belden Cat6 305m', qty: 20, batch: 'LOT-UTP-12' }] },
                        { id: 11, code: 'B-03', zone: 'B', zoneName: 'IT & Elektronik', maxCapacity: 40, currentQty: 15, unit: 'Unit', primaryItemName: 'Server 2U Dell PowerEdge', items: [{ sku: 'IT-SRV-R740', name: 'Server 2U Dell PowerEdge', qty: 15, batch: 'LOT-DLL-99' }] },
                        { id: 12, code: 'B-04', zone: 'B', zoneName: 'IT & Elektronik', maxCapacity: 150, currentQty: 125, unit: 'Pcs', primaryItemName: 'Fiber Optic Patch Cord SC-LC', items: [{ sku: 'IT-FBR-SCLC', name: 'Fiber Optic Patch Cord SC-LC', qty: 125, batch: 'LOT-FBR-08' }] },
                        { id: 13, code: 'B-05', zone: 'B', zoneName: 'IT & Elektronik', maxCapacity: 60, currentQty: 48, unit: 'Unit', primaryItemName: 'Mikrotik Cloud Router CCR2004', items: [{ sku: 'IT-MKT-2004', name: 'Mikrotik Cloud Router CCR2004', qty: 48, batch: 'LOT-MKT-33' }] },
                        { id: 14, code: 'B-06', zone: 'B', zoneName: 'IT & Elektronik', maxCapacity: 70, currentQty: 65, unit: 'Unit', primaryItemName: 'Access Point Aruba Wi-Fi 6', items: [{ sku: 'IT-ARB-AP505', name: 'Access Point Aruba Wi-Fi 6', qty: 65, batch: 'LOT-ARB-55' }] },
                        { id: 15, code: 'B-07', zone: 'B', zoneName: 'IT & Elektronik', maxCapacity: 50, currentQty: 12, unit: 'Unit', primaryItemName: 'UPS APC Smart 1500VA', items: [{ sku: 'IT-APC-1500', name: 'UPS APC Smart 1500VA', qty: 12, batch: 'LOT-APC-21' }] },
                        { id: 16, code: 'B-08', zone: 'B', zoneName: 'IT & Elektronik', maxCapacity: 100, currentQty: 0, unit: 'Unit', primaryItemName: '', items: [] },

                        // Zone C: Sparepart Industri
                        { id: 17, code: 'C-01', zone: 'C', zoneName: 'Sparepart Industri', maxCapacity: 150, currentQty: 120, unit: 'Box', primaryItemName: 'Bearing SKF 6205-2RSH', items: [{ sku: 'SP-SKF-6205', name: 'Bearing SKF 6205-2RSH', qty: 120, batch: 'LOT-SKF-78' }] },
                        { id: 18, code: 'C-02', zone: 'C', zoneName: 'Sparepart Industri', maxCapacity: 100, currentQty: 85, unit: 'Pcs', primaryItemName: 'V-Belt Bando B-52 Industrial', items: [{ sku: 'SP-BND-B52', name: 'V-Belt Bando B-52 Industrial', qty: 85, batch: 'LOT-BND-11' }] },
                        { id: 19, code: 'C-03', zone: 'C', zoneName: 'Sparepart Industri', maxCapacity: 80, currentQty: 50, unit: 'Set', primaryItemName: 'Hydraulic Seal Kit Cyl 50mm', items: [{ sku: 'SP-HYD-50MM', name: 'Hydraulic Seal Kit Cyl 50mm', qty: 50, batch: 'LOT-HYD-90' }] },
                        { id: 20, code: 'C-04', zone: 'C', zoneName: 'Sparepart Industri', maxCapacity: 60, currentQty: 55, unit: 'Pcs', primaryItemName: 'Pneumatic Valve SMC 24V', items: [{ sku: 'SP-SMC-V24', name: 'Pneumatic Valve SMC 24V', qty: 55, batch: 'LOT-SMC-45' }] },
                        { id: 21, code: 'C-05', zone: 'C', zoneName: 'Sparepart Industri', maxCapacity: 100, currentQty: 30, unit: 'Pcs', primaryItemName: 'Filter Udara Kompresor 10HP', items: [{ sku: 'SP-FLT-10HP', name: 'Filter Udara Kompresor 10HP', qty: 30, batch: 'LOT-FLT-19' }] },
                        { id: 22, code: 'C-06', zone: 'C', zoneName: 'Sparepart Industri', maxCapacity: 80, currentQty: 78, unit: 'Box', primaryItemName: 'Baut Hex Baja M12x50 (50pcs)', items: [{ sku: 'SP-BT-M1250', name: 'Baut Hex Baja M12x50 (50pcs)', qty: 78, batch: 'LOT-BAU-03' }] },
                        { id: 23, code: 'C-07', zone: 'C', zoneName: 'Sparepart Industri', maxCapacity: 90, currentQty: 15, unit: 'Drum', primaryItemName: 'Pelumas Gearbox VG 220 20L', items: [{ sku: 'SP-OIL-VG220', name: 'Pelumas Gearbox VG 220 20L', qty: 15, batch: 'LOT-OIL-87' }] },
                        { id: 24, code: 'C-08', zone: 'C', zoneName: 'Sparepart Industri', maxCapacity: 100, currentQty: 0, unit: 'Box', primaryItemName: '', items: [] }
                    ];

                    this.inboundList = [
                        {
                            id: 1,
                            number: 'PO-2026-0891',
                            vendor: 'PT Tri Dinamika Solusindo',
                            itemName: 'Cisco Catalyst 9200 Switch',
                            sku: 'IT-CS-9200',
                            qty: 15,
                            unit: 'Unit',
                            targetRack: 'B-01',
                            batchNumber: 'LOT-CS-45-IN',
                            truckPlate: 'B 9482 SXZ',
                            status: 'Siap di Dermaga'
                        },
                        {
                            id: 2,
                            number: 'PO-2026-0892',
                            vendor: 'CV Berkah Sumber Rejeki',
                            itemName: 'Sabun Cair Industri 5L',
                            sku: 'FMCG-SBN-01',
                            qty: 20,
                            unit: 'Dus',
                            targetRack: 'A-01',
                            batchNumber: 'B26-0922',
                            truckPlate: 'B 1120 TRL',
                            status: 'Menunggu Bongkar'
                        },
                        {
                            id: 3,
                            number: 'PO-2026-0893',
                            vendor: 'PT Jaya Teknik Presisi',
                            itemName: 'Bearing SKF 6205-2RSH',
                            sku: 'SP-SKF-6205',
                            qty: 25,
                            unit: 'Box',
                            targetRack: 'C-01',
                            batchNumber: 'LOT-SKF-80-IN',
                            truckPlate: 'D 8812 AB',
                            status: 'Menunggu Bongkar'
                        }
                    ];

                    this.outboundList = [
                        {
                            id: 1,
                            number: 'DO-2026-0412',
                            customer: 'PT Nusa Datacenter Indonesia',
                            courier: 'Armada Internal RSI',
                            priority: 'High',
                            items: [
                                { name: 'Cisco Catalyst 9200 Switch', sku: 'IT-CS-9200', fromRack: 'B-01', qty: 4, unit: 'Unit' },
                                { name: 'Fiber Optic Patch Cord SC-LC', sku: 'IT-FBR-SCLC', fromRack: 'B-04', qty: 15, unit: 'Pcs' }
                            ]
                        },
                        {
                            id: 2,
                            number: 'DO-2026-0413',
                            customer: 'Supermarket Megah Sentosa',
                            courier: 'JNE Trucking Cargo',
                            priority: 'Normal',
                            items: [
                                { name: 'Minyak Goreng Sawit 2L Karton', sku: 'FMCG-MYK-02', fromRack: 'A-02', qty: 10, unit: 'Dus' },
                                { name: 'Sabun Cair Industri 5L', sku: 'FMCG-SBN-01', fromRack: 'A-01', qty: 5, unit: 'Dus' }
                            ]
                        },
                        {
                            id: 3,
                            number: 'DO-2026-0414',
                            customer: 'Pabrik Tekstil Makmur Sejati',
                            courier: 'SiCepat B2B Cargo',
                            priority: 'Urgent',
                            items: [
                                { name: 'V-Belt Bando B-52 Industrial', sku: 'SP-BND-B52', fromRack: 'C-02', qty: 12, unit: 'Pcs' },
                                { name: 'Bearing SKF 6205-2RSH', sku: 'SP-SKF-6205', fromRack: 'C-01', qty: 10, unit: 'Box' }
                            ]
                        }
                    ];

                    this.auditLogs = [
                        { id: 1, type: 'INBOUND', time: '10:45', message: 'Penerimaan PO-2026-0889 selesai dialokasikan ke Rak B-03', user: 'Operator Inbound', reference: 'PO-2026-0889' },
                        { id: 2, type: 'OUTBOUND', time: '10:20', message: 'Surat Jalan DO-2026-0410 dikirim ke PT Trans Armada', user: 'Supervisor Gudang', reference: 'DO-2026-0410' },
                        { id: 3, type: 'TAMBAH', time: '09:50', message: 'Barang baru "Mikrotik Cloud Router CCR2004" ditambahkan ke Rak B-05', user: 'Admin Gudang', reference: 'IT-MKT-2004' }
                    ];

                    this.saveToStorage();
                },

                resetDemoData() {
                    localStorage.removeItem('rsi_wms_standard_demo_v2');
                    this.loadDefaultPresets();
                    window.playSuccessSound();
                    this.showToast('Data demo WMS telah berhasil di-reset ke kondisi standar!', 'success');
                },

                // Getters
                get inventoryList() {
                    let list = [];
                    this.racks.forEach(r => {
                        (r.items || []).forEach(item => {
                            list.push({
                                sku: item.sku,
                                name: item.name,
                                category: r.zoneName,
                                rack: r.code,
                                qty: item.qty,
                                unit: r.unit,
                                lot: item.batch,
                                barcode: '899' + Math.abs(item.sku.split('').reduce((a,b)=>(((a<<5)-a)+b.charCodeAt(0))|0, 0)).toString().padEnd(10, '0').slice(0, 10)
                            });
                        });
                    });
                    return list;
                },

                get filteredInventory() {
                    let list = this.inventoryList;
                    if (this.selectedCategoryFilter !== 'ALL') {
                        list = list.filter(i => i.category === this.selectedCategoryFilter);
                    }
                    const q = this.searchQuery.toLowerCase().trim();
                    if (!q) return list;
                    return list.filter(i => i.name.toLowerCase().includes(q) || i.sku.toLowerCase().includes(q) || i.rack.toLowerCase().includes(q));
                },

                get totalPhysicalStock() {
                    return this.racks.reduce((acc, r) => acc + r.currentQty, 0);
                },

                get occupancyRate() {
                    const totalMax = this.racks.reduce((acc, r) => acc + r.maxCapacity, 0);
                    const totalUsed = this.racks.reduce((acc, r) => acc + r.currentQty, 0);
                    return totalMax > 0 ? Math.round((totalUsed / totalMax) * 100) : 0;
                },

                getRackUsage(rack) {
                    return Math.round((rack.currentQty / rack.maxCapacity) * 100);
                },

                // =========================================================
                // CRUD 1: MASTER BARANG (TAMBAH, EDIT, HAPUS)
                // =========================================================
                openAddItemModal() {
                    this.itemForm = {
                        sku: 'SKU-' + Math.floor(1000 + Math.random() * 9000),
                        name: '',
                        category: 'IT & Elektronik',
                        rack: 'B-01',
                        qty: 20,
                        unit: 'Unit',
                        lot: 'LOT-' + new Date().getFullYear() + '-' + Math.floor(10 + Math.random() * 90)
                    };
                    this.addItemModal = true;
                },

                saveNewItem() {
                    const rack = this.racks.find(r => r.code === this.itemForm.rack);
                    if (!rack) {
                        alert('Lokasi rak tidak valid');
                        return;
                    }

                    if (!rack.items) rack.items = [];
                    rack.items.push({
                        sku: this.itemForm.sku.trim(),
                        name: this.itemForm.name.trim(),
                        qty: this.itemForm.qty,
                        batch: this.itemForm.lot.trim()
                    });
                    rack.currentQty += this.itemForm.qty;
                    rack.primaryItemName = this.itemForm.name;

                    this.auditLogs.unshift({
                        id: Date.now(),
                        type: 'TAMBAH',
                        time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                        message: `Barang baru "${this.itemForm.name}" (${this.itemForm.qty} ${this.itemForm.unit}) ditambahkan ke Rak ${this.itemForm.rack}`,
                        user: 'Admin Gudang',
                        reference: this.itemForm.sku
                    });

                    this.addItemModal = false;
                    this.saveToStorage();
                    window.playSuccessSound();
                    this.showToast(`Barang "${this.itemForm.name}" berhasil ditambahkan ke Rak ${this.itemForm.rack}!`, 'success');
                },

                openEditItemModal(item) {
                    this.editForm = {
                        sku: item.sku,
                        originalRack: item.rack,
                        name: item.name,
                        category: item.category,
                        rack: item.rack,
                        qty: item.qty,
                        lot: item.lot
                    };
                    this.editItemModal = true;
                },

                saveEditedItem() {
                    // Remove from original rack
                    const oldRack = this.racks.find(r => r.code === this.editForm.originalRack);
                    if (oldRack && oldRack.items) {
                        const idx = oldRack.items.findIndex(i => i.sku === this.editForm.sku);
                        if (idx !== -1) {
                            oldRack.currentQty -= oldRack.items[idx].qty;
                            oldRack.items.splice(idx, 1);
                        }
                    }

                    // Add to new/target rack
                    const newRack = this.racks.find(r => r.code === this.editForm.rack);
                    if (newRack) {
                        if (!newRack.items) newRack.items = [];
                        newRack.items.push({
                            sku: this.editForm.sku,
                            name: this.editForm.name,
                            qty: this.editForm.qty,
                            batch: this.editForm.lot
                        });
                        newRack.currentQty += this.editForm.qty;
                        newRack.primaryItemName = this.editForm.name;
                    }

                    this.auditLogs.unshift({
                        id: Date.now(),
                        type: 'EDIT',
                        time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                        message: `Data barang "${this.editForm.name}" (${this.editForm.sku}) diperbarui. Stok: ${this.editForm.qty} di Rak ${this.editForm.rack}`,
                        user: 'Admin Gudang',
                        reference: this.editForm.sku
                    });

                    this.editItemModal = false;
                    this.saveToStorage();
                    window.playSuccessSound();
                    this.showToast(`Data barang ${this.editForm.name} berhasil diperbarui!`, 'success');
                },

                confirmDeleteItem(item) {
                    if (confirm(`Apakah Anda yakin ingin menghapus barang "${item.name}" (${item.sku}) dari gudang?`)) {
                        const rack = this.racks.find(r => r.code === item.rack);
                        if (rack && rack.items) {
                            const idx = rack.items.findIndex(i => i.sku === item.sku);
                            if (idx !== -1) {
                                rack.currentQty = Math.max(0, rack.currentQty - rack.items[idx].qty);
                                rack.items.splice(idx, 1);
                                if (rack.items.length === 0) rack.primaryItemName = '';
                            }
                        }

                        this.auditLogs.unshift({
                            id: Date.now(),
                            type: 'HAPUS',
                            time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                            message: `Barang "${item.name}" (${item.sku}) dihapus dari Rak ${item.rack}`,
                            user: 'Admin Gudang',
                            reference: item.sku
                        });

                        this.saveToStorage();
                        this.showToast(`Barang ${item.name} berhasil dihapus.`, 'success');
                    }
                },

                // =========================================================
                // CRUD 2: INBOUND PO (TAMBAH, TERIMA, HAPUS)
                // =========================================================
                openAddPOModal() {
                    const firstItem = this.inventoryList[0] || { sku: 'IT-CS-9200', name: 'Cisco Catalyst 9200 Switch' };
                    this.poForm = {
                        number: 'PO-2026-0' + Math.floor(900 + Math.random() * 90),
                        vendor: '',
                        selectedSku: firstItem.sku,
                        itemName: firstItem.name,
                        qty: 15,
                        unit: 'Unit',
                        targetRack: 'B-01',
                        truckPlate: 'B ' + Math.floor(1000 + Math.random() * 8999) + ' SXZ'
                    };
                    this.addPOModal = true;
                },

                updatePOItemDetails() {
                    const found = this.inventoryList.find(i => i.sku === this.poForm.selectedSku);
                    if (found) {
                        this.poForm.itemName = found.name;
                        this.poForm.unit = found.unit;
                        this.poForm.targetRack = found.rack;
                    }
                },

                saveNewPO() {
                    this.inboundList.unshift({
                        id: Date.now(),
                        number: this.poForm.number.trim(),
                        vendor: this.poForm.vendor.trim(),
                        itemName: this.poForm.itemName,
                        sku: this.poForm.selectedSku,
                        qty: this.poForm.qty,
                        unit: this.poForm.unit,
                        targetRack: this.poForm.targetRack,
                        batchNumber: 'LOT-' + new Date().getFullYear() + '-IN',
                        truckPlate: this.poForm.truckPlate,
                        status: 'Siap di Dermaga'
                    });

                    this.auditLogs.unshift({
                        id: Date.now(),
                        type: 'INBOUND',
                        time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                        message: `Rencana Inbound ${this.poForm.number} dibuat dari supplier ${this.poForm.vendor}`,
                        user: 'Staff Pembelian',
                        reference: this.poForm.number
                    });

                    this.addPOModal = false;
                    this.saveToStorage();
                    window.playSuccessSound();
                    this.showToast(`Inbound PO ${this.poForm.number} berhasil didaftarkan!`, 'success');
                },

                processReceivePO(po) {
                    window.playBeepSound();
                    const rack = this.racks.find(r => r.code === po.targetRack);
                    if (rack) {
                        rack.currentQty += po.qty;
                        if (!rack.items) rack.items = [];
                        const existing = rack.items.find(i => i.sku === po.sku);
                        if (existing) {
                            existing.qty += po.qty;
                        } else {
                            rack.items.push({
                                sku: po.sku,
                                name: po.itemName,
                                qty: po.qty,
                                batch: po.batchNumber
                            });
                        }
                        rack.primaryItemName = po.itemName;
                    }

                    this.auditLogs.unshift({
                        id: Date.now(),
                        type: 'INBOUND',
                        time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                        message: `Penerimaan ${po.number} (${po.qty} ${po.unit} ${po.itemName}) selesai ditempatkan ke Rak ${po.targetRack}`,
                        user: 'Operator Inbound',
                        reference: po.number
                    });

                    this.inboundList = this.inboundList.filter(p => p.id !== po.id);
                    this.saveToStorage();
                    window.playSuccessSound();
                    this.showToast(`Barang dari ${po.number} berhasil diterima dan dialokasikan ke Rak ${po.targetRack}!`, 'success');
                },

                deletePO(po) {
                    if (confirm(`Batalkan PO Masuk ${po.number} dari ${po.vendor}?`)) {
                        this.inboundList = this.inboundList.filter(p => p.id !== po.id);
                        this.auditLogs.unshift({
                            id: Date.now(),
                            type: 'HAPUS',
                            time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                            message: `Inbound PO ${po.number} dibatalkan`,
                            user: 'Supervisor Inbound',
                            reference: po.number
                        });
                        this.saveToStorage();
                        this.showToast(`PO ${po.number} telah dibatalkan.`, 'success');
                    }
                },

                // =========================================================
                // CRUD 3: OUTBOUND DO (TAMBAH, PICKING, HAPUS)
                // =========================================================
                openAddOrderModal() {
                    const firstItem = this.inventoryList[0] || { sku: 'IT-CS-9200', name: 'Cisco Catalyst 9200 Switch', rack: 'B-01', unit: 'Unit' };
                    this.orderForm = {
                        number: 'DO-2026-0' + Math.floor(420 + Math.random() * 80),
                        customer: '',
                        selectedSku: firstItem.sku,
                        qty: 5,
                        courier: 'Armada Internal RSI',
                        priority: 'Normal'
                    };
                    this.addOrderModal = true;
                },

                saveNewOrder() {
                    const item = this.inventoryList.find(i => i.sku === this.orderForm.selectedSku);
                    if (!item) {
                        alert('Item tidak valid');
                        return;
                    }

                    this.outboundList.unshift({
                        id: Date.now(),
                        number: this.orderForm.number.trim(),
                        customer: this.orderForm.customer.trim(),
                        courier: this.orderForm.courier,
                        priority: this.orderForm.priority,
                        items: [
                            {
                                name: item.name,
                                sku: item.sku,
                                fromRack: item.rack,
                                qty: this.orderForm.qty,
                                unit: item.unit
                            }
                        ]
                    });

                    this.auditLogs.unshift({
                        id: Date.now(),
                        type: 'OUTBOUND',
                        time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                        message: `Surat Jalan baru ${this.orderForm.number} dibuat untuk ${this.orderForm.customer}`,
                        user: 'Admin Penjualan',
                        reference: this.orderForm.number
                    });

                    this.addOrderModal = false;
                    this.saveToStorage();
                    window.playSuccessSound();
                    this.showToast(`Surat Jalan ${this.orderForm.number} berhasil dibuat!`, 'success');
                },

                processDispatchOrder(order) {
                    window.playBeepSound();

                    // Deduct stock from racks
                    order.items.forEach(item => {
                        const rack = this.racks.find(r => r.code === item.fromRack);
                        if (rack) {
                            rack.currentQty = Math.max(0, rack.currentQty - item.qty);
                            if (rack.items) {
                                const stored = rack.items.find(i => i.sku === item.sku);
                                if (stored) {
                                    stored.qty = Math.max(0, stored.qty - item.qty);
                                }
                            }
                        }
                    });

                    this.auditLogs.unshift({
                        id: Date.now(),
                        type: 'OUTBOUND',
                        time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                        message: `Pesanan ${order.number} selesai dipacking dan dikirim ke ${order.customer} via ${order.courier}`,
                        user: 'Staff Dispatch',
                        reference: order.number
                    });

                    this.lastDispatchedOrder = JSON.parse(JSON.stringify(order));
                    this.dispatchSlipModal = true;

                    this.outboundList = this.outboundList.filter(o => o.id !== order.id);
                    this.saveToStorage();
                    window.playSuccessSound();
                },

                deleteOrder(order) {
                    if (confirm(`Batalkan pesanan ${order.number} untuk ${order.customer}?`)) {
                        this.outboundList = this.outboundList.filter(o => o.id !== order.id);
                        this.auditLogs.unshift({
                            id: Date.now(),
                            type: 'HAPUS',
                            time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                            message: `Surat Jalan ${order.number} dibatalkan`,
                            user: 'Supervisor Outbound',
                            reference: order.number
                        });
                        this.saveToStorage();
                        this.showToast(`Pesanan ${order.number} telah dibatalkan.`, 'success');
                    }
                },

                inspectRack(rack) {
                    this.activeInspectedRack = rack;
                    this.inspectedRackModal = true;
                },

                testScanItem(item) {
                    window.playBeepSound();
                    this.showToast(`Scan Barcode ${item.barcode}: ${item.name} di Rak ${item.rack} (Stok: ${item.qty} ${item.unit})`, 'info');
                },

                // Lead Form
                openLeadModal() {
                    this.leadModal = true;
                },

                submitLeadForm() {
                    const phone = '{{ preg_replace("/[^0-9]/", "", $whatsapp) }}';
                    const message = `Halo tim PT Ruang Solusi Inovasi (RSI),

Saya telah mencoba demo aplikasi *RSI WMS (Warehouse Management System)* di website dan berminat untuk konsultasi implementasi di gudang kami:

- *Nama PIC:* ${this.leadForm.name}
- *Perusahaan:* ${this.leadForm.company}
- *Jenis Industri:* ${this.leadForm.industry}
- *Estimasi SKU:* ${this.leadForm.skuCount}
- *Kebutuhan Khusus:* ${this.leadForm.notes || 'Standar WMS'}

Mohon informasi penawaran dan jadwal presentasi lebih lanjut. Terima kasih.`;

                    this.leadModal = false;
                    window.open(`https://wa.me/${phone}?text=${encodeURIComponent(message)}`, '_blank');
                    this.showToast('Membuka WhatsApp resmi RSI...', 'success');
                },

                showToast(message, type = 'success') {
                    this.toast.message = message;
                    this.toast.type = type;
                    this.toast.visible = true;
                    if (this.toast.timer) clearTimeout(this.toast.timer);
                    this.toast.timer = setTimeout(() => {
                        this.toast.visible = false;
                    }, 4000);
                }
            }
        }
    </script>
</body>
</html>
