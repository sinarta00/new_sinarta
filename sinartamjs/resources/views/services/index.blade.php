@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="bg-gradient-to-br from-maroon to-maroon-dark text-white py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Kami</h1>
            <p class="text-xl text-gray-200">
                Solusi lengkap untuk pelatihan dan sertifikasi K3 Anda
            </p>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
                    @if($service->image)
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ Storage::url($service->image) }}" 
                                 alt="{{ $service->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                    @else
                        <div class="relative h-56 bg-gradient-to-br from-maroon to-maroon-dark flex items-center justify-center">
                            <svg class="w-20 h-20 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $service->title }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ $service->description }}
                        </p>
                        
                        <a href="https://wa.me/6281234567890?text=Halo, saya ingin bertanya tentang {{ $service->title }}" 
                           target="_blank"
                           class="inline-flex items-center text-maroon font-semibold hover:text-yellow transition">
                            Tanya Sekarang
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-20 h-20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Layanan</h3>
                <p class="text-gray-500">Data layanan akan segera ditambahkan</p>
            </div>
        @endif
    </div>
</section>

<!-- Why Choose Our Services -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-4">KEUNGGULAN LAYANAN</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Mengapa Memilih Layanan Kami?
            </h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-8 shadow-lg">
                <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Sertifikat Resmi</h3>
                <p class="text-gray-600">
                    Sertifikat yang dikeluarkan diakui oleh Kementerian Ketenagakerjaan RI dan BNSP
                </p>
            </div>
            
            <div class="bg-white rounded-xl p-8 shadow-lg">
                <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Instruktur Berpengalaman</h3>
                <p class="text-gray-600">
                    Tim instruktur profesional dengan sertifikasi nasional dan pengalaman industri
                </p>
            </div>
            
            <div class="bg-white rounded-xl p-8 shadow-lg">
                <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Jadwal Fleksibel</h3>
                <p class="text-gray-600">
                    Berbagai pilihan jadwal pelatihan yang dapat disesuaikan dengan kebutuhan Anda
                </p>
            </div>
            
            <div class="bg-white rounded-xl p-8 shadow-lg">
                <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Fasilitas Lengkap</h3>
                <p class="text-gray-600">
                    Ruang pelatihan modern dengan peralatan praktek yang memadai dan nyaman
                </p>
            </div>
            
            <div class="bg-white rounded-xl p-8 shadow-lg">
                <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Harga Kompetitif</h3>
                <p class="text-gray-600">
                    Harga terjangkau dengan kualitas terbaik, tersedia diskon untuk grup
                </p>
            </div>
            
            <div class="bg-white rounded-xl p-8 shadow-lg">
                <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Dukungan Penuh</h3>
                <p class="text-gray-600">
                    Konsultasi gratis dan pendampingan dari awal hingga sertifikat terbit
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Service Process -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-4">ALUR LAYANAN</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Cara Bergabung dengan Program Kami
            </h2>
        </div>
        
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="relative">
                        <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-yellow">1</span>
                        </div>
                        <div class="hidden md:block absolute top-8 left-1/2 w-full h-0.5 bg-gray-300 -z-10"></div>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Konsultasi</h4>
                    <p class="text-sm text-gray-600">Hubungi kami untuk konsultasi gratis tentang program yang sesuai</p>
                </div>
                
                <div class="text-center">
                    <div class="relative">
                        <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-yellow">2</span>
                        </div>
                        <div class="hidden md:block absolute top-8 left-1/2 w-full h-0.5 bg-gray-300 -z-10"></div>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Pendaftaran</h4>
                    <p class="text-sm text-gray-600">Isi formulir pendaftaran dan lengkapi persyaratan dokumen</p>
                </div>
                
                <div class="text-center">
                    <div class="relative">
                        <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-yellow">3</span>
                        </div>
                        <div class="hidden md:block absolute top-8 left-1/2 w-full h-0.5 bg-gray-300 -z-10"></div>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Pembayaran</h4>
                    <p class="text-sm text-gray-600">Lakukan pembayaran sesuai program yang dipilih</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-yellow">4</span>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Pelatihan</h4>
                    <p class="text-sm text-gray-600">Ikuti pelatihan dan dapatkan sertifikat resmi</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-maroon to-maroon-dark rounded-3xl p-8 md:p-16 text-center text-white">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Butuh Konsultasi Lebih Lanjut?
            </h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Tim kami siap membantu Anda memilih layanan yang tepat sesuai kebutuhan
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/6281351813731" target="_blank" class="bg-green-500 text-white px-8 py-4 rounded-lg font-bold hover:bg-green-600 transition inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Chat WhatsApp
                </a>
                <a href="{{ route('contact') }}" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-maroon transition">
                    Formulir Kontak
                </a>
            </div>
        </div>
    </div>
</section>

@endsection