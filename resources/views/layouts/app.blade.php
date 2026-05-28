<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('images/logo_sinarta.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo_sinarta.png') }}">
    <title>{{ config('app.name', 'SinartaMJS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --maroon: #800020;
            --maroon-dark: #5c0017;
            --maroon-light: #a6002b;
            --maroon-tiny: #fffafa;
            --yellow: #FFD700;
            --yellow-light: #FFED4E;
        }

        .bg-maroon          { background-color: var(--maroon); }
        .bg-maroon-dark     { background-color: var(--maroon-dark); }
        .bg-maroon-light    { background-color: var(--maroon-light); }
        .bg-maroon-tiny     { background-color: var(--maroon-tiny); }
        .text-maroon        { color: var(--maroon); }
        .text-yellow        { color: var(--yellow); }
        .border-maroon      { border-color: var(--maroon); }

        .hover\:bg-maroon-dark:hover { background-color: var(--maroon-dark); }
        .hover\:text-yellow:hover    { color: var(--yellow); }

        html { scroll-behavior: smooth; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out; }

        .navbar-scrolled {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: white !important;
        }
    </style>
</head>
<body class="font-sans antialiased" style="background-color: #FFFAFA">

    {{-- Top Bar + Navbar --}}
    <div class="fixed w-full top-0 z-50">
        {{-- Navbar --}}
        <nav id="navbar" class="w-full bg-white transition-all duration-300">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">

                    {{-- Logo --}}
                    <a href="{{ route('home') }}"
                    onclick="trackClick('navbar', 'Logo Click');"
                    class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}"
                            alt="Logo SinartaMJS"
                            class="h-10 w-auto object-contain">
                    </a>

                    {{-- Desktop Menu --}}
                    <div class="hidden lg:flex items-center space-x-8">
                        <a href="{{ route('home') }}"
                        onclick="trackClick('navbar', 'Menu - Beranda');"
                        class="text-gray-700 hover:text-maroon font-medium transition {{ request()->routeIs('home') ? 'text-maroon' : '' }}">
                            Beranda
                        </a>
                        <a href="{{ route('about') }}"
                        onclick="trackClick('navbar', 'Menu - Tentang');"
                        class="text-gray-700 hover:text-maroon font-medium transition {{ request()->routeIs('about') ? 'text-maroon' : '' }}">
                            Tentang
                        </a>
                        <a href="{{ route('programs') }}"
                        onclick="trackClick('navbar', 'Menu - Program');"
                        class="text-gray-700 hover:text-maroon font-medium transition {{ request()->routeIs('programs*') ? 'text-maroon' : '' }}">
                            Program
                        </a>
                        <a href="{{ route('instructor') }}"
                        onclick="trackClick('navbar', 'Menu - Instruktur');"
                        class="text-gray-700 hover:text-maroon font-medium transition {{ request()->routeIs('instructor*') ? 'text-maroon' : '' }}">
                            Bergabung sebagai Instruktur
                        </a>
                        <a href="{{ route('contact') }}"
                        onclick="trackClick('navbar', 'Menu - Hubungi Kami');"
                        class="bg-maroon text-white px-6 py-2 rounded-lg hover:bg-maroon-dark transition font-medium">
                            Hubungi Kami
                        </a>
                    </div>

                    {{-- Mobile Menu Button --}}
                    <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                {{-- Mobile Menu --}}
                <div id="mobile-menu" class="hidden lg:hidden pb-4">
                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('home') }}"
                        onclick="trackClick('navbar_mobile', 'Menu - Beranda');"
                        class="text-gray-700 hover:text-maroon font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition {{ request()->routeIs('home') ? 'bg-gray-50 text-maroon' : '' }}">
                            Beranda
                        </a>
                        <a href="{{ route('about') }}"
                        onclick="trackClick('navbar_mobile', 'Menu - Tentang');"
                        class="text-gray-700 hover:text-maroon font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition {{ request()->routeIs('about') ? 'bg-gray-50 text-maroon' : '' }}">
                            Tentang
                        </a>
                        <a href="{{ route('programs') }}"
                        onclick="trackClick('navbar_mobile', 'Menu - Program');"
                        class="text-gray-700 hover:text-maroon font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition {{ request()->routeIs('programs*') ? 'bg-gray-50 text-maroon' : '' }}">
                            Program
                        </a>
                        <a href="{{ route('instructor') }}"
                        onclick="trackClick('navbar_mobile', 'Menu - Instruktur');"
                        class="text-gray-700 hover:text-maroon font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition {{ request()->routeIs('instructor*') ? 'bg-gray-50 text-maroon' : '' }}">
                            Bergabung sebagai Instruktur
                        </a>
                        <a href="{{ route('contact') }}"
                        onclick="trackClick('navbar_mobile', 'Menu - Hubungi Kami');"
                        class="bg-maroon text-white px-4 py-2 rounded-lg hover:bg-maroon-dark transition font-medium text-center">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    {{-- Main Content --}}
    <main style="padding-top: 75px;">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-maroon-dark text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    
                {{-- Kolom 1: Logo + Deskripsi --}}
                <div>
                    <a href="{{ route('home') }}"
                    onclick="trackClick('footer', 'Logo Click');"
                    class="flex items-center mb-4">
                        <img src="{{ asset('images/logo_sinarta_putih.png') }}"
                            alt="Logo SinartaMJS"
                            class="h-20 object-contain">
                    </a>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        <b>PT Sinarta Multi Jasa Sertifikasi</b> adalah perusahaan pelatihan dan sertifikasi SDM,
                        berfokus pada pembinaan dan sertifikasi K3. Berdiri sejak 2022 dan berizin resmi
                        Kementerian Ketenagakerjaan RI (SKP No.5/1309/AS.01.02/XI/2024), Sinarta berpengalaman
                        melahirkan Ahli K3 Umum bersertifikat Kemnaker.
                    </p>
                </div>
    
                {{-- Kolom 2: Office + Contact Us --}}
                <div class="space-y-8">
    
                    <div>
                        <h3 class="font-bold text-base mb-3">Office</h3>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            Jl. Cipto Mangunkusumo, Belimbing, Kec.<br>
                            Bontang Barat, Kota Bontang, Kalimantan Timur<br>
                            75313
                        </p>
                    </div>
    
                    <div>
                        <h3 class="font-bold text-base mb-3">Contact Us</h3>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <a href="https://wa.me/6281351813731"
                                onclick="trackClick('footer', 'Phone');"
                                class="text-gray-300 hover:text-white transition">
                                    +62 813-5181-3731
                                </a>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <a href="mailto:marketing@sinartamjs.com"
                                onclick="trackClick('footer', 'Email');"
                                class="text-gray-300 hover:text-white transition">
                                    marketing@sinartamjs.com
                                </a>
                            </li>
                        </ul>
                    </div>
    
                </div>
    
                {{-- Kolom 3: Social Media --}}
                <div>
                    <h3 class="font-bold text-base mb-4">Social Media</h3>
                    <div class="flex items-center gap-3">
    
                        {{-- Instagram --}}
                        <a href="https://www.instagram.com/sinarta_id/"
                        target="_blank"
                        onclick="trackClick('footer', 'Social - Instagram');"
                        class="w-11 h-11 rounded-lg border border-white/30 flex items-center justify-center hover:bg-white/10 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
    
                        {{-- Facebook --}}
                        <a href="https://www.facebook.com/sinartamjs"
                        target="_blank"
                        onclick="trackClick('footer', 'Social - Facebook');"
                        class="w-11 h-11 rounded-full border border-white/30 flex items-center justify-center hover:bg-white/10 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
    
                        {{-- TikTok --}}
                        <a href="https://www.tiktok.com/@sinartamjs"
                        target="_blank"
                        onclick="trackClick('footer', 'Social - TikTok');"
                        class="w-11 h-11 rounded-lg border border-white/30 flex items-center justify-center hover:bg-white/10 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.75a4.85 4.85 0 01-1.01-.06z"/>
                            </svg>
                        </a>
    
                    </div>
                </div>
    
            </div>
    
            <div class="border-t border-white/10 mt-10 pt-6 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} PT Sinarta Multi Jasa Sertifikasi. All rights reserved.
            </div>
        </div>
    </footer>

    {{-- WhatsApp Float Button --}}
    <a href="https://wa.me/6281351813731"
       target="_blank"
       onclick="trackClick('whatsapp', 'Float Button');"
       class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition z-40">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
    </a>

    {{-- Tracking Script --}}
    <script>
    function trackClick(type, label) {
        fetch('/api/track-click', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
            },
            body: JSON.stringify({ type, label, page_url: window.location.href })
        }).catch(err => console.log('Track failed:', err));
    }
    </script>

    {{-- Navigation Scripts --}}
    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu    = document.getElementById('mobile-menu');
        const navbar        = document.getElementById('navbar');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        window.addEventListener('scroll', () => {
            navbar.classList.toggle('navbar-scrolled', window.scrollY > 50);
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    mobileMenu.classList.add('hidden');
                    window.scrollTo({ top: target.offsetTop - 80, behavior: 'smooth' });
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>