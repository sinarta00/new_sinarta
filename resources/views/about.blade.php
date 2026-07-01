@extends('layouts.app')

@section('content')
{{-- Tambahkan di dalam @section('content') paling atas atau di layout --}}

<style>
/* ── Base state: semua elemen animasi dimulai dari invisible ── */
[data-animate] {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

[data-animate="fade-left"] {
    transform: translateX(-28px);
}

[data-animate="fade-right"] {
    transform: translateX(28px);
}

[data-animate="fade-up"] {
    transform: translateY(32px);
}

/* ── Visible state ── */
[data-animate].is-visible {
    opacity: 1;
    transform: translate(0, 0);
}

/* ── Staggered delay untuk children dalam grid ── */
[data-animate-group] > *:nth-child(1) { transition-delay: 0s; }
[data-animate-group] > *:nth-child(2) { transition-delay: 0.1s; }
[data-animate-group] > *:nth-child(3) { transition-delay: 0.2s; }
[data-animate-group] > *:nth-child(4) { transition-delay: 0.3s; }
[data-animate-group] > *:nth-child(5) { transition-delay: 0.4s; }
[data-animate-group] > *:nth-child(6) { transition-delay: 0.5s; }

[data-animate-group] > * {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

[data-animate-group].is-visible > * {
    opacity: 1;
    transform: translateY(0);
}
</style>

<!-- Company Profile -->
<section class="py-8 -mt-2 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1" data-animate="fade-left">
                <div class="inline-block text-maroon font-semibold mb-4">PROFIL PERUSAHAAN</div>
                <h2 class="text-3xl md:text-2xl font-bold text-gray-900 mb-6">
                    Mitra Terpercaya untuk Sertifikasi K3
                </h2>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    PT Sinarta Multi Jasa Sertifikasi (SinartaMJS) adalah perusahaan penyedia layanan pelatihan dan sertifikasi K3 (Keselamatan dan Kesehatan Kerja) yang telah berpengalaman melayani berbagai sektor industri di Indonesia.
                </p>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Kami berkomitmen untuk menghasilkan tenaga kerja profesional yang kompeten di bidang K3 melalui program pelatihan berkualitas dengan instruktur bersertifikat dan fasilitas modern.
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Dengan legalitas resmi dari Kementerian Ketenagakerjaan RI dan BNSP (Badan Nasional Sertifikasi Profesi), kami telah dipercaya oleh ratusan perusahaan dan ribuan peserta individu untuk meningkatkan kompetensi K3 mereka.
                </p>
                
                <div class="bg-yellow/10 border-l-4 border-yellow p-6 rounded-r-lg">
                    <p class="text-gray-700 italic">
                        "Membangun budaya K3 yang kuat dimulai dari SDM yang kompeten dan tersertifikasi"
                    </p>
                </div>
            </div>
            
            <div class="relative order-1 lg:order-2" data-animate="fade-right">
                <img src="{{ asset('images/foto_profile.png') }}"
                     alt="Tim SinartaMJS" 
                     class="rounded-2xl shadow-2xl">
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi -->
<section class="">
    <div class="width-full">

        <!-- Visi -->
        <div class="bg-maroon px-5 lg:px-10 py-8 sm:py-12 text-center" data-animate="fade-up">
            <h2 class="text-white text-xl md:text-2xl font-bold tracking-widest mb-4">
                VISI
            </h2>

            <p class="text-white text-xs md:text-lg leading-relaxed max-w-4xl mx-auto font-semibold align-middle capitalize">
               Menjadi lembaga pelatihan dan sertifikasi K3 terpercaya dan terdepan di Indonesia yang berkontribusi dalam menciptakan lingkungan kerja yang aman, sehat, dan produktif.
            </p>
        </div>

        <!-- Misi -->
        <div style="background-color: #FFFAFA" class="bg-white rounded-b-2xl border border-t-0 border-gray-200 px-5 sm:px-8 lg:px-10 py-8 sm:py-12 flex justify-center flex-col"  data-animate="fade-up">
            <h2 class="text-gray-900 text-xl md:text-2xl font-bold tracking-widest text-center mb-6 sm:mb-8">
                MISI
            </h2>

            <ul class="space-y-4 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                @foreach ([
                    'Menyelenggarakan pelatihan K3 berkualitas dengan standar nasional',
                    'Mengembangkan kompetensi SDM di bidang K3 secara berkalanjutan',
                    'Memberikan pelayanan terbaik dengan harga kompetitif',
                    'Mengutamakan dan Berorientasi pada kepuasan peserta',
                    'Menyiapkan instruktur instruktur yang kompeten di bidangnya',
                    'Menciptakan lingkungan pelayanan yang kondusif, nyaman, dan aman',
                ] as $misi)

                <li class="flex gap-2 text-gray-800 leading-relaxed items-center">
                    <svg class="w-4 h-4 md:w-6 md:h-6 mt-0.5" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="#6B1A2B" stroke-width="1.8"/>
                        <path d="M7.5 12.5l3 3 5.5-6" stroke="#6B1A2B" stroke-width="1.8"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <p class="text-xs md:text-xl">{{ $misi }}</p>
                </li>
                @endforeach
            </ul>
        </div>

    </div>
