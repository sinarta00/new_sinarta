<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | SinartaMJS</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --maroon: #800020;
            --maroon-dark: #5c0017;
            --yellow: #FFD700;
        }
        
        .bg-maroon { background-color: var(--maroon); }
        .bg-maroon-dark { background-color: var(--maroon-dark); }
        .text-maroon { color: var(--maroon); }
        .text-yellow { color: var(--yellow); }
        .hover\:bg-maroon-dark:hover { background-color: var(--maroon-dark); }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
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
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    
    <div class="min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full text-center">
            
            <!-- 404 Number -->
            <div class="mb-8 animate-fade-in-up">
                <div class="relative inline-block">
                    <h1 class="text-9xl md:text-[200px] font-bold text-maroon opacity-10 select-none">404</h1>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-32 h-32 md:w-48 md:h-48 text-maroon animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Text Content -->
            <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.2s;">
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                    Oops! Halaman Tidak Ditemukan
                </h2>
                <p class="text-lg md:text-xl text-gray-600 mb-2">
                    Maaf, halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.
                </p>
                <p class="text-gray-500">
                    URL: <code class="bg-gray-200 px-2 py-1 rounded text-sm">{{ url()->current() }}</code>
                </p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12 animate-fade-in-up" style="animation-delay: 0.4s;">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center bg-maroon text-white px-8 py-4 rounded-lg font-semibold hover:bg-maroon-dark transition shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
                
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-transparent border-2 border-maroon text-maroon px-8 py-4 rounded-lg font-semibold hover:bg-maroon hover:text-white transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Hubungi Kami
                </a>
            </div>
            
            <!-- Quick Links -->
            <div class="animate-fade-in-up" style="animation-delay: 0.6s;">
                <p class="text-gray-600 mb-6">Atau mungkin Anda mencari:</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto">
                    <a href="{{ route('about') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition group">
                        <svg class="w-8 h-8 text-maroon mx-auto mb-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm font-semibold text-gray-900">Tentang Kami</p>
                    </a>
                    
                    <a href="{{ route('services') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition group">
                        <svg class="w-8 h-8 text-maroon mx-auto mb-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm font-semibold text-gray-900">Layanan</p>
                    </a>
                    
                    <a href="{{ route('programs') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition group">
                        <svg class="w-8 h-8 text-maroon mx-auto mb-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p class="text-sm font-semibold text-gray-900">Program</p>
                    </a>
                    
                    <a href="{{ route('contact') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition group">
                        <svg class="w-8 h-8 text-maroon mx-auto mb-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm font-semibold text-gray-900">Kontak</p>
                    </a>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="mt-16 text-gray-500 text-sm animate-fade-in-up" style="animation-delay: 0.8s;">
                <p>&copy; {{ date('Y') }} PT Sinarta Multi Jasa Sertifikasi. All rights reserved.</p>
            </div>
        </div>
    </div>
    
    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/6281234567890" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition z-40 animate-fade-in-up" style="animation-delay: 1s;">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
    </a>
    
</body>
</html>