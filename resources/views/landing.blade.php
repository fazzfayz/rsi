<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <title>Ruang Solusi Internusa | Managed Service Provider & Solusi IT Indonesia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ruang Solusi Internusa - Managed Service Provider (MSP) terpercaya di Indonesia: Layanan IT Outsourcing, Infrastruktur Jaringan, Cyber Security, dan Solusi Digital Bisnis.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/rsi.png') }}">

    <!-- Open Graph / Meta -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Ruang Solusi Internusa">
    <meta property="og:title" content="Ruang Solusi Internusa | Managed Service Provider & Solusi IT">
    <meta property="og:description" content="Solusi digital dan IT outsourcing terintegrasi: Managed Service, Keamanan Siber, Infrastruktur Jaringan, dan Cloud Hosting.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('img/rsi.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            color: #1f2937;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #93c5fd;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #3b82f6;
        }

        /* Smooth section transitions */
        .fade-in-section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
            will-change: opacity, visibility;
        }
        .fade-in-section.is-visible {
            opacity: 1;
            transform: none;
        }
    </style>
</head>

<body class="bg-white text-gray-800 antialiased overflow-x-hidden selection:bg-blue-600 selection:text-white">

    <!-- Sticky Enterprise Navigation -->
    <x-landing-page.navbar :navLinks="$navLinks" />

    <!-- Modern Hero Section -->
    <x-landing-page.hero-section :settings="$settings" />

    <!-- Client / Partner Marquee & Metrics -->
    <x-landing-page.clients-marquee />

    <!-- Core Business Section: 3 Zig-Zag Alternating Enterprise Rows -->
    <x-landing-page.core-business />

    <!-- Proprietary Product Section: WMS Realtime Trial -->
    <x-landing-page.wms-product :settings="$settings" />

    <!-- Industry Solutions Section -->
    <x-landing-page.industry-solutions />

    <!-- Filterable Tabbed Portfolio Section [NEW] -->
    <x-landing-page.portfolio-section />

    <!-- Services Ecosystem Section -->
    <x-landing-page.service-section :services="$services" />

    <!-- About & Value Pillars Section -->
    <x-landing-page.about-section :about="$about" />

    <!-- Customer Success & Testimonial Section -->
    <x-landing-page.testimonials />

    <!-- Integrated Consultation & Location Section -->
    <x-landing-page.contact-section :settings="$settings" />

    <!-- Enterprise Multi-Column Footer -->
    <x-landing-page.footer :settings="$settings" />

    <!-- Floating Assistance / WhatsApp Widget -->
    <x-landing-page.floating-widget :settings="$settings" />

    <!-- WMS Realtime Trial Modal Dialog -->
    <x-landing-page.wms-trial-modal :settings="$settings" />

    <!-- Interactive Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Mobile Menu Drawer Toggle
            const hamburgerBtn = document.getElementById('navbarHamburger');
            const mobileMenu = document.getElementById('navbarLinks');
            const hamburgerIcon = document.getElementById('hamburgerIcon');
            const closeIcon = document.getElementById('closeIcon');

            if (hamburgerBtn && mobileMenu) {
                hamburgerBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isOpen = mobileMenu.classList.contains('opacity-100');

                    if (isOpen) {
                        mobileMenu.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
                        mobileMenu.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
                        if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                        if (closeIcon) closeIcon.classList.add('hidden');
                        hamburgerBtn.setAttribute('aria-expanded', 'false');
                    } else {
                        mobileMenu.classList.remove('-translate-y-full', 'opacity-0', 'pointer-events-none');
                        mobileMenu.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
                        if (hamburgerIcon) hamburgerIcon.classList.add('hidden');
                        if (closeIcon) closeIcon.classList.remove('hidden');
                        hamburgerBtn.setAttribute('aria-expanded', 'true');
                    }
                });

                // Close mobile menu on clicking any navigation link
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
                        mobileMenu.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
                        if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                        if (closeIcon) closeIcon.classList.add('hidden');
                        hamburgerBtn.setAttribute('aria-expanded', 'false');
                    });
                });

                // Close mobile menu when clicking outside
                document.addEventListener('click', function (e) {
                    if (!mobileMenu.contains(e.target) && !hamburgerBtn.contains(e.target)) {
                        mobileMenu.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
                        mobileMenu.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
                        if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                        if (closeIcon) closeIcon.classList.add('hidden');
                        hamburgerBtn.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // 2. Animated Number Counters
            const counters = document.querySelectorAll('.stat-counter');
            if (counters.length) {
                const animateCounter = (el) => {
                    const target = parseFloat(el.getAttribute('data-target'));
                    const isDecimal = el.getAttribute('data-decimal') === 'true';
                    const duration = 2000;
                    let startTime = null;

                    const step = (timestamp) => {
                        if (!startTime) startTime = timestamp;
                        const progress = Math.min((timestamp - startTime) / duration, 1);
                        const current = progress * target;

                        el.textContent = isDecimal
                            ? current.toFixed(1)
                            : Math.floor(current).toLocaleString('id-ID');

                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            el.textContent = isDecimal ? target.toFixed(1) : target.toLocaleString('id-ID');
                        }
                    };

                    window.requestAnimationFrame(step);
                };

                const counterObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounter(entry.target);
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.3 });

                counters.forEach(counter => counterObserver.observe(counter));
            }

            // 3. Navbar Active Link Highlight on Scroll
            const sections = ['beranda', 'core-bisnis', 'wms-product', 'portfolio', 'layanan', 'tentang', 'kontak'];
            const navLinks = document.querySelectorAll('.navbar-link');

            function updateActiveNav() {
                const scrollPosition = window.scrollY + 120;

                for (let i = sections.length - 1; i >= 0; i--) {
                    const sec = document.getElementById(sections[i]);
                    if (sec && sec.offsetTop <= scrollPosition) {
                        navLinks.forEach(link => {
                            link.classList.remove('text-blue-700', 'bg-blue-50/90', 'font-bold');
                            link.classList.add('text-slate-600');
                        });

                        const currentLinks = document.querySelectorAll(`.navbar-link[href="#${sections[i]}"]`);
                        currentLinks.forEach(link => {
                            link.classList.remove('text-slate-600');
                            link.classList.add('text-blue-700', 'bg-blue-50/90', 'font-bold');
                        });
                        return;
                    }
                }
            }

            window.addEventListener('scroll', updateActiveNav, { passive: true });
            updateActiveNav();
        });
    </script>
</body>

</html>