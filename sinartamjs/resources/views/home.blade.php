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
<section class="relative bg-maroon text-white overflow-hidden min-h-screen flex items-center">
    
    <!-- Background Decoration -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-yellow rounded-full blur-3xl"></div>
    </div>
    
    @if($heroes->isNotEmpty())
    <div class="relative z-10 w-full py-12 md:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Carousel Container -->
            <div class="hero-carousel-wrapper relative">
                <div class="hero-carousel">
                    @foreach($heroes as $index => $hero)
                    <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                            
                            <!-- Left Content -->
                            <div class="space-y-4 md:space-y-6">
                                
                                <!-- Badge -->
                                <div>
                                    <span class="inline-flex items-center gap-2 bg-yellow text-maroon px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Terpercaya & Bersertifikat Resmi
                                    </span>
                                </div>
                                
                                <!-- Title -->
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight">
                                    {{ $hero->title }}
                                </h1>
                                
                                <!-- Subtitle -->
                                <p class="text-base md:text-lg text-gray-200 leading-relaxed">
                                    {{ $hero->subtitle }}
                                </p>
                                
                                <!-- CTA Buttons -->
                                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                                    @if($hero->button_text && $hero->button_link)
                                    <a href="{{ $hero->button_link }}" class="inline-block bg-yellow text-maroon px-6 md:px-8 py-3 rounded-lg font-semibold hover:bg-yellow-light transition text-center shadow-lg">
                                        {{ $hero->button_text }}
                                    </a>
                                    @endif
                                    <a href="{{ route('contact') }}" class="inline-block bg-transparent border-2 border-white text-white px-6 md:px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-maroon transition text-center">
                                        Konsultasi Gratis
                                    </a>
                                </div>
                                
                                <!-- Stats -->
                                <div class="grid grid-cols-3 gap-4 pt-4">
                                    <div>
                                        <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-yellow">500+</div>
                                        <div class="text-xs md:text-sm text-gray-300 mt-1">Peserta Terlatih</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-yellow">98%</div>
                                        <div class="text-xs md:text-sm text-gray-300 mt-1">Tingkat Kelulusan</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-yellow">50+</div>
                                        <div class="text-xs md:text-sm text-gray-300 mt-1">Perusahaan Partner</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Image -->
                            <div class="relative hidden lg:block">
                                <!-- Yellow Card Background - Behind Image -->
                                <div class="absolute bottom-0 -right-6 w-full h-3/4 bg-yellow rounded-2xl"></div>
                                
                                <!-- Image - In Front -->
                                <div class="relative z-10">
                                    @if($hero->image)
                                    <img src="{{ Storage::url($hero->image) }}" 
                                         alt="{{ $hero->title }}" 
                                         class="rounded-2xl shadow-2xl w-full object-cover">
                                    @else
                                    <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=800&q=80" 
                                         alt="Pelatihan K3" 
                                         class="rounded-2xl shadow-2xl w-full h-[450px] object-cover">
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Navigation Arrows -->
                @if($heroes->count() > 1)
                <button class="hero-prev absolute left-0 lg:-left-4 xl:left-0 top-1/2 -translate-y-1/2 z-30 bg-white/20 backdrop-blur-sm hover:bg-yellow text-white hover:text-maroon w-10 h-10 md:w-12 md:h-12 rounded-full transition-all flex items-center justify-center">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="hero-next absolute right-0 lg:-right-4 xl:right-0 top-1/2 -translate-y-1/2 z-30 bg-white/20 backdrop-blur-sm hover:bg-yellow text-white hover:text-maroon w-10 h-10 md:w-12 md:h-12 rounded-full transition-all flex items-center justify-center">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                @endif
            </div>
            
            <!-- Dots Indicator -->
            @if($heroes->count() > 1)
            <div class="flex justify-center gap-2 mt-8">
                @foreach($heroes as $index => $hero)
                <button class="hero-dot h-2 md:h-2.5 rounded-full transition-all {{ $index === 0 ? 'w-8 md:w-10 bg-yellow' : 'w-2 md:w-2.5 bg-white/40 hover:bg-white/60' }}" data-slide="{{ $index }}"></button>
                @endforeach
            </div>
            @endif
            
        </div>
    </div>
    
    @else
    <!-- Fallback -->
    <div class="relative z-10 w-full py-12 md:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                
                <div class="space-y-4 md:space-y-6">
                    <div>
                        <span class="inline-flex items-center gap-2 bg-yellow text-maroon px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Terpercaya & Bersertifikat Resmi
                        </span>
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight">
                        Pelatihan & Sertifikasi <span class="text-yellow">K3 Profesional</span>
                    </h1>
                    
                    <p class="text-base md:text-lg text-gray-200 leading-relaxed">
                        PT Sinarta Multi Jasa Sertifikasi menyediakan pelatihan AK3 Umum Kemnaker, BNSP, Perpanjangan SKP, dan TOT BNSP dengan instruktur berpengalaman dan fasilitas terbaik.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        <a href="{{ route('programs') }}" class="inline-block bg-yellow text-maroon px-6 md:px-8 py-3 rounded-lg font-semibold hover:bg-yellow-light transition text-center shadow-lg">
                            Lihat Program Pelatihan
                        </a>
                        <a href="{{ route('contact') }}" class="inline-block bg-transparent border-2 border-white text-white px-6 md:px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-maroon transition text-center">
                            Konsultasi Gratis
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4 pt-4">
                        <div>
                            <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-yellow">500+</div>
                            <div class="text-xs md:text-sm text-gray-300 mt-1">Peserta Terlatih</div>
                        </div>
                        <div>
                            <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-yellow">98%</div>
                            <div class="text-xs md:text-sm text-gray-300 mt-1">Tingkat Kelulusan</div>
                        </div>
                        <div>
                            <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-yellow">50+</div>
                            <div class="text-xs md:text-sm text-gray-300 mt-1">Perusahaan Partner</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative hidden lg:block">
                    <!-- Yellow Card Background - Behind Image -->
                    <div class="absolute bottom-0 -right-6 w-full h-3/4 bg-yellow rounded-2xl"></div>
                    
                    <!-- Image - In Front -->
                    <div class="relative z-10">
                        <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=800&q=80" 
                             alt="Pelatihan K3" 
                             class="rounded-2xl shadow-2xl w-full h-[450px] object-cover">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endif
    
