<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'SinartaMJS') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --maroon: #800020;
            --maroon-dark: #5c0017;
            --maroon-light: #a6002b;
            --yellow: #FFD700;
            --yellow-light: #FFED4E;
        }
        
        .bg-maroon { background-color: var(--maroon); }
        .bg-maroon-dark { background-color: var(--maroon-dark); }
        .bg-maroon-light { background-color: var(--maroon-light); }
        .text-maroon { color: var(--maroon); }
        .text-yellow { color: var(--yellow); }
        .border-maroon { border-color: var(--maroon); }
        .hover\:bg-maroon-dark:hover { background-color: var(--maroon-dark); }
        .hover\:text-yellow:hover { color: var(--yellow); }
        
        html { scroll-behavior: smooth; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .navbar-scrolled {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background-color: white !important;
        }
    </style>
</head>
<body class="font-sans antialiased">
    
    <!-- Navbar -->
    <nav id="navbar" class="fixed w-full top-0 z-50 bg-white transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" 
                   onclick="trackClick('navbar', 'Logo Click');"
                   class="flex items-center space-x-3">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" 
                             alt="Logo SinartaMJS" 
                             class="h-10 w-auto object-contain">
                    </div>
                </a>

                <!-- Desktop Menu - REPLACE EXISTING ONE -->
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
    <a href="{{ route('services') }}" 
       onclick="trackClick('navbar', 'Menu - Layanan');"
       class="text-gray-700 hover:text-maroon font-medium transition {{ request()->routeIs('services*') ? 'text-maroon' : '' }}">
        Layanan
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
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <!-- Mobile Menu - REPLACE EXISTING ONE -->
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
        <a href="{{ route('services') }}" 
           onclick="trackClick('navbar_mobile', 'Menu - Layanan');"
           class="text-gray-700 hover:text-maroon font-medium px-4 py-2 rounded-lg hover:bg-gray-50 transition {{ request()->routeIs('services*') ? 'bg-gray-50 text-maroon' : '' }}">
            Layanan
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
    
    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-maroon-dark text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <a href="{{ route('home') }}" 
                       onclick="trackClick('footer', 'Logo Click');"
                       class="flex items-center space-x-3 mb-4">
                        <div class="flex items-center">
                            <img src="{{ asset('images/logo.png') }}" 
                                 alt="Logo SinartaMJS" 
                                 class="h-10 w-auto object-contain">
                        </div>
                    </a>
                    <p class="text-gray-300 text-sm mb-4">
                        <b>PT Sinarta Multi Jasa Sertifikasi</b>
                    adalah perusahaan pelatihan dan sertifikasi SDM, berfokus pada pembinaan dan sertifikasi K3. Berdiri sejak 2022 dan berizin resmi Kementerian Ketenagakerjaan RI (SKP No.5/1309/AS.01.02/XI/2024), Sinarta berpengalaman melahirkan Ahli K3 Umum bersertifikat Kemnaker.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-bold text-lg mb-4 text-yellow">Menu Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="{{ route('about') }}" 
                               onclick="trackClick('footer', 'Link - Tentang Kami');"
                               class="text-gray-300 hover:text-yellow transition">
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('services') }}" 
                               onclick="trackClick('footer', 'Link - Layanan');"
                               class="text-gray-300 hover:text-yellow transition">
                                Layanan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('programs') }}" 
                               onclick="trackClick('footer', 'Link - Program Pelatihan');"
                               class="text-gray-300 hover:text-yellow transition">
                                Program Pelatihan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" 
                               onclick="trackClick('footer', 'Link - Kontak');"
                               class="text-gray-300 hover:text-yellow transition">
                                Kontak
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div>
                    <h3 class="font-bold text-lg mb-4 text-yellow">Layanan Kami</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="text-gray-300">Pelatihan AK3 Umum</li>
                        <li class="text-gray-300">Sertifikasi BNSP</li>
                        <li class="text-gray-300">Perpanjangan SKP</li>
                        <li class="text-gray-300">Pelatihan TOT BNSP</li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="font-bold text-lg mb-4 text-yellow">Hubungi Kami</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start space-x-2">
                            <svg class="w-5 h-5 text-yellow mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-300">Jl. Cipto Mangunkusumo, Belimbing, Kec. Bontang Barat, Kota Bontang, Kalimantan Timur 75313</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-yellow flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:Marketing@sinartamjs.com" 
                               onclick="trackClick('footer', 'Email - Marketing@sinartamjs.com');"
                               class="text-gray-300 hover:text-yellow transition">
                                Marketing@sinartamjs.com
                            </a>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-yellow flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <a href="tel:+6281351813731" 
                               onclick="trackClick('footer', 'Phone - +6281351813731');"
                               class="text-gray-300 hover:text-yellow transition">
                                +62 813-5181-3731
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-maroon-light mt-8 pt-8 text-center text-sm text-gray-300">
                <p>&copy; 2025 PT Sinarta Multi Jasa Sertifikasi. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/6281351813731" 
       target="_blank"
       onclick="trackClick('whatsapp', 'Float Button');"
       class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition z-40">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
    </a>
    
    <!-- Tracking Function Script -->
    <script>
    function trackClick(type, label) {
        // Send AJAX to track click
        fetch('/api/track-click', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                type: type,
                label: label,
                page_url: window.location.href
            })
        }).catch(err => console.log('Track failed:', err));
    }
    </script>
    
    <!-- Navigation Scripts -->
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    // Close mobile menu if open
                    mobileMenu.classList.add('hidden');
                    
                    const offsetTop = target.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    
</body>
</html>