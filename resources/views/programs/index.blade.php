@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="bg-gradient-to-br from-maroon to-maroon-dark text-white py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Program Pelatihan</h1>
            <p class="text-xl text-gray-200">
                Pilih program pelatihan yang sesuai dengan kebutuhan Anda
            </p>
        </div>
    </div>
</section>

<!-- Filter & Search -->
<section class="py-8 bg-white border-b">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('programs') }}" class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari program pelatihan..." 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent">
            </div>
            
            <!-- Category Filter -->
            <div class="md:w-64">
                <select name="category" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon focus:border-transparent"
                        onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="KEMNAKER" {{ request('category') == 'KEMNAKER' ? 'selected' : '' }}>Kemnaker</option>
                    <option value="BNSP" {{ request('category') == 'BNSP' ? 'selected' : '' }}>BNSP</option>
                    <option value="SKP" {{ request('category') == 'SKP' ? 'selected' : '' }}>SKP</option>
                    <option value="TOT" {{ request('category') == 'TOT' ? 'selected' : '' }}>TOT</option>
                    <option value="OTHER" {{ request('category') == 'OTHER' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            
            <!-- Search Button -->
            <button type="submit" 
                    onclick="trackClick('program_filter', 'Search Button');"
                    class="bg-maroon text-white px-8 py-3 rounded-lg hover:bg-maroon-dark transition font-semibold">
                Cari
            </button>
            
            <!-- Reset -->
            @if(request('search') || request('category'))
            <a href="{{ route('programs') }}" 
               onclick="trackClick('program_filter', 'Reset Filter');"
               class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 transition font-semibold text-center">
                Reset
            </a>
            @endif
        </form>
    </div>
</section>

<!-- Programs Grid -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($programs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($programs as $program)
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
                        
                        <!-- Category Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow text-maroon px-3 py-1 rounded-full text-sm font-bold">
                                {{ $program->category }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $program->title }}</h3>
                        
                        <div class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {!! Str::limit(strip_tags($program->description), 120) !!}
                        </div>
                        
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
                                <div class="text-sm text-gray-500">Hubungi kami untuk</div>
                                <div class="text-lg font-bold text-maroon">Info Harga</div>
                            </div>
                            @endif
                            
                            <a href="https://wa.me/6281234567890?text=Halo, saya ingin mendaftar program {{ $program->title }}" 
                               target="_blank"
                               onclick="trackClick('program_list', 'Daftar Button - {{ $program->title }}');"
                               class="bg-maroon text-white px-6 py-2 rounded-lg hover:bg-maroon-dark transition font-semibold text-sm">
                                Daftar
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
                {{ $programs->links() }}
            </div>
            
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-20 h-20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Program Tidak Ditemukan</h3>
                <p class="text-gray-500 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                <a href="{{ route('programs') }}" 
                   onclick="trackClick('program_list', 'Button - Lihat Semua Program dari Empty State');"
                   class="inline-block bg-maroon text-white px-6 py-3 rounded-lg hover:bg-maroon-dark transition font-semibold">
                    Lihat Semua Program
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Program Benefits -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-4">MANFAAT PROGRAM</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Yang Anda Dapatkan
            </h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Sertifikat Resmi</h3>
                <p class="text-gray-600 text-sm">
                    Sertifikat yang diakui secara nasional
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Modul Lengkap</h3>
                <p class="text-gray-600 text-sm">
                    Materi pelatihan terstruktur dan up to date
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Networking</h3>
                <p class="text-gray-600 text-sm">
                    Kesempatan bertemu profesional K3 lainnya
                </p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-maroon rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Konsultasi Gratis</h3>
                <p class="text-gray-600 text-sm">
                    Dukungan pasca pelatihan selamanya
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12">
                <div class="inline-block text-maroon font-semibold mb-4">FAQ</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Pertanyaan Umum
                </h2>
            </div>
            
            <div class="space-y-4">
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h4 class="font-bold text-gray-900 mb-2">Berapa lama sertifikat berlaku?</h4>
                    <p class="text-gray-600 text-sm">
                        Sertifikat AK3 Umum Kemnaker berlaku selama 3 tahun dan dapat diperpanjang melalui program refresh.
                    </p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h4 class="font-bold text-gray-900 mb-2">Apakah ada persyaratan khusus untuk mengikuti pelatihan?</h4>
                    <p class="text-gray-600 text-sm">
                        Persyaratan umum meliputi: pendidikan minimal SMA/sederajat, sehat jasmani dan rohani, serta menyerahkan dokumen yang diperlukan.
                    </p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h4 class="font-bold text-gray-900 mb-2">Apakah tersedia program in-house training?</h4>
                    <p class="text-gray-600 text-sm">
                        Ya, kami menyediakan program in-house training untuk perusahaan dengan minimal peserta tertentu. Hubungi kami untuk informasi lebih lanjut.
                    </p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h4 class="font-bold text-gray-900 mb-2">Bagaimana sistem pembayarannya?</h4>
                    <p class="text-gray-600 text-sm">
                        Pembayaran dapat dilakukan via transfer bank, dengan sistem DP atau pelunasan. Tersedia diskon untuk pendaftaran grup.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-maroon to-maroon-dark rounded-3xl p-8 md:p-16 text-center text-white">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Siap Tingkatkan Kompetensi K3 Anda?
            </h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Daftar sekarang dan dapatkan penawaran spesial untuk pendaftaran di bulan ini
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/6281351813731?text=Halo, saya ingin mendaftar program pelatihan" 
                   target="_blank"
                   onclick="trackClick('program_cta', 'Button - Daftar via WhatsApp');"
                   class="bg-green-500 text-white px-8 py-4 rounded-lg font-bold hover:bg-green-600 transition inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Daftar via WhatsApp
                </a>
                <a href="{{ route('contact') }}" 
                   onclick="trackClick('program_cta', 'Button - Konsultasi Gratis');"
                   class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-maroon transition">
                    Konsultasi Gratis
                </a>
            </div>
        </div>
    </div>
</section>

@endsection