</section>

<style>
.hero-carousel-wrapper {
    position: relative;
}

.hero-slide {
    display: none;
    opacity: 0;
}

.hero-slide.active {
    display: block;
    animation: smoothFadeIn 1s ease-in-out forwards;
}

@keyframes smoothFadeIn {
    0% {
        opacity: 0;
        transform: translateX(30px) scale(0.98);
    }
    100% {
        opacity: 1;
        transform: translateX(0) scale(1);
    }
}

/* Smooth transition untuk semua elemen */
.hero-slide * {
    transition: all 0.3s ease-in-out;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
    
    function showSlide(index) {
        if (isTransitioning) return;
        isTransitioning = true;
        
        slides.forEach(s => s.classList.remove('active'));
        dots.forEach(d => {
            d.classList.remove('w-8', 'md:w-10', 'bg-yellow');
            d.classList.add('w-2', 'md:w-2.5', 'bg-white/40');
        });
        
        slides[index].classList.add('active');
        dots[index].classList.remove('w-2', 'md:w-2.5', 'bg-white/40');
        dots[index].classList.add('w-8', 'md:w-10', 'bg-yellow');
        
        setTimeout(() => {
            isTransitioning = false;
        }, 1000);
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }
    
    function startAutoplay() {
        autoplayInterval = setInterval(nextSlide, 5000);
    }
    
    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }
    
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
            currentSlide = index;
            showSlide(currentSlide);
            startAutoplay();
        });
    });
    
    const carousel = document.querySelector('.hero-carousel');
    if (carousel) {
        carousel.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });
        
        carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            if (touchStartX - touchEndX > 50) {
                stopAutoplay();
                nextSlide();
                startAutoplay();
            }
            if (touchEndX - touchStartX > 50) {
                stopAutoplay();
                prevSlide();
                startAutoplay();
            }
        });
        
        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('mouseleave', startAutoplay);
    }
    
    startAutoplay();
});
</script>

<!-- About Section -->
<section id="tentang" class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80" 
                     alt="Tim Profesional" 
                     class="rounded-2xl shadow-xl">
            </div>
            
            <div>
                <div class="inline-block text-maroon font-semibold mb-4">TENTANG KAMI</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    Mitra Terpercaya untuk 
                    <span class="text-maroon">Sertifikasi K3 Anda</span>
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
@if($partners->isNotEmpty())
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
@endif

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

<!-- Contact Section -->
<section id="kontak" class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-4">HUBUNGI KAMI</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Mari Berdiskusi
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Tim kami siap membantu Anda menemukan program pelatihan yang tepat
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div>
                <div class="bg-gray-50 rounded-2xl p-8 shadow-lg mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 mb-1">Alamat</div>
                                <p class="text-gray-600">
                                    Jl. Contoh No. 123<br>
                                    Balikpapan, Kalimantan Timur<br>
                                    Indonesia 76114
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 mb-1">Telepon</div>
                                <p class="text-gray-600">
                                    +62 812-3456-7890<br>
                                    +62 541-123456
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 mb-1">Email</div>
                                <p class="text-gray-600">
                                    info@sinartamjs.com<br>
                                    pelatihan@sinartamjs.com
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 mb-1">Jam Operasional</div>
                                <p class="text-gray-600">
                                    Senin - Jumat: 08.00 - 17.00 WITA<br>
                                    Sabtu: 08.00 - 12.00 WITA<br>
                                    Minggu & Libur: Tutup
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="bg-gray-50 rounded-2xl p-8 shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center hover:bg-maroon-dark transition">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center hover:bg-maroon-dark transition">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center hover:bg-maroon-dark transition">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center hover:bg-green-600 transition">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="bg-gray-50 rounded-2xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
                @endif
                
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition"
                               value="{{ old('name') }}">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Email</label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition"
                               value="{{ old('email') }}">
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-900 mb-2">No. Telepon</label>
                        <input type="tel" id="phone" name="phone" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition"
                               value="{{ old('phone') }}">
                        @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="program" class="block text-sm font-semibold text-gray-900 mb-2">Program yang Diminati</label>
                        <select id="program" name="program"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition">
                            <option value="">Pilih Program</option>
                            <option value="ak3" {{ old('program') == 'ak3' ? 'selected' : '' }}>Pelatihan AK3 Umum</option>
                            <option value="bnsp" {{ old('program') == 'bnsp' ? 'selected' : '' }}>Sertifikasi BNSP</option>
                            <option value="skp" {{ old('program') == 'skp' ? 'selected' : '' }}>Perpanjangan SKP</option>
                            <option value="tot" {{ old('program') == 'tot' ? 'selected' : '' }}>Training of Trainer</option>
                            <option value="other" {{ old('program') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-900 mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="4" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-maroon text-white px-6 py-4 rounded-lg font-bold hover:bg-maroon-dark transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection