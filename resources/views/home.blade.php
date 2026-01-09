@extends('layouts.app')

@section('content')

@if($popup)
<div id="promoPopup" 
     class="fixed inset-0 bg-black/60 backdrop-blur-md z-50 flex items-center justify-center p-4 transition-all duration-300 opacity-0" 
     style="display: none; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);">

    <div class="bg-white rounded-2xl max-w-2xl w-full relative animate-fade-in-up shadow-2xl overflow-hidden">
        
        <!-- Tombol Close -->
        <button onclick="closePopup()" 
                class="absolute -top-3 -right-3 w-10 h-10 bg-maroon text-white rounded-full hover:bg-maroon-dark transition flex items-center justify-center shadow-lg z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <!-- Konten Popup -->
        <div class="relative">
            @if($popup->link)
                <a href="{{ $popup->link }}" target="{{ $popup->open_new_tab ? '_blank' : '_self' }}" class="block">
                    <div class="w-full max-h-[70vh] overflow-hidden rounded-t-2xl">
                        <img src="{{ Storage::url($popup->image) }}" 
                             alt="{{ $popup->title }}" 
                             class="w-full h-auto object-contain cursor-pointer hover:opacity-95 transition">
                    </div>
                </a>
            @else
                <div class="w-full max-h-[70vh] overflow-hidden rounded-t-2xl">
                    <img src="{{ Storage::url($popup->image) }}" 
                         alt="{{ $popup->title }}" 
                         class="w-full h-auto object-contain">
                </div>
            @endif
            
            @if($popup->description)
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $popup->title }}</h3>
                <p class="text-gray-600">{{ $popup->description }}</p>
                
                @if($popup->link)
                <a href="{{ $popup->link }}" 
                   target="{{ $popup->open_new_tab ? '_blank' : '_self' }}" 
                   class="inline-block mt-4 bg-maroon text-white px-6 py-3 rounded-lg hover:bg-maroon-dark transition font-semibold">
                    Selengkapnya
                </a>
                @endif
            </div>
            @endif
        </div>
        
        <!-- Checkbox Jangan tampilkan lagi -->
        <div class="px-6 pb-6">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="dontShowAgain" class="w-4 h-4 text-maroon border-gray-300 rounded focus:ring-maroon">
                <span class="ml-2 text-sm text-gray-600">Jangan tampilkan lagi hari ini</span>
            </label>
        </div>
    </div>
</div>

<!-- Animasi CSS -->
<style>
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.animate-fade-in-up {
  animation: fadeInUp 0.4s ease-out forwards;
}
</style>

<!-- Script Popup -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('promoPopup');
    const dontShowCheckbox = document.getElementById('dontShowAgain');
    const popupId = '{{ $popup->id }}';
    const storageKey = 'popup_closed_' + popupId;
    
    const popupClosed = localStorage.getItem(storageKey);
    const today = new Date().toDateString();
    
    // Tampilkan popup jika belum pernah ditutup hari ini
    if (!popupClosed || popupClosed !== today) {
        setTimeout(() => {
            popup.style.display = 'flex';
            setTimeout(() => {
                popup.style.opacity = '1';
            }, 10);
        }, 1000); // delay 1 detik
    }
    
    // Fungsi close popup
    window.closePopup = function() {
        popup.style.opacity = '0';
        setTimeout(() => {
            popup.style.display = 'none';
        }, 300);
        
        if (dontShowCheckbox.checked) {
            localStorage.setItem(storageKey, new Date().toDateString());
        }
    };
    
    // Tutup popup jika klik area overlay
    popup.addEventListener('click', function(e) {
        if (e.target === popup) {
            closePopup();
        }
    });
    
    // Tutup popup dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popup.style.display === 'flex') {
            closePopup();
        }
    });
});
</script>
@endif


<!-- Rest of the homepage content... -->

<!-- Hero Section -->
<!-- Hero Section with Carousel -->
<section class="relative bg-white py-8 md:py-12">
    
    @if($heroes->isNotEmpty())
    <div class="relative w-full max-w-[1600px] mx-auto px-4 md:px-20">
        
        <div class="flex items-center gap-4">
            <!-- Navigation Arrows - OUTSIDE -->
            @if($heroes->count() > 1)
            <button class="hero-prev flex-shrink-0 bg-white hover:bg-gray-50 text-gray-800 w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center shadow-lg border border-gray-200 transition-all">
                <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            @endif
            
            <!-- Carousel Wrapper -->
            <div class="hero-carousel overflow-hidden relative flex-1 rounded-2xl">
                <div class="hero-track flex items-center" style="transition: transform 0.7s ease-in-out;">
                    @foreach($heroes as $index => $hero)
                    <div class="hero-slide w-full flex-shrink-0" data-slide="{{ $index }}">
                        <div class="relative mx-auto">
                            @if($hero->image)
                            <img src="{{ asset('storage/' . $hero->image) }}" 
                                 alt="{{ $hero->title ?? 'Hero Image' }}" 
                                 class="w-full h-auto object-cover rounded-2xl"
                                 style="aspect-ratio: 1446/480;">
                            @else
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1920&q=80" 
                                 alt="Hero Image" 
                                 class="w-full h-auto object-cover rounded-2xl"
                                 style="aspect-ratio: 1446/480;">
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            @if($heroes->count() > 1)
            <button class="hero-next flex-shrink-0 bg-white hover:bg-gray-50 text-gray-800 w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center shadow-lg border border-gray-200 transition-all">
                <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            @endif
        </div>
        
        <!-- Dots Indicator -->
        @if($heroes->count() > 1)
        <div class="flex justify-center gap-2.5 mt-6">
            @foreach($heroes as $index => $hero)
            <button class="hero-dot h-2.5 w-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white' : 'bg-gray-400 hover:bg-gray-300' }}" data-slide="{{ $index }}"></button>
            @endforeach
        </div>
        @endif
        
    </div>
    
    @else
    <!-- Fallback - Single Image -->
    <div class="container mx-auto px-4">
        <div class="relative w-full mx-auto" style="max-width: 1400px;">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1920&q=80" 
                 alt="Hero Image" 
                 class="w-full h-auto rounded-2xl shadow-2xl object-cover"
                 style="aspect-ratio: 1446/480;">
        </div>
    </div>
    @endif
    
</section>

<style>
/* Carousel Styles */
.hero-carousel {
    position: relative;
    width: 100%;
}

.hero-track {
    display: flex;
    width: 100%;
}

.hero-slide {
    width: 100%;
    flex-shrink: 0;
}

/* Navigation Button Hover */
.hero-prev:hover,
.hero-next:hover {
    background-color: #f9fafb;
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

.hero-prev:active,
.hero-next:active {
    background-color: #f3f4f6;
    transform: scale(0.95);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-prev,
    .hero-next {
        width: 10px !important;
        height: 40px !important;
    }
    
    .hero-prev svg,
    .hero-next svg {
        width: 20px !important;
        height: 20px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.hero-track');
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    const prevBtn = document.querySelector('.hero-prev');
    const nextBtn = document.querySelector('.hero-next');
    
    if (slides.length <= 1) return;
    
    let currentSlide = 0;
    let autoplayInterval;
    let touchStartX = 0;
    let touchEndX = 0;
    let isTransitioning = false;
    
    function updateCarousel() {
        if (isTransitioning) return;
        isTransitioning = true;
        
        // Simple slide calculation
        const offset = currentSlide * 100;
        track.style.transform = `translateX(-${offset}%)`;
        
        // Update dots
        dots.forEach((dot, index) => {
            if (index === currentSlide) {
                dot.classList.remove('bg-gray-400');
                dot.classList.add('bg-white');
            } else {
                dot.classList.remove('bg-white');
                dot.classList.add('bg-gray-400');
            }
        });
        
        setTimeout(() => {
            isTransitioning = false;
        }, 700);
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateCarousel();
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateCarousel();
    }
    
    function goToSlide(index) {
        currentSlide = index;
        updateCarousel();
    }
    
    function startAutoplay() {
        autoplayInterval = setInterval(nextSlide, 7000);
    }
    
    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }
    
    // Event listeners
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            stopAutoplay();
            nextSlide();
            startAutoplay();
        });
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            stopAutoplay();
            prevSlide();
            startAutoplay();
        });
    }
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            stopAutoplay();
            goToSlide(index);
            startAutoplay();
        });
    });
    
    // Touch/Swipe support
    const carousel = document.querySelector('.hero-carousel');
    if (carousel) {
        carousel.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });
        
        carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const swipeThreshold = 50;
            
            if (touchStartX - touchEndX > swipeThreshold) {
                stopAutoplay();
                nextSlide();
                startAutoplay();
            }
            if (touchEndX - touchStartX > swipeThreshold) {
                stopAutoplay();
                prevSlide();
                startAutoplay();
            }
        });
        
        // Pause on hover
        if (window.innerWidth > 768) {
            carousel.addEventListener('mouseenter', stopAutoplay);
            carousel.addEventListener('mouseleave', startAutoplay);
        }
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            stopAutoplay();
            prevSlide();
            startAutoplay();
        } else if (e.key === 'ArrowRight') {
            stopAutoplay();
            nextSlide();
            startAutoplay();
        }
    });
    
    // Start autoplay
    startAutoplay();
});
</script>

<!-- About Section -->
<section id="tentang" class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <img src="{{ asset('images/tentang_kami_home.png') }}" 
                     alt="Tim Profesional" 
                     class="rounded-2xl shadow-xl">
            </div>
            
            <div>
                <div class="inline-block text-maroon font-semibold mb-4">TENTANG KAMI</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Partner Andal Sertifikasi K3
                    <span class="text-maroon">Tepat, Aman, dan Terpercaya</span>
                </h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    PT Sinarta Multi Jasa Sertifikasi adalah perusahaan penyedia layanan pelatihan dan sertifikasi K3 yang telah dipercaya oleh ratusan perusahaan dan individu di seluruh Indonesia.
                </p>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Dengan instruktur bersertifikat, metode pembelajaran modern, dan fasilitas lengkap, kami berkomitmen menghasilkan tenaga kerja profesional yang kompeten di bidang Keselamatan dan Kesehatan Kerja.
                </p>
                
                <!-- Features -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-start space-x-3">
                        <div class="bg-yellow rounded-lg p-2 mt-1">
                            <svg class="w-5 h-5 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Instruktur Berpengalaman</div>
                            <div class="text-gray-600 text-sm">Tim instruktur profesional dengan sertifikasi nasional dan internasional</div>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="bg-yellow rounded-lg p-2 mt-1">
                            <svg class="w-5 h-5 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Sertifikat Resmi</div>
                            <div class="text-gray-600 text-sm">Sertifikat yang dikeluarkan diakui oleh Kemnaker dan BNSP</div>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="bg-yellow rounded-lg p-2 mt-1">
                            <svg class="w-5 h-5 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Fasilitas Lengkap</div>
                            <div class="text-gray-600 text-sm">Ruang pelatihan modern dengan peralatan praktek yang memadai</div>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('about') }}" class="inline-block bg-maroon text-white px-8 py-3 rounded-lg font-semibold hover:bg-maroon-dark transition">
                    Selengkapnya Tentang Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="layanan" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-4">LAYANAN KAMI</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Program Pelatihan & Sertifikasi
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Kami menyediakan berbagai program pelatihan dan sertifikasi K3 yang disesuaikan dengan kebutuhan industri
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($services as $service)
            <!-- Service Card -->
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition group">
                <div class="w-14 h-14 bg-maroon rounded-lg flex items-center justify-center mb-4 group-hover:bg-yellow transition">
                    <svg class="w-7 h-7 text-white group-hover:text-maroon transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $service->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">
                    {{ Str::limit($service->description, 100) }}
                </p>
                <a href="{{ route('services') }}" class="text-maroon font-semibold text-sm hover:text-yellow transition inline-flex items-center">
                    Selengkapnya
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            @empty
            <!-- Default Services -->
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition group">
                <div class="w-14 h-14 bg-maroon rounded-lg flex items-center justify-center mb-4 group-hover:bg-yellow transition">
                    <svg class="w-7 h-7 text-white group-hover:text-maroon transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Pelatihan AK3 Umum</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Pelatihan Ahli K3 Umum dengan sertifikat Kemnaker untuk meningkatkan kompetensi di bidang K3
                </p>
                <a href="{{ route('services') }}" class="text-maroon font-semibold text-sm hover:text-yellow transition inline-flex items-center">
                    Selengkapnya
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition group">
                <div class="w-14 h-14 bg-maroon rounded-lg flex items-center justify-center mb-4 group-hover:bg-yellow transition">
                    <svg class="w-7 h-7 text-white group-hover:text-maroon transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Sertifikasi BNSP</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Program sertifikasi kompetensi dari Badan Nasional Sertifikasi Profesi sesuai standar SKKNI
                </p>
                <a href="{{ route('services') }}" class="text-maroon font-semibold text-sm hover:text-yellow transition inline-flex items-center">
                    Selengkapnya
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition group">
                <div class="w-14 h-14 bg-maroon rounded-lg flex items-center justify-center mb-4 group-hover:bg-yellow transition">
                    <svg class="w-7 h-7 text-white group-hover:text-maroon transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Perpanjangan SKP</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Layanan perpanjangan dan mutasi Surat Keterangan Pendamping untuk sertifikat K3
                </p>
                <a href="{{ route('services') }}" class="text-maroon font-semibold text-sm hover:text-yellow transition inline-flex items-center">
                    Selengkapnya
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition group">
                <div class="w-14 h-14 bg-maroon rounded-lg flex items-center justify-center mb-4 group-hover:bg-yellow transition">
                    <svg class="w-7 h-7 text-white group-hover:text-maroon transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Pelatihan TOT BNSP</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Training of Trainer untuk menjadi asesor kompetensi BNSP yang profesional dan tersertifikasi
                </p>
                <a href="{{ route('services') }}" class="text-maroon font-semibold text-sm hover:text-yellow transition inline-flex items-center">
                    Selengkapnya
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Programs Section -->
<section id="program" class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-4">PROGRAM PELATIHAN</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Pilih Program yang Sesuai
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Berbagai pilihan program pelatihan dengan jadwal fleksibel dan metode pembelajaran yang efektif
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($programs as $program)
            <!-- Program Card -->
            <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                <div class="relative h-48 overflow-hidden">
                    @if($program->image)
                        <img src="{{ Storage::url($program->image) }}" 
                             alt="{{ $program->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-maroon to-maroon-dark flex items-center justify-center">
                            <svg class="w-16 h-16 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    @endif
                    @if($program->category)
                    <div class="absolute top-4 right-4 bg-yellow text-maroon px-3 py-1 rounded-full text-sm font-bold">
                        {{ $program->category }}
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <div class="text-maroon font-semibold text-sm mb-2">{{ $program->category ?? 'KEMNAKER' }}</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $program->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        {{ Str::limit(strip_tags($program->description), 100) }}
                    </p>
                    <div class="space-y-2 mb-6">
                        @if($program->duration)
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-maroon mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Durasi: {{ $program->duration }}
                        </div>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        @if($program->price)
                        <div>
                            <div class="text-sm text-gray-500">Mulai dari</div>
                            <div class="text-2xl font-bold text-maroon">Rp {{ number_format($program->price, 0, ',', '.') }}</div>
                        </div>
                        @else
                        <div>
                            <div class="text-sm text-gray-500">Hubungi kami</div>
                            <div class="text-lg font-bold text-maroon">Info Harga</div>
                        </div>
                        @endif
                        @if($program->registration_link)
                        <a href="{{ $program->registration_link }}" 
                           target="_blank"
                           class="bg-maroon text-white px-6 py-2 rounded-lg hover:bg-maroon-dark transition font-semibold text-sm">
                            Daftar
                        </a>
                        @else
                        <a href="https://wa.me/6281234567890?text=Halo, saya ingin mendaftar {{ $program->title }}" 
                           target="_blank"
                           class="bg-maroon text-white px-6 py-2 rounded-lg hover:bg-maroon-dark transition font-semibold text-sm">
                            Daftar
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <!-- Default Programs jika database kosong -->
            <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80" 
                         alt="AK3 Umum" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-4 right-4 bg-yellow text-maroon px-3 py-1 rounded-full text-sm font-bold">
                        Populer
                    </div>
                </div>
                <div class="p-6">
                    <div class="text-maroon font-semibold text-sm mb-2">KEMNAKER</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pelatihan AK3 Umum</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Program pelatihan Ahli K3 Umum yang diselenggarakan sesuai standar Kemnaker RI
                    </p>
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 text-maroon mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Durasi: 12 Hari
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm text-gray-500">Mulai dari</div>
                            <div class="text-2xl font-bold text-maroon">Rp 7.5jt</div>
                        </div>
                        <a href="{{ route('programs') }}" class="bg-maroon text-white px-6 py-2 rounded-lg hover:bg-maroon-dark transition font-semibold text-sm">
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('programs') }}" class="inline-block bg-transparent border-2 border-maroon text-maroon px-8 py-3 rounded-lg font-semibold hover:bg-maroon hover:text-white transition">
                Lihat Semua Program
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-20 bg-gradient-to-br from-maroon to-maroon-dark text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Mengapa Memilih <span class="text-yellow">SinartaMJS</span>?
            </h2>
            <p class="text-gray-300 max-w-2xl mx-auto">
                Kami berkomitmen memberikan pelayanan terbaik dengan standar internasional
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Sertifikat Resmi</h3>
                <p class="text-gray-300 text-sm">
                    Diakui Kemnaker RI dan BNSP dengan legalitas terjamin
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Instruktur Profesional</h3>
                <p class="text-gray-300 text-sm">
                    Tim pengajar bersertifikat dengan pengalaman industri
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Fasilitas Lengkap</h3>
                <p class="text-gray-300 text-sm">
                    Ruang pelatihan modern dengan peralatan standar industri
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Dukungan Penuh</h3>
                <p class="text-gray-300 text-sm">
                    Konsultasi gratis dan pendampingan hingga sertifikat terbit
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimoni" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-4">TESTIMONI</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Apa Kata Mereka?
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Pengalaman peserta yang telah mengikuti program pelatihan kami
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials as $testimonial)
            <!-- Testimonial Card -->
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-4">
                    @if($testimonial->avatar)
                        <img src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 bg-maroon rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                        </div>
                    @endif
                    <div class="ml-4">
                        <div class="font-bold text-gray-900">{{ $testimonial->name }}</div>
                        <div class="text-sm text-gray-600">{{ $testimonial->position }}{{ $testimonial->company ? ' - ' . $testimonial->company : '' }}</div>
                    </div>
                </div>
                <div class="flex mb-4">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                    <svg class="w-5 h-5 text-yellow" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm italic">
                    "{{ $testimonial->content }}"
                </p>
            </div>
            @empty
            <!-- Default Testimonials jika database kosong -->
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-maroon rounded-full flex items-center justify-center text-white font-bold">
                        BS
                    </div>
                    <div class="ml-4">
                        <div class="font-bold text-gray-900">Budi Santoso</div>
                        <div class="text-sm text-gray-600">HSE Manager - PT Energi Jaya</div>
                    </div>
                </div>
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5 text-yellow" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm italic">
                    "Pelatihan AK3 Umum di SinartaMJS sangat profesional. Instruktur berpengalaman dan materi sangat aplikatif. Highly recommended!"
                </p>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-maroon rounded-full flex items-center justify-center text-white font-bold">
                        SM
                    </div>
                    <div class="ml-4">
                        <div class="font-bold text-gray-900">Siti Maulida</div>
                        <div class="text-sm text-gray-600">K3 Officer - PT Maju Bersama</div>
                    </div>
                </div>
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5 text-yellow" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm italic">
                    "Proses perpanjangan SKP sangat cepat dan mudah. Staff sangat responsif dan membantu. Pelayanan prima!"
                </p>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-maroon rounded-full flex items-center justify-center text-white font-bold">
                        AP
                    </div>
                    <div class="ml-4">
                        <div class="font-bold text-gray-900">Ahmad Putra</div>
                        <div class="text-sm text-gray-600">Safety Supervisor</div>
                    </div>
                </div>
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5 text-yellow" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm italic">
                    "Fasilitas pelatihan sangat memadai. Materi up to date sesuai regulasi terbaru. Top!"
                </p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Partners Section (Optional) -->
{{-- @if($partners->isNotEmpty())
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-4">PARTNER KAMI</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Dipercaya oleh Perusahaan Terkemuka
            </h2>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center">
            @foreach($partners as $partner)
            <div class="flex items-center justify-center grayscale hover:grayscale-0 transition">
                <img src="{{ Storage::url($partner->logo) }}" 
                     alt="{{ $partner->name }}" 
                     class="h-16 object-contain">
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif --}}

<!-- CTA Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-maroon to-maroon-dark rounded-3xl p-8 md:p-16 text-center text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-64 h-64 bg-yellow rounded-full mix-blend-multiply filter blur-xl"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-yellow rounded-full mix-blend-multiply filter blur-xl"></div>
            </div>
            
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Siap Meningkatkan Kompetensi K3 Anda?
                </h2>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                    Daftar sekarang dan dapatkan konsultasi gratis untuk menentukan program pelatihan yang sesuai dengan kebutuhan Anda
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}" class="bg-yellow text-maroon px-8 py-4 rounded-lg font-bold hover:bg-yellow-light transition inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Hubungi Kami
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-500 text-white px-8 py-4 rounded-lg font-bold hover:bg-green-600 transition inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        Chat WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection