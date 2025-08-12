<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ruang Solusi Internusa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 1.2s cubic-bezier(.4,0,.2,1), transform 1.2s cubic-bezier(.4,0,.2,1);
        }
        .fade-in.visible {
            opacity: 1;
            transform: none;
        }
        /* Navbar Styles */
        .navbar-custom {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(16px);
            box-shadow: 0 2px 16px 0 rgba(30,64,175,0.10);
            transition: background 0.3s, box-shadow 0.3s;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.5rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .navbar-brand img {
            width: 90px;
            height: auto;
            box-shadow: 0 4px 16px rgba(30,64,175,0.10);
            transition: transform 0.2s cubic-bezier(.4,0,.2,1), box-shadow 0.2s;
        }
        .navbar-brand:hover img {
            transform: scale(1.08) rotate(-3deg);
            box-shadow: 0 8px 32px rgba(30,64,175,0.18);
        }
        .navbar-title {
            font-weight: bold;
            color: #1e40af;
            font-size: 1.25rem;
            letter-spacing: 0.5px;
            display: none;
        }
        @media (min-width: 768px) {
            .navbar-title {
                display: inline;
            }
        }
        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar-links {
            display: flex;
            gap: 0.25rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .navbar-link {
            color: #1e40af;
            position: relative;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            text-decoration: none;
            border-radius: 0.375rem;
            transition: 
                color 0.18s cubic-bezier(.4,0,.2,1),
                background 0.18s cubic-bezier(.4,0,.2,1);
            cursor: pointer;
            outline: none;
            background: transparent;
            display: inline-block;
        }
        .navbar-link.active,
        .navbar-link:focus-visible {
            color: #2563eb;
            background: rgba(37,99,235,0.13);
        }
        .navbar-link:hover {
            color: #fff;
            background: linear-gradient(90deg, #2563eb 70%, #38bdf8 100%);
            box-shadow: 0 2px 12px 0 rgba(37,99,235,0.08);
        }
        .navbar-link.active::after,
        .navbar-link:hover::after,
        .navbar-link:focus-visible::after {
            content: '';
            display: block;
            margin: 0 auto;
            width: 70%;
            height: 3px;
            border-radius: 2px;
            background: linear-gradient(90deg, #2563eb 60%, #38bdf8 100%);
            margin-top: 4px;
            transition: width 0.2s;
        }
        .navbar-link::after {
            content: '';
            display: block;
            width: 0;
            height: 3px;
            background: transparent;
            transition: width 0.2s;
        }
        /* Hamburger */
        .navbar-hamburger {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            margin-left: 0.5rem;
            z-index: 60;
            position: relative;
        }
        .navbar-hamburger:focus {
            outline: 2px solid #2563eb;
        }
        .navbar-hamburger-bar {
            width: 28px;
            height: 3px;
            background: #1e40af;
            border-radius: 2px;
            margin: 3px 0;
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
        }
        /* Hamburger open state */
        .navbar-hamburger.open .bar1 {
            transform: rotate(45deg) translate(5px, 6px);
        }
        .navbar-hamburger.open .bar2 {
            opacity: 0;
        }
        .navbar-hamburger.open .bar3 {
            transform: rotate(-45deg) translate(6px, -6px);
        }
        /* Responsive */
        @media (max-width: 1023px) {
            .navbar-links {
                position: absolute;
                top: 100%;
                right: 1.5rem;
                left: 1.5rem;
                background: rgba(255,255,255,0.98);
                flex-direction: column;
                align-items: stretch;
                gap: 0;
                box-shadow: 0 8px 32px 0 rgba(30,64,175,0.10);
                padding: 0.5rem 0.5rem 0.5rem 0.5rem;
                display: none;
                border-radius: 0.75rem;
                z-index: 55;
                backdrop-filter: blur(16px);
            }
            .navbar-links.open {
                display: flex !important;
            }
            .navbar-link {
                width: 100%;
                border-radius: 0;
                margin-bottom: 0;
                text-align: left;
                padding: 0.75rem 1.2rem;
            }
            .navbar-link:first-child {
                border-top-left-radius: 0.75rem;
                border-top-right-radius: 0.75rem;
            }
            .navbar-link:last-child {
                border-bottom-left-radius: 0.75rem;
                border-bottom-right-radius: 0.75rem;
            }
            .navbar-link:hover {
                background: linear-gradient(90deg, #2563eb 80%, #38bdf8 100%);
                color: #fff;
            }
            .navbar-link.active,
            .navbar-link:focus-visible {
                background: rgba(37,99,235,0.13);
                color: #2563eb;
            }
            .navbar-link::after {
                display: none;
            }
        }
        @media (max-width: 1023px) {
            .navbar-menu {
                flex-direction: row-reverse;
            }
            .navbar-hamburger {
                display: flex;
            }
        }
        @media (min-width: 1024px) {
            .navbar-hamburger {
                display: none;
            }
            .navbar-links {
                position: static;
                flex-direction: row;
                background: none;
                box-shadow: none;
                padding: 0;
                display: flex !important;
                border-radius: 0;
            }
            .navbar-link {
                border-radius: 0.375rem;
                margin-bottom: 0;
                text-align: center;
                padding: 0.5rem 1.2rem;
            }
            .navbar-link:first-child,
            .navbar-link:last-child {
                border-radius: 0.375rem;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-blue-100 text-gray-800 scroll-smooth">

    {{-- Navbar --}}
    <nav class="navbar-custom fade-in shadow">
        <div class="navbar-container">
            <a class="navbar-brand flex items-center gap-2" href="#beranda">
                <img src="{{ asset('img/rsi.png') }}" alt="Ruang Solusi Internusa Logo" class="h-10 w-10 object-contain">
                <span class="navbar-title font-bold text-lg text-blue-800">Ruang Solusi Internusa</span>
            </a>
            <div class="navbar-menu">
                <button class="navbar-hamburger" id="navbarHamburger" aria-label="Toggle menu" aria-expanded="false" type="button">
                    <span class="navbar-hamburger-bar bar1"></span>
                    <span class="navbar-hamburger-bar bar2"></span>
                    <span class="navbar-hamburger-bar bar3"></span>
                </button>
                <ul class="navbar-links" id="navbarLinks">
                    <li><a class="navbar-link" href="#beranda">Beranda</a></li>
                    <li><a class="navbar-link" href="#layanan">Layanan</a></li>
                    <li><a class="navbar-link" href="#tentang">Tentang Kami</a></li>
                    <li><a class="navbar-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>


    {{-- Hero Section --}}
    <section id="beranda" class="relative min-h-screen flex items-center bg-gradient-to-br from-blue-600/10 via-white to-blue-200 overflow-hidden fade-in">
        {{-- Background Image --}}
        <div class="absolute inset-0 w-full h-full">
            <img 
                src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=1200&q=80"
                alt="Transformasi Digital IT"
                class="w-full h-full object-cover object-center opacity-30"
            >
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-white/60 to-blue-200/80"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-5xl md:text-6xl font-extrabold text-blue-800 mb-6 leading-tight drop-shadow-lg">
                Selamat Datang di <span class="text-blue-500">Ruang Solusi Internusa</span>
            </h2>
            <p class="mb-8 text-lg text-gray-700 font-medium">
                Kami siap menjadi mitra teknologi Anda untuk menghadirkan solusi digital terbaik bagi perkembangan bisnis.
            </p>
            <a href="#layanan" class="inline-block bg-blue-700 text-white px-8 py-3 rounded-lg shadow-lg hover:bg-blue-800 transition font-semibold text-lg">
                Lihat Layanan Kami
            </a>
        </div>
    </section>

    {{-- Layanan --}}
    <section id="layanan" class="py-24 bg-gradient-to-br from-blue-100 via-white to-blue-50 relative fade-in">
        <div class="absolute inset-0 pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 1440 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="#e0e7ff" fill-opacity="0.4" d="M0,160L60,170.7C120,181,240,203,360,197.3C480,192,600,160,720,133.3C840,107,960,85,1080,101.3C1200,117,1320,171,1380,197.3L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
            </svg>
        </div>
        <div class="relative max-w-7xl mx-auto px-4">
            <h3 class="text-4xl font-extrabold text-blue-700 mb-4 text-center">Layanan Unggulan Kami</h3>
            <p class="text-lg text-gray-600 mb-14 text-center max-w-2xl mx-auto">
                Kami menawarkan solusi digital terintegrasi untuk mendukung pertumbuhan bisnis Anda. Pilih layanan terbaik kami yang dirancang untuk kebutuhan modern.
            </p>
            <div class="grid md:grid-cols-3 gap-10">
                @forelse($services as $service)
                <div class="group relative bg-white shadow-2xl border border-blue-100 overflow-hidden rounded-2xl fade-in transition-all duration-500 hover:shadow-3xl hover:-translate-y-4 hover:scale-105 cursor-pointer
                    hover:ring-4 hover:ring-blue-200/60 hover:ring-offset-2 hover:ring-offset-white">
                    <div class="w-full h-48 overflow-hidden transition-transform duration-500 group-hover:scale-110">
                        @if($service->image)
                            <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-300 text-4xl">?</div>
                        @endif
                    </div>
                    <div class="pt-8 pb-8 px-6 transition-colors duration-500 group-hover:bg-blue-50/40">
                        <h4 class="text-2xl font-bold mb-3 text-blue-700 group-hover:text-blue-500 transition-colors duration-300">{{ $service->title }}</h4>
                        <p class="text-gray-600 mb-6 group-hover:text-gray-800 transition-colors duration-300">{{ $service->description }}</p>
                        @if($service->label)
                        <span class="inline-block bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-semibold group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">{{ $service->label }}</span>
                        @endif
                    </div>
                    <div class="absolute inset-0 bg-blue-100 opacity-0 group-hover:opacity-10 transition-opacity duration-300 pointer-events-none"></div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-400 py-12">Belum ada layanan tersedia.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Tentang Kami --}}
    <section id="tentang" class="py-16 md:py-24 bg-gradient-to-r from-blue-50 via-white to-blue-100 fade-in">
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-3xl md:text-4xl font-extrabold text-blue-700 mb-4 text-center">{{ $about->title ?? 'Tentang Kami' }}</h3>
            <div class="flex flex-col md:flex-row items-center md:gap-20 gap-8">
                <div class="w-full md:w-1/2 flex justify-center mb-6 md:mb-0">
                    <div class="relative group w-full max-w-md">
                        <div class="absolute -inset-2 bg-gradient-to-tr from-blue-200 via-blue-100 to-blue-50 rounded-3xl blur-2xl opacity-80 group-hover:opacity-100 transition"></div>
                        <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl border-4 border-blue-200 transition-transform duration-500 group-hover:scale-105">
                            @if(isset($about) && $about && $about->image)
                                <img src="{{ asset('storage/'.$about->image) }}" alt="Tentang Kami" class="w-full h-56 md:h-[28rem] object-cover object-center transition-transform duration-500 group-hover:scale-105">
                            @else
                                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=600&q=80" alt="Tim IT" class="w-full h-56 md:h-[28rem] object-cover object-center transition-transform duration-500 group-hover:scale-105">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <p class="text-gray-800 text-base md:text-2xl mb-6 md:mb-8 leading-relaxed border-l-4 border-blue-300 pl-4 md:pl-6 italic bg-blue-50/80 py-3 md:py-4 font-medium shadow-sm">
                        {{ $about->description ?? 'Kami adalah tim profesional di bidang teknologi informasi yang berkomitmen menghadirkan solusi digital terbaik untuk bisnis Anda. Dengan pengalaman lebih dari 2 tahun, kami telah membantu berbagai perusahaan dalam pengembangan sistem, infrastruktur jaringan, dan keamanan informasi.' }}
                    </p>
                    <div class="mb-6 md:mb-8">
                        <h4 class="text-lg md:text-2xl font-bold text-blue-600 mb-3 md:mb-4 flex items-center gap-2 md:gap-3"><i class="fas fa-award text-yellow-400 text-xl md:text-2xl"></i> Keunggulan Kami</h4>
                        @if(isset($about) && $about && $about->list_items)
                            <ul class="space-y-3 md:space-y-4">
                                @foreach(explode("\n", $about->list_items) as $item)
                                    <li class="flex items-center gap-3 md:gap-4 text-base md:text-xl text-gray-800 group hover:bg-blue-50/80 rounded-xl px-2 md:px-3 py-2 transition">
                                        <span class="inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-tr from-blue-400 to-blue-600 text-white text-lg md:text-2xl shadow-lg mr-2 group-hover:scale-110 transition-transform"><i class="fas fa-check"></i></span>
                                        <span class="font-semibold">{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <ul class="space-y-3 md:space-y-4">
                                <li class="flex items-center gap-3 md:gap-4 text-base md:text-xl text-gray-800 group hover:bg-blue-50/80 rounded-xl px-2 md:px-3 py-2 transition">
                                    <span class="inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-tr from-blue-400 to-blue-600 text-white text-lg md:text-2xl shadow-lg mr-2 group-hover:scale-110 transition-transform"><i class="fas fa-check"></i></span>
                                    <span class="font-semibold">Tim berpengalaman & tersertifikasi</span>
                                </li>
                                <li class="flex items-center gap-3 md:gap-4 text-base md:text-xl text-gray-800 group hover:bg-blue-50/80 rounded-xl px-2 md:px-3 py-2 transition">
                                    <span class="inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-tr from-blue-400 to-blue-600 text-white text-lg md:text-2xl shadow-lg mr-2 group-hover:scale-110 transition-transform"><i class="fas fa-check"></i></span>
                                    <span class="font-semibold">Teknologi terbaru & inovatif</span>
                                </li>
                                <li class="flex items-center gap-3 md:gap-4 text-base md:text-xl text-gray-800 group hover:bg-blue-50/80 rounded-xl px-2 md:px-3 py-2 transition">
                                    <span class="inline-flex items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-tr from-blue-400 to-blue-600 text-white text-lg md:text-2xl shadow-lg mr-2 group-hover:scale-110 transition-transform"><i class="fas fa-check"></i></span>
                                    <span class="font-semibold">Layanan personal & responsif</span>
                                </li>
                            </ul>
                        @endif
                    </div>
                    <div class="flex flex-wrap gap-3 md:gap-4 mt-6 md:mt-8">
                        <span class="inline-block bg-blue-100 text-blue-700 px-4 md:px-5 py-2 rounded-full text-base md:text-lg font-bold shadow">#DigitalTransformation</span>
                        <span class="inline-block bg-blue-100 text-blue-700 px-4 md:px-5 py-2 rounded-full text-base md:text-lg font-bold shadow">#ITProfessional</span>
                        <span class="inline-block bg-blue-100 text-blue-700 px-4 md:px-5 py-2 rounded-full text-base md:text-lg font-bold shadow">#SolusiBisnis</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kontak --}}
    <section id="kontak" class="py-24 bg-gradient-to-br from-blue-50 via-white to-blue-100 fade-in">
        <div class="max-w-2xl mx-auto px-4">
            <div class="text-center mb-10">
                <h3 class="text-4xl font-extrabold text-blue-700 mb-4">Hubungi Kami</h3>
                <p class="text-gray-700 text-lg">Siap bertransformasi digital? Konsultasikan kebutuhan IT Anda bersama kami.</p>
            </div>
            <div class="flex flex-col items-center gap-8">
                {{-- Form Kontak --}}
                <div class="w-full bg-white rounded-2xl shadow-xl p-8 flex flex-col justify-center mb-8">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="name" class="block text-blue-700 font-semibold mb-1">Nama</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                        </div>
                        <div>
                            <label for="email" class="block text-blue-700 font-semibold mb-1">Email</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                        </div>
                        <div>
                            <label for="message" class="block text-blue-700 font-semibold mb-1">Pesan</label>
                            <textarea id="message" name="message" rows="4" required
                                      class="w-full px-4 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition resize-none"></textarea>
                        </div>
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-700 to-blue-500 text-white font-semibold py-2 rounded-lg hover:from-blue-800 hover:to-blue-600 transition shadow">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
                {{-- Kontak Lain --}}
                <div class="w-full bg-blue-50 rounded-2xl shadow-xl p-8 flex flex-col items-center">
                    <div class="mb-4">
                        <img src="{{ asset('img/file.jpeg') }}"
                             alt="WhatsApp"
                             class="w-20 h-20 rounded-full border-4 border-green-200 shadow-lg object-cover">
                    </div>
                    <a href="https://wa.me/6281287182682" target="_blank"
                       class="inline-flex items-center px-7 py-3 bg-green-500 text-white font-bold rounded-full shadow-lg hover:bg-green-600 transition text-lg mb-4">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.12.55 4.19 1.6 6.01L0 24l6.18-1.62A11.93 11.93 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.67-.5-5.24-1.44l-.37-.22-3.67.96.98-3.58-.24-.37A9.93 9.93 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.2-7.8c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.19.05-.36-.02-.5-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.61-.47-.16-.01-.35-.01-.54-.01-.19 0-.5.07-.76.34-.26.27-1 1-.98 2.43.02 1.43 1.03 2.81 1.18 3.01.15.2 2.03 3.1 5.02 4.22.7.24 1.25.38 1.68.48.71.15 1.36.13 1.87.08.57-.06 1.65-.67 1.88-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z"/>
                        </svg>
                        WhatsApp: <span class="ml-1 font-mono">+62 812-8718-2682</span>
           </a>
                    <div class="mt-4 text-gray-600 text-base w-full text-center">
                        <div class="flex items-center justify-center mb-2">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 2l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z"/>
                            </svg>
                            <span>info@ruang-solusi.com</span>
                        </div>
                        <div class="flex items-center justify-center mb-2">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                                <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Senin - Jumat, 09.00 - 18.00 WIB</span>
                        </div>
                        <div class="flex items-start justify-center text-sm">
                            <svg class="w-4 h-4 mr-2 mt-0.5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5z"/>
                            </svg>
                            <span class="leading-snug">
                                Jl. Pondok Kelapa Timur No.11, RT.9/RW.11, Pd. Klp., Kec. Duren Sawit, Kota Jakarta Timur, DKI Jakarta 13450<br>
                                <a href="https://maps.app.goo.gl/8Gq3f8iFECLZiFGW7" target="_blank" class="text-blue-600 underline">Lihat di Google Maps</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-blue-700 text-white text-center py-8 mt-10 shadow-inner">
        <div class="flex flex-col md:flex-row justify-center items-center gap-4">
            <span class="font-semibold">&copy; {{ date('Y') }} Ruang Solusi Internusa</span>
            <span class="hidden md:inline">|</span>
            <span class="flex items-center gap-1 text-xs opacity-80">
                Design by Distwnty
                <a href="https://instagram.com/distwnty" target="_blank" rel="noopener" class="ml-1 hover:text-pink-400 transition">
                    <svg class="w-4 h-4 inline-block align-text-bottom" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 3.25a5.25 5.25 0 1 1 0 10.5 5.25 5.25 0 0 1 0-10.5zm0 1.5a3.75 3.75 0 1 0 0 7.5 3.75 3.75 0 0 0 0-7.5zm5.13.88a1.13 1.13 0 1 1-2.25 0 1.13 1.13 0 0 1 2.25 0z"/>
                    </svg>
                </a>
            </span>
        </div>
    </footer>

    {{-- Script AOS --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        // AOS for extra fade
        AOS.init({ duration: 1200, once: true, easing: 'ease-in-out-cubic' });

        // Custom fade-in for smooth fade on scroll
        function onScrollFadeIn() {
            const fadeEls = document.querySelectorAll('.fade-in');
            fadeEls.forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 60) {
                    el.classList.add('visible');
                }
            });
        }
        document.addEventListener('DOMContentLoaded', () => {
            onScrollFadeIn();
            window.addEventListener('scroll', onScrollFadeIn);

            // Navbar active link highlight on scroll
            const sections = ['beranda', 'layanan', 'tentang', 'kontak'];
            const navLinks = document.querySelectorAll('.navbar-link');
            function setActiveNav() {
                let scrollPos = window.scrollY + 80;
                let found = false;
                for (let i = sections.length - 1; i >= 0; i--) {
                    const section = document.getElementById(sections[i]);
                    if (section && section.offsetTop <= scrollPos) {
                        navLinks.forEach(link => link.classList.remove('active'));
                        const activeLink = document.querySelector('.navbar-link[href="#' + sections[i] + '"]');
                        if (activeLink) activeLink.classList.add('active');
                        found = true;
                        break;
                    }
                }
                if (!found) navLinks.forEach(link => link.classList.remove('active'));
            }
            setActiveNav();
            window.addEventListener('scroll', setActiveNav);

            // Hamburger menu functionality
            const hamburger = document.getElementById('navbarHamburger');
            const links = document.getElementById('navbarLinks');
            
            if (hamburger && links) {
                // Toggle menu on hamburger click
                hamburger.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const isOpen = links.classList.toggle('open');
                    hamburger.classList.toggle('open');
                    hamburger.setAttribute('aria-expanded', isOpen);
                    

                });

                // Close menu when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth < 1024) {
                        if (
                            links.classList.contains('open') &&
                            !links.contains(e.target) &&
                            !hamburger.contains(e.target)
                        ) {
                            links.classList.remove('open');
                            hamburger.classList.remove('open');
                            hamburger.setAttribute('aria-expanded', 'false');
                        }
                    }
                });

                // Close menu when clicking on links on mobile
                links.querySelectorAll('.navbar-link').forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth < 1024) {
                            links.classList.remove('open');
                            hamburger.classList.remove('open');
                            hamburger.setAttribute('aria-expanded', 'false');
                        }
                    });
                });

                // Handle window resize
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 1024) {
                        links.classList.remove('open');
                        hamburger.classList.remove('open');
                        hamburger.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });

        // Smooth scroll for anchor links (for browsers that don't support scroll-behavior)
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>

</body>
</html>