</section>

<!-- Profil Dewan Direksi -->
<section class="py-6 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-maroon">
                Profil Dewan Direksi
            </h2>
        </div>

        <div class="flex flex-wrap justify-center gap-8" data-animate="fade-up">
            <!-- Direktur Utama -->
            <div class="flex flex-col items-start">
                <img src="{{ asset('images/telent_1.png') }}"
                     alt="DR. IR. HJ. Rosmiati, S.T, M.T., IPM"
                     class="w-64 h-80 object-cover rounded bg-gray-300">
                <p class="mt-3 font-bold text-gray-700 text-sm">DR. IR. HJ. Rosmiati, S.T, M.T., IPM</p>
                <p class="text-gray-500 text-sm">Direktur Utama</p>
            </div>
        </div>
    </div>
</section>

{{-- Struktur Organisasi --}}
<section class="py-20" style="background-color: #FFFAFA">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-animate="fade-up">
            <div class="text-3xl  inline-block text-maroon font-bold mb-4">STRUKTUR ORGANISASI</div>
        </div>

        <div class="flex justify-center overflow-x-auto pb-4" data-animate="fade-up">
            <div class="flex flex-col items-center min-w-max px-4">
                @foreach($orgTree as $root)
                    <x-org-node :node="$root" />
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Company Profile PDF -->
<section class="py-12 bg-white">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-maroon">
                PT Sinarta Multi Jasa Sertifikasi
            </h2>

            <p class="font-semibold italic">
                "Boost Your Skills With Sinarta"
            </p>

            <p class="text-gray-600 mt-2">
                Company Profile
            </p>
        </div>

        <div class="mx-full overflow-hidden">
            <iframe
                src="{{ asset('files/Company_Profile_2026.pdf') }}"
                class="w-[70%] h-[900px] mx-auto border-0"
                type="application/pdf">
            </iframe>
        </div>

    </div>
</section>


<!-- Values -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-4">NILAI-NILAI KAMI</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Komitmen Kami
            </h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" data-animate-group>
            <div class="text-center">
                <div class="w-20 h-20 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Profesional</h3>
                <p class="text-gray-600 text-sm">
                    Menjunjung tinggi profesionalisme dalam setiap aspek layanan
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Integritas</h3>
                <p class="text-gray-600 text-sm">
                    Berkomitmen pada kejujuran dan transparansi
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Inovasi</h3>
                <p class="text-gray-600 text-sm">
                    Terus berinovasi dalam metode pelatihan
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Kemitraan</h3>
                <p class="text-gray-600 text-sm">
                    Membangun hubungan jangka panjang dengan klien
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Legalitas -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <div class="inline-block text-maroon font-semibold mb-4">LEGALITAS & SERTIFIKASI</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Terdaftar & Terakreditasi Resmi
                </h2>
            </div>
            
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-animate-group>
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">Kementerian Ketenagakerjaan RI</h4>
                            <p class="text-sm text-gray-600">Terdaftar sebagai lembaga pelatihan K3 resmi</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">BNSP</h4>
                            <p class="text-sm text-gray-600">Lembaga Sertifikasi Profesi (LSP) terakreditasi</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">Kemenkumham</h4>
                            <p class="text-sm text-gray-600">Badan hukum PT yang terdaftar resmi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <!-- CTA -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-maroon to-maroon-dark rounded-3xl p-8 md:p-16 text-center text-white" data-animate="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Siap Bergabung dengan Kami?
            </h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Hubungi kami untuk konsultasi gratis dan temukan program pelatihan yang sesuai dengan kebutuhan Anda
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('programs') }}" 
                   onclick="trackClick('about_cta', 'Button - Lihat Program Pelatihan');"
                   class="bg-yellow text-maroon px-8 py-4 rounded-lg font-bold hover:bg-yellow-light transition">
                    Lihat Program Pelatihan
                </a>
                <a href="{{ route('about') . '#kontak' }}" 
                   onclick="trackClick('about_cta', 'Button - Hubungi Kami');"
                   class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-maroon transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section> --}}

<!-- Kirim Pesan -->
<section id="kontak" class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-10">
                <div class="inline-block text-maroon font-semibold mb-4">KONTAK KAMI</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Kirim Pesan
                </h2>
                <p class="text-gray-600">
                    Kami siap membantu Anda menemukan solusi pelatihan K3 yang tepat
                </p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-xl" data-animate="fade-up">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6" id="contactForm" >
                    @csrf

                    {{-- Success --}}
                    @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    {{-- Error --}}
                    @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-red-700 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                    @endif

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition @error('name') border-red-500 @enderror"
                               placeholder="Masukkan nama lengkap Anda">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition @error('email') border-red-500 @enderror"
                               placeholder="contoh@email.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-900 mb-2">
                            No. Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="tel"
                               id="phone"
                               name="phone"
                               value="{{ old('phone') }}"
                               required
                               placeholder="081234567890"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="program" class="block text-sm font-semibold text-gray-900 mb-2">
                            Program yang Diminati
                        </label>
                        <select id="program"
                                name="program"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition">
                            <option value="">Pilih Program (Opsional)</option>
                            <option value="ak3" {{ old('program') == 'ak3' ? 'selected' : '' }}>Pelatihan AK3 Umum</option>
                            <option value="bnsp" {{ old('program') == 'bnsp' ? 'selected' : '' }}>Sertifikasi BNSP</option>
                            <option value="skp" {{ old('program') == 'skp' ? 'selected' : '' }}>Perpanjangan SKP</option>
                            <option value="tot" {{ old('program') == 'tot' ? 'selected' : '' }}>Training of Trainer</option>
                            <option value="other" {{ old('program') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-900 mb-2">
                            Pesan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="message"
                                  name="message"
                                  rows="5"
                                  required
                                  placeholder="Tuliskan pesan atau pertanyaan Anda..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent transition @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            id="submitBtn"
                            class="w-full bg-maroon text-white px-6 py-4 rounded-lg font-bold hover:bg-maroon-dark transition flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span id="btnText">Kirim Pesan</span>
                    </button>

                    <p class="text-xs text-gray-500 text-center">
                        This site is protected by reCAPTCHA and the Google
                        <a href="https://policies.google.com/privacy" class="text-maroon underline" target="_blank">Privacy Policy</a> and
                        <a href="https://policies.google.com/terms" class="text-maroon underline" target="_blank">Terms of Service</a> apply.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
@push('scripts')
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const submitBtn = document.getElementById('submitBtn');
    const btnText   = document.getElementById('btnText');
    const siteKey   = "{{ config('services.recaptcha.site_key') }}";

    submitBtn.disabled = true;
    btnText.textContent = 'Mengirim...';

    grecaptcha.ready(function() {
        grecaptcha.execute(siteKey, {action: 'contact'})
        .then(function(token) {
            console.log('Token generated:', token.substring(0, 20));

            const form  = document.getElementById('contactForm');
            const input = document.createElement('input');
            input.type  = 'hidden';
            input.name  = 'recaptcha_token';
            input.value = token;
            form.appendChild(input);

            if (typeof trackClick === 'function') {
                trackClick('contact_form', 'Submit - About Page');
            }

            form.submit();
        })
        .catch(function(err) {
            console.error('reCAPTCHA error:', err);
            alert('reCAPTCHA error. Silakan coba lagi.');
            submitBtn.disabled = false;
            btnText.textContent = 'Kirim Pesan';
        });
    });
});
</script>
@endpush
@endpush
@endsection