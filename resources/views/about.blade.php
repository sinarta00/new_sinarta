@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="bg-gradient-to-br from-maroon to-maroon-dark text-white py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Tentang Kami</h1>
            <p class="text-xl text-gray-200">
                Mengenal lebih dekat PT Sinarta Multi Jasa Sertifikasi
            </p>
        </div>
    </div>
</section>

<!-- Company Profile -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-block text-maroon font-semibold mb-4">PROFIL PERUSAHAAN</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
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
            
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=800&q=80" 
                     alt="Tim SinartaMJS" 
                     class="rounded-2xl shadow-2xl">
                <div class="absolute -bottom-6 -left-6 bg-maroon text-white p-8 rounded-xl shadow-xl">
                    <div class="text-4xl font-bold text-yellow">5+</div>
                    <div class="text-sm">Tahun Pengalaman</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Visi -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Menjadi lembaga pelatihan dan sertifikasi K3 terpercaya dan terdepan di Indonesia yang berkontribusi dalam menciptakan lingkungan kerja yang aman, sehat, dan produktif.
                    </p>
                </div>
                
                <!-- Misi -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <span class="text-maroon mr-2">•</span>
                            <span>Menyelenggarakan pelatihan K3 berkualitas dengan standar nasional dan internasional</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-maroon mr-2">•</span>
                            <span>Mengembangkan kompetensi SDM di bidang K3 secara berkelanjutan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-maroon mr-2">•</span>
                            <span>Memberikan pelayanan terbaik dengan harga kompetitif</span>
                        </li>
                    </ul>
                </div>
            </div>
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
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            <h4 class="font-bold text-gray-900 mb-1">ISO 9001:2015</h4>
                            <p class="text-sm text-gray-600">Sistem Manajemen Mutu tersertifikasi</p>
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

<!-- CTA -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-maroon to-maroon-dark rounded-3xl p-8 md:p-16 text-center text-white">
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
                <a href="{{ route('contact') }}" 
                   onclick="trackClick('about_cta', 'Button - Hubungi Kami');"
                   class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-maroon transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

@endsection