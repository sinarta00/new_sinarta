@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="bg-gradient-to-br from-maroon to-maroon-dark text-white py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Hubungi Kami</h1>
            <p class="text-xl text-gray-200">
                Kami siap membantu Anda menemukan solusi pelatihan K3 yang tepat
            </p>
        </div>
    </div>
</section>

<!-- Success Message -->
@if(session('success'))
<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-green-700 font-medium">{{ session('success') }}</p>
        </div>
    </div>
</div>
@endif

<!-- Error Message -->
@if(session('error'))
<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-red-700 font-medium">{{ session('error') }}</p>
        </div>
    </div>
</div>
@endif

<!-- Contact Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Mari Diskusi Kebutuhan Anda
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Tim kami siap membantu menjawab pertanyaan dan memberikan solusi terbaik untuk kebutuhan pelatihan K3 Anda. Hubungi kami melalui form atau kontak langsung di bawah ini.
                    </p>
                </div>
                
                <div class="space-y-6">
                    <!-- Alamat -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 mb-1">Alamat Kantor</div>
                            <p class="text-gray-600">
                                Jl. Cipto Mangunkusumo, Belimbing,<br> Kec. Bontang Barat,<br> Kota Bontang,<br> Kalimantan Timur<br> 75313
                            </p>
                        </div>
                    </div>
                    
                    <!-- Telepon -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 mb-1">Telepon</div>
                            <p class="text-gray-600">
                                <a href="tel:+6281351813731" class="hover:text-maroon transition">+62 813-5181-3731</a><br>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 mb-1">Email</div>
                            <p class="text-gray-600">
                                <a href="mailto:Marketing@sinartamjs.com" class="hover:text-maroon transition">Marketing@sinartamjs.com</a><br>
                                <a href="mailto:admin@sinartamjs.com" class="hover:text-maroon transition">admin@sinartamjs.com</a>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Jam Operasional -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-maroon rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 mb-1">Jam Operasional</div>
                            <p class="text-gray-600">
                                Senin - Jumat: 07.00 - 17.00 WITA<br>
                                Minggu & Sabtu: Tutup
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="mt-8">
                    <div class="font-semibold text-gray-900 mb-4">Ikuti Kami</div>
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
            <div class="bg-white rounded-2xl p-8 shadow-xl">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
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
                            class="w-full bg-maroon text-white px-6 py-4 rounded-lg font-bold hover:bg-maroon-dark transition flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Lokasi Kami
            </h2>
            <p class="text-gray-600">
                Kunjungi kantor kami untuk konsultasi langsung
            </p>
        </div>
        
        <div class="bg-gray-200 rounded-2xl overflow-hidden shadow-lg" style="height: 400px;">
            <!-- Placeholder - Ganti dengan iframe Google Maps asli -->
            <div class="w-full h-full flex items-center justify-center text-gray-500">
                <div class="text-center">
                    <svg class="w-20 h-20 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <p class="text-lg font-semibold">Embed Google Maps</p>
                    <p class="text-sm">Tambahkan iframe Google Maps di sini</p>
                </div>
            </div>
            
            <!-- Contoh embed Google Maps (uncomment dan ganti URL): -->
            <!-- 
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d..." 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            -->
        </div>
    </div>
</section>

<!-- Quick Contact CTA -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- WhatsApp -->
                <a href="https://wa.me/6281351813731" target="_blank" class="bg-green-500 text-white rounded-xl p-6 hover:bg-green-600 transition group">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-2">Chat WhatsApp</h3>
                    <p class="text-center text-sm opacity-90">Respon cepat 24/7</p>
                </a>
                
                <!-- Email -->
                <a href="mailto:info@sinartamjs.com" class="bg-maroon text-white rounded-xl p-6 hover:bg-maroon-dark transition group">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 20 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-2">Email Kami</h3>
                    <p class="text-center text-sm opacity-90">marketing@sinartamjs.com</p>
                </a>
                
                <!-- Telepon -->
                <a href="tel:+6281234567890" class="bg-yellow text-maroon rounded-xl p-6 hover:bg-yellow-light transition group">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-2">Telepon Kami</h3>
                    <p class="text-center text-sm font-semibold">+62 813-5181-3731</p>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection