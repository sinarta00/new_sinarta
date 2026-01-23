@extends('layouts.app')

@section('content')

<!-- GANTI HERO SECTION DENGAN INI -->
<section class="relative bg-gradient-to-br from-maroon to-maroon-dark text-white py-20 overflow-hidden gallery-section">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-yellow rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-yellow rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-6xl mx-auto">
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in-up text-center">
                {{ $hero['title'] ?? 'Join as Instructor' }}
            </h1>

            <p class="text-xl md:text-2xl text-gray-200 mb-8 animate-fade-in-up animation-delay-200 text-center">
                {{ $hero['subtitle'] ?? '' }}
            </p>

            <!-- Carousel Gallery -->
            @if($galleryImages && $galleryImages->count() > 0)
            <div class="my-12 overflow-hidden">
                <div class="gallery-scroll-container">
                    <div class="gallery-track">
                        @foreach($galleryImages as $image)
                        <div class="gallery-card">
                            <div class="relative overflow-hidden rounded-2xl shadow-2xl h-80 w-64 group">
                                <img src="{{ $image->image_url }}"
                                     alt="{{ $image->alt_text ?? 'Instruktur SinartaMJS' }}"
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-maroon/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        @endforeach

                        <!-- Duplicate untuk looping halus -->
                        @foreach($galleryImages as $image)
                        <div class="gallery-card">
                            <div class="relative overflow-hidden rounded-2xl shadow-2xl h-80 w-64 group">
                                <img src="{{ $image->image_url }}"
                                     alt="{{ $image->alt_text ?? 'Instruktur SinartaMJS' }}"
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-maroon/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Description -->
            <p class="text-lg text-gray-300 leading-relaxed mb-10 animate-fade-in-up animation-delay-400 text-justify max-w-4xl mx-auto">
                {{ $hero['description'] ?? '' }}
            </p>

            <div class="text-center mt-10 md:mt-12">
            <a href="#form-pendaftaran" 
               onclick="trackClick('instructor', 'Benefits CTA - Daftar');"
               class="inline-flex items-center justify-center bg-maroon text-white px-8 py-3 md:px-10 md:py-4 rounded-xl font-bold text-base md:text-lg hover:bg-maroon-dark transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                <svg class="w-5 h-5 md:w-6 md:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                </svg>
                Daftar Sekarang
            </a>
        </div>
    </div>
        </div>
    </div>
</section>

<style>
/* === BASE GALLERY === */
.gallery-scroll-container {
    width: 100%;
    overflow: hidden;
    position: relative;
    padding: 20px 0;
}

.gallery-track {
    display: flex;
    gap: 1.5rem;
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    will-change: transform;
}

.gallery-card {
    flex-shrink: 0;
    width: 16rem;
}

.gallery-card img {
    transition: transform 0.7s ease;
}
.gallery-card:hover img {
    transform: scale(1.1);
}

.gallery-card > div {
    transition: box-shadow 0.3s ease;
}
.gallery-card:hover > div {
    box-shadow: 0 20px 60px rgba(255, 215, 0, 0.3);
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .gallery-card {
        width: 12rem;
        transform: scale(0.8);
    }
    .gallery-track {
        gap: 1rem;
    }
}

@media (max-width: 430px) {
    .gallery-section {
        transform: scale(0.9);
        transform-origin: top center;
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
    .gallery-card {
        width: 10rem;
        transform: scale(0.75);
    }
    .gallery-track {
        gap: 0.5rem;
    }
    .gallery-section h1 {
        font-size: 1.9rem;
    }
    .gallery-section p {
        font-size: 0.95rem;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const track = document.querySelector(".gallery-track");
    const cards = document.querySelectorAll(".gallery-card");
    if (!track || !cards.length) return;

    const cardWidth = cards[0].offsetWidth + 24; // card + gap
    const totalCards = cards.length / 2; // separuh (karena duplikat)
    let index = 0;

    function slideStep() {
        index++;
        track.style.transition = "transform 1s cubic-bezier(0.4, 0, 0.2, 1)";
        track.style.transform = `translateX(-${index * cardWidth}px)`;

        // Kalau udah mentok, rewind balik ke awal
        if (index >= totalCards) {
            setTimeout(() => {
                // Efek parallax rewind (mundur dikit dulu)
                track.style.transition = "transform 0.6s ease-in-out";
                track.style.transform = `translateX(-${(index * cardWidth) - 150}px)`;

                setTimeout(() => {
                    // Lalu reset ke awal halus
                    track.style.transition = "transform 1s cubic-bezier(0.6, 0, 0.4, 1)";
                    track.style.transform = "translateX(0)";
                    index = 0;
                }, 600);
            }, 1000);
        }
    }

    // Jalankan otomatis tiap 2.5 detik
    setInterval(slideStep, 2500);
});
</script>




<!-- Programs Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Program & <span class="text-maroon">Kegiatan Kami</span>
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Berbagai program pelatihan berkualitas yang telah kami jalankan
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if($programs && is_array($programs))
                @foreach($programs as $index => $program)
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-2xl transition group border-2 border-gray-100 hover:border-maroon">
                    <div class="w-16 h-16 bg-maroon rounded-lg flex items-center justify-center mb-6 group-hover:bg-yellow transition">
                        <svg class="w-8 h-8 text-white group-hover:text-maroon transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $program['title'] ?? '' }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $program['description'] ?? '' }}</p>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Apa yang <span class="text-maroon">Anda Dapatkan?</span>
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Benefit dan keuntungan menjadi instruktur di SinartaMJS
            </p>
        </div>
        
        <div class="max-w-6xl mx-auto space-y-6 md:space-y-8">
            @if($benefits && is_array($benefits))
                @foreach($benefits as $index => $benefit)
                <div class="bg-gradient-to-r from-gray-50 to-white rounded-2xl p-6 md:p-8 shadow-lg hover:shadow-xl transition border-l-4 border-maroon">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-maroon rounded-lg flex items-center justify-center text-white font-bold text-lg md:text-xl">
                                {{ $index + 1 }}
                            </div>
                        </div>
                        <div class="ml-4 md:ml-6">
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3">{{ $benefit['title'] ?? '' }}</h3>
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed">{{ $benefit['description'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <br>
        <div class="text-center mt-10 md:mt-12">
            <a href="#form-pendaftaran" 
               onclick="trackClick('instructor', 'Benefits CTA - Daftar');"
               class="inline-flex items-center justify-center bg-maroon text-white px-8 py-3 md:px-10 md:py-4 rounded-xl font-bold text-base md:text-lg hover:bg-maroon-dark transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                <svg class="w-5 h-5 md:w-6 md:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                </svg>
                Daftar Sekarang
            </a>
        </div>
    </div>
    <br>
</section>

<!-- Form Section -->
<section id="form-pendaftaran" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10 md:mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Formulir <span class="text-maroon">Pendaftaran</span>
                </h2>
                <p class="text-gray-600">
                    Lengkapi data diri Anda untuk bergabung sebagai instruktur
                </p>
            </div>

            @if(session('success'))
            <!-- Success Popup -->
            <div id="successPopup" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl max-w-md w-full p-8 shadow-2xl animate-fade-in-up">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Terima Kasih!</h3>
                        <p class="text-gray-600 mb-6">
                            Terima kasih telah mendaftar sebagai instruktur. Data Anda sudah kami terima. Untuk pertanyaan lebih lanjut atau update cepat, silakan hubungi tim kami melalui WhatsApp.
                        </p>
                        @if($contact && isset($contact['whatsapp']))
                        <a href="https://wa.me/{{ $contact['whatsapp'] }}" 
                           target="_blank"
                           class="inline-block bg-green-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-green-600 transition mb-4 w-full">
                            <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            Hubungi via WhatsApp
                        </a>
                        @endif
                        <button onclick="closePopup()" class="block w-full bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-bold hover:bg-gray-300 transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 p-6 mb-8 rounded-r-lg">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="font-bold text-red-800 mb-2">Terjadi Kesalahan:</p>
                        <ul class="list-disc list-inside text-red-700">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('instructor.store') }}" method="POST" enctype="multipart/form-data" id="instructorForm" class="bg-white rounded-2xl p-6 md:p-12 shadow-xl">
                @csrf
                
                <!-- Data Diri -->
                <div class="mb-8 md:mb-10">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-6 flex items-center">
                        <div class="w-8 h-8 md:w-10 md:h-10 bg-maroon rounded-lg flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm md:text-base">1</span>
                        </div>
                        Data Diri
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-4 md:gap-6">
                        <div class="md:col-span-2">
                            <label for="full_name" class="block text-sm font-semibold text-gray-900 mb-2">
                                Nama Lengkap + Gelar <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="full_name" name="full_name" required
                                   value="{{ old('full_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition"
                                   placeholder="contoh: Dr. Ahmad Yani, S.T., M.K3">
                            @error('full_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-semibold text-gray-900 mb-2">
                                Kota Domisili <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="city" name="city" required
                                   value="{{ old('city') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition"
                                   placeholder="Balikpapan">
                            @error('city')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="whatsapp" class="block text-sm font-semibold text-gray-900 mb-2">
                                Nomor WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="whatsapp" name="whatsapp" required
                                   value="{{ old('whatsapp') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition"
                                   placeholder="08xx-xxxx-xxxx">
                            @error('whatsapp')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition"
                                   placeholder="email@contoh.com">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Bidang Keahlian -->
                <div class="mb-8 md:mb-10">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-6 flex items-center">
                        <div class="w-8 h-8 md:w-10 md:h-10 bg-maroon rounded-lg flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm md:text-base">2</span>
                        </div>
                        Bidang Keahlian
                    </h3>
                    
                    <div class="space-y-4">
                        <p class="text-sm text-gray-600 mb-4">Pilih bidang keahlian/topik yang Anda kuasai (bisa lebih dari 1) <span class="text-red-500">*</span></p>
                        
                        <div class="space-y-2 md:space-y-3">
                            @php
                            $expertiseFields = [
                                'K3 Pesawat Uap dan Bejana Tekan',
                                'K3 Mekanik',
                                'K3 Listrik',
                                'K3 Kebakaran',
                                'K3 Bahan Berbahaya',
                                'K3 Lingkungan Kerja',
                                'K3 Kesehatan Kerja dan Pelayanan Kesehatan Kerja',
                                'Manajemen Risiko',
                                'Analisa Kecelakaan & Laporan Kecelakaan Kerja',
                                'SMK3',
                                'K3 Pertambangan',
                                'K3 Migas',
                            ];
                            @endphp
                            
                            @foreach($expertiseFields as $field)
                            <label class="flex items-start p-4 bg-white border-2 border-gray-200 rounded-xl hover:border-maroon hover:bg-gray-50 cursor-pointer transition-all duration-200 group shadow-sm hover:shadow-md">
                                <input type="checkbox" 
                                       name="expertise_fields[]" 
                                       value="{{ $field }}"
                                       {{ is_array(old('expertise_fields')) && in_array($field, old('expertise_fields')) ? 'checked' : '' }}
                                       class="mt-0.5 flex-shrink-0">
                                <span class="ml-3 text-sm md:text-base text-gray-700 group-hover:text-maroon transition leading-relaxed">{{ $field }}</span>
                            </label>
                            @endforeach
                            
                            <!-- Topik Lainnya -->
                            <label class="flex items-start p-4 bg-white border-2 border-gray-200 rounded-xl hover:border-maroon hover:bg-gray-50 cursor-pointer transition-all duration-200 group shadow-sm hover:shadow-md">
                                <input type="checkbox" 
                                       id="other_expertise_check"
                                       name="expertise_fields[]" 
                                       value="Topik Lainnya"
                                       {{ is_array(old('expertise_fields')) && in_array('Topik Lainnya', old('expertise_fields')) ? 'checked' : '' }}
                                       class="mt-0.5 flex-shrink-0"
                                       onchange="toggleOtherExpertise()">
                                <span class="ml-3 text-sm md:text-base text-gray-700 font-semibold group-hover:text-maroon transition leading-relaxed">Topik Lainnya (sebutkan)</span>
                            </label>
                        </div>
                        
                        <!-- Input Topik Lainnya -->
                        <div id="other_expertise_input" class="hidden mt-3">
                            <input type="text" 
                                   name="other_expertise" 
                                   value="{{ old('other_expertise') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition"
                                   placeholder="Sebutkan topik keahlian lainnya...">
                        </div>
                        
                        @error('expertise_fields')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Upload Dokumen -->
                <div class="mb-8 md:mb-10">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-6 flex items-center">
                        <div class="w-8 h-8 md:w-10 md:h-10 bg-maroon rounded-lg flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm md:text-base">3</span>
                        </div>
                        Upload Dokumen
                    </h3>
                    
                    <div class="space-y-6">
                        <!-- CV -->
                        <div>
                            <label for="cv_file" class="block text-sm font-semibold text-gray-900 mb-2">
                                CV (PDF) <span class="text-red-500">*</span>
                            </label>
                            <input type="file" 
                                   id="cv_file" 
                                   name="cv_file" 
                                   accept=".pdf" 
                                   required
                                   class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-maroon file:text-white file:text-sm file:font-medium hover:file:bg-maroon-dark cursor-pointer">
                            <p class="text-xs md:text-sm text-gray-500 mt-2">Format: PDF, Maksimal 5MB</p>
                            @error('cv_file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- TAMBAHAN INPUT IJAZAH -->
                        <div>
                            <label for="diploma_file" class="block text-sm font-semibold text-gray-900 mb-2">
                                Ijazah Terakhir (PDF) <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="file" 
                                class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-maroon file:text-white file:text-sm file:font-medium hover:file:bg-maroon-dark cursor-pointer" 
                                id="diploma_file" 
                                name="diploma_file" 
                                accept=".pdf,.jpg,.jpeg,.png"
                                required
                            >
                            <small class="form-text text-muted">Format: PDF/JPG/PNG, Maksimal 5MB</small>
                            @error('diploma_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sertifikat Multiple -->
                        <div>
                            <label for="certificate_files" class="block text-sm font-semibold text-gray-900 mb-2">
                                Sertifikat (PDF/JPG/PNG) <span class="text-red-500">*</span>
                            </label>
                            <input type="file" 
                                   id="certificate_files" 
                                   name="certificate_files[]" 
                                   accept=".pdf,.jpg,.jpeg,.png" 
                                   multiple
                                   required
                                   class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-maroon transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-maroon file:text-white file:text-sm file:font-medium hover:file:bg-maroon-dark cursor-pointer">
                            <p class="text-xs md:text-sm text-gray-500 mt-2">Format: PDF/JPG/PNG, Maksimal 5MB per file. Anda bisa upload multiple files</p>
                            @error('certificate_files')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Kesediaan -->
                <div class="mb-8 md:mb-10">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-6 flex items-center">
                        <div class="w-8 h-8 md:w-10 md:h-10 bg-maroon rounded-lg flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm md:text-base">4</span>
                        </div>
                        Kesediaan Mengajar
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">Pilihan bisa lebih dari 1 <span class="text-red-500">*</span></p>
                    <!-- Waktu -->
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-900 mb-3">Waktu <span class="text-red-500">*</span></p>
                        <div class="flex flex-wrap gap-3 md:gap-4">
                            <label class="flex items-center px-6 py-4 bg-white border-2 border-gray-200 rounded-xl hover:border-maroon hover:bg-gray-50 cursor-pointer transition-all duration-200 group shadow-sm hover:shadow-md">
                                <input type="checkbox"
                                       name="availability_time[]"
                                       value="weekday"
                                       {{ is_array(old('availability_time')) && in_array('weekday', old('availability_time')) ? 'checked' : '' }}
                                       class="flex-shrink-0">
                                <span class="ml-3 text-sm md:text-base text-gray-700 font-medium group-hover:text-maroon transition">Weekday</span>
                            </label>
                            <label class="flex items-center px-6 py-4 bg-white border-2 border-gray-200 rounded-xl hover:border-maroon hover:bg-gray-50 cursor-pointer transition-all duration-200 group shadow-sm hover:shadow-md">
                                <input type="checkbox"
                                       name="availability_time[]"
                                       value="weekend"
                                       {{ is_array(old('availability_time')) && in_array('weekend', old('availability_time')) ? 'checked' : '' }}
                                       class="flex-shrink-0">
                                <span class="ml-3 text-sm md:text-base text-gray-700 font-medium group-hover:text-maroon transition">Weekend</span>
                            </label>
                        </div>
                        @error('availability_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Program -->
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-3">Program yang Diminati <span class="text-red-500">*</span></p>
                        <div class="space-y-2 md:space-y-3">
                            @php
                            $availablePrograms = [
                                'Pelatihan Sertifikasi Kemnaker RI',
                                'Pelatihan Kompetensi BNSP RI',
                                'Pelatihan Teknis & Spesialisasi',
                                'Pelatihan Inhouse dan Sesuai Kebutuhan Perusahaan',
                                'Miniclass',
                                'Sinartalks',
                            ];
                            @endphp
                            
                            @foreach($availablePrograms as $program)
                            <label class="flex items-start p-4 bg-white border-2 border-gray-200 rounded-xl hover:border-maroon hover:bg-gray-50 cursor-pointer transition-all duration-200 group shadow-sm hover:shadow-md">
                                <input type="checkbox" 
                                       name="availability_programs[]" 
                                       value="{{ $program }}"
                                       {{ is_array(old('availability_programs')) && in_array($program, old('availability_programs')) ? 'checked' : '' }}
                                       class="mt-0.5 flex-shrink-0">
                                <span class="ml-3 text-sm md:text-base text-gray-700 group-hover:text-maroon transition leading-relaxed">{{ $program }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('availability_programs')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Motivasi -->
                <div class="mb-8 md:mb-10">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-6 flex items-center">
                        <div class="w-8 h-8 md:w-10 md:h-10 bg-maroon rounded-lg flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-sm md:text-base">5</span>
                        </div>
                        Motivasi
                    </h3>
                    
                    <div>
                        <label for="motivation" class="block text-sm font-semibold text-gray-900 mb-2">
                            Mengapa tertarik menjadi instruktur di Sinarta? <span class="text-red-500">*</span>
                        </label>
                        <textarea id="motivation" 
                                  name="motivation" 
                                  rows="6" 
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition text-sm md:text-base"
                                  placeholder="Ceritakan motivasi dan alasan Anda ingin bergabung sebagai instruktur di SinartaMJS...">{{ old('motivation') }}</textarea>
                        <p class="text-xs md:text-sm text-gray-500 mt-2">Maksimal 2000 karakter</p>
                        @error('motivation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="border-t pt-6 md:pt-8">
                    <button type="submit" 
                            id="submitBtn"
                            class="w-full bg-maroon text-white px-6 py-3 md:px-8 md:py-4 rounded-xl font-bold text-base md:text-lg hover:bg-maroon-dark transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-[1.02] flex items-center justify-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span id="btnText">Kirim Pendaftaran</span>
                    </button>
                    
                    <!-- reCAPTCHA Badge Info -->
                    <p class="text-xs text-gray-500 text-center mt-4">
                        This site is protected by reCAPTCHA and the Google
                        <a href="https://policies.google.com/privacy" class="text-maroon underline" target="_blank">Privacy Policy</a> and
                        <a href="https://policies.google.com/terms" class="text-maroon underline" target="_blank">Terms of Service</a> apply.
                    </p>
                </div>
            </form>

            <!-- Help Section -->
            @if($contact)
            <div class="mt-6 md:mt-8 text-center p-4 md:p-6 bg-white rounded-xl shadow-lg border-2 border-gray-100">
                <p class="text-sm md:text-base text-gray-700 mb-3 md:mb-4 font-semibold">
                    {{ $contact['help_text'] ?? 'Kesulitan daftar? Hubungi admin kami' }}
                </p>
                <a href="https://wa.me/{{ $contact['whatsapp'] ?? '' }}" 
                   target="_blank"
                   onclick="trackClick('instructor', 'Contact WhatsApp');"
                   class="inline-flex items-center justify-center text-white bg-green-500 hover:bg-green-600 px-6 py-3 rounded-lg font-semibold transition shadow-lg hover:shadow-xl text-sm md:text-base">
                    <svg class="w-5 h-5 md:w-6 md:h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    {{ $contact['contact_name'] ?? 'Admin Sinarta' }}
                </a>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Google reCAPTCHA v3 Script -->
<script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
<script>
// Toggle Other Expertise Input
function toggleOtherExpertise() {
    const checkbox = document.getElementById('other_expertise_check');
    const input = document.getElementById('other_expertise_input');
    
    if (checkbox && input) {
        if (checkbox.checked) {
            input.classList.remove('hidden');
        } else {
            input.classList.add('hidden');
        }
    }
}

// Check on page load (for old input)
document.addEventListener('DOMContentLoaded', function() {
    toggleOtherExpertise();
});

// Form Submit with reCAPTCHA
document.getElementById('instructorForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    
    // Disable button & show loading
    submitBtn.disabled = true;
    btnText.innerHTML = '<svg class="animate-spin h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Mengirim...';
    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
    
    // Execute reCAPTCHA
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {action: 'instructor_application'}).then(function(token) {
            // Add token to form
            const form = document.getElementById('instructorForm');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'recaptcha_token';
            input.value = token;
            form.appendChild(input);
            
            // Track click analytics
            if (typeof trackClick === 'function') {
                trackClick('instructor_form', 'Submit Application');
            }
            
            // Submit form
            form.submit();
        }).catch(function(error) {
            alert('reCAPTCHA error. Silakan coba lagi.');
            submitBtn.disabled = false;
            btnText.innerHTML = '<svg class="w-5 h-5 md:w-6 md:h-6 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Kirim Pendaftaran';
            submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
        });
    });
});

// Close Success Popup
function closePopup() {
    const popup = document.getElementById('successPopup');
    if (popup) {
        popup.style.opacity = '0';
        setTimeout(() => {
            popup.style.display = 'none';
        }, 300);
    }
}

// File upload preview
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function(e) {
        const files = e.target.files;
        if (files.length > 0) {
            const maxSize = 5 * 1024 * 1024; // 5MB
            
            // Check each file size
            for (let i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    alert('Ukuran file "' + files[i].name + '" terlalu besar! Maksimal 5MB');
                    e.target.value = '';
                    return;
                }
            }
        }
    });
});

// Smooth scroll to form
document.querySelectorAll('a[href="#form-pendaftaran"]').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.getElementById('form-pendaftaran');
        if (target) {
            const offsetTop = target.offsetTop - 100;
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    });
});
</script>

<style>
@keyframes blob {
    0%, 100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.animation-delay-600 {
    animation-delay: 0.6s;
}

/* Custom checkbox styling - Enhanced */
input[type="checkbox"] {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid #d1d5db;
    border-radius: 0.25rem;
    background-color: white;
    cursor: pointer;
    position: relative;
    transition: all 0.2s ease;
}

input[type="checkbox"]:hover {
    border-color: #800020;
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.1);
}

input[type="checkbox"]:checked {
    background-color: #800020;
    border-color: #800020;
}

input[type="checkbox"]:checked::after {
    content: '';
    position: absolute;
    left: 5px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

input[type="checkbox"]:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.2);
}

input[type="checkbox"]:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>

@endsection