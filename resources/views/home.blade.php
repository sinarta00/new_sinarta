@extends('layouts.app')

@section('content')

{{-- ════════════════════════════════════════════
     CSS — selalu dimuat, di luar @if($popup)
════════════════════════════════════════════ --}}
<style>
/* ── Popup animation ── */
@keyframes popupFadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.popup-animate { animation: popupFadeInUp 0.4s ease-out forwards; }

/* ══════════════════════════════════════
   JUMBOTRON
══════════════════════════════════════ */
.jumbotron-section {
    background-color: #800020;
    width: 100%;
    overflow: hidden;
    font-family: 'Arial Black', Arial, sans-serif;
    min-height: 90vh;
    display: flex;
    align-items: stretch;
}

.jumbotron-inner {
    position: relative;
    display: flex;
    align-items: stretch;
    width: 100%;
    min-height: 90vh;
}

/* Teks — kiri, di atas foto */
.jumbotron-content {
    position: relative;
    z-index: 2;
    flex: 0 0 52%;
    padding: 60px 40px 60px 6vw;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 16px;
}

.jumbotron-hashtags {
    color: #fff;
    font-size: 25px;
    font-weight: 700;
    font-family: Arial, sans-serif;
    margin: 0;
}

.jumbotron-title {
    color: #fff;
    font-size: clamp(32px, 4.5vw, 56px);
    font-weight: 900;
    line-height: 1.05;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.jumbotron-desc {
    color: rgba(255,255,255,0.92);
    font-size: 14px;
    font-weight: 400;
    font-family: Arial, sans-serif;
    line-height: 1.7;
    max-width: 400px;
    margin: 0;
}

.jumbotron-buttons {
    display: flex;
    gap: 14px;
    margin-top: 4px;
    flex-wrap: wrap;
}

.btn-outline-white {
    display: inline-block;
    padding: 10px 28px;
    border: 2px solid #fff;
    border-radius: 4px;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    font-family: Arial, sans-serif;
    text-decoration: none;
    background: transparent;
    transition: background 0.2s, color 0.2s;
}
.btn-outline-white:hover {
    background: #fff;
    color: #800020;
}

/* Foto — absolute, full kanan sampai tepi layar */
.jumbotron-image {
    position: absolute;
    top: 0; right: 0; bottom: 0;
    left: 40%;
    overflow: hidden;
}
.jumbotron-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center center;
    display: block;
}
/* Gradient: merah solid kiri → transparan kanan */
.jumbotron-image-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right,
        #800020 0%,
        rgba(128,0,32,0.75) 30%,
        rgba(128,0,32,0.2) 60%,
        transparent 80%);
    pointer-events: none;
}

/* ── Mobile ── */
@media (max-width: 768px) {
    .jumbotron-section,
    .jumbotron-inner { min-height: 85vh }

    .jumbotron-content {
        flex: none;
        padding: 48px 24px 220px;
    }
    .jumbotron-image { left: 0; }
    .jumbotron-image-overlay {
        background: linear-gradient(to bottom,
            #800020 35%,
            rgba(128,0,32,0.5) 60%,
            transparent 100%);
    }

    .jumbotron-hashtags {
        font-size: 16px;
    }

}
</style>


{{-- ════════════════════════════════════════════
     POPUP PROMO (hanya jika $popup ada)
════════════════════════════════════════════ --}}
@if($popup)
<div id="promoPopup"
     class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 transition-opacity duration-300 opacity-0"
     style="display:none; backdrop-filter:blur(8px); -webkit-backdrop-filter:blur(8px);">

    <div class="bg-white rounded-2xl max-w-2xl w-full relative popup-animate shadow-2xl">

        <button onclick="closePopup()"
                class="absolute -top-3 -right-3 w-10 h-10 bg-maroon text-white rounded-full hover:bg-maroon-dark transition flex items-center justify-center shadow-lg z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

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
        </div>

        <div class="py-3 px-6">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="dontShowAgain"
                       class="w-4 h-4 text-maroon border-gray-300 rounded focus:ring-maroon">
                <span class="ml-2 text-sm text-gray-600">Jangan tampilkan lagi hari ini</span>
            </label>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const popup      = document.getElementById('promoPopup');
    const dontShow   = document.getElementById('dontShowAgain');
    const storageKey = 'popup_closed_{{ $popup->id }}';
    const today      = new Date().toDateString();

    if (localStorage.getItem(storageKey) !== today) {
        setTimeout(() => {
            popup.style.display = 'flex';
            requestAnimationFrame(() => { popup.style.opacity = '1'; });
        }, 1000);
    }

    window.closePopup = function () {
        popup.style.opacity = '0';
        setTimeout(() => { popup.style.display = 'none'; }, 300);
        if (dontShow.checked) localStorage.setItem(storageKey, today);
    };

    popup.addEventListener('click', e => { if (e.target === popup) closePopup(); });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && popup.style.display === 'flex') closePopup();
    });
});
</script>
@endif


{{-- ════════════════════════════════════════════
     HERO / JUMBOTRON
════════════════════════════════════════════ --}}
<section class="jumbotron-section">
    <div class="jumbotron-inner">

        <div class="jumbotron-content">
            <p class="jumbotron-hashtags">#BeCertified &nbsp; #BeSafe &nbsp; #BeReady</p>
            <h1 class="jumbotron-title">
                BOOST YOUR SKILL<br>
                WITH SINARTA
            </h1>
            <p class="jumbotron-desc">
                Menyediakan pelatihan dan sertifikasi profesional yang
                dirancang untuk mempersiapkan tenaga kerja yang andal
                dan siap menghadapi tantangan dunia kerja.
            </p>
            <div class="jumbotron-buttons">
                <a href="#jadwal"  class="btn-outline-white">Lihat Jadwal</a>
                <a href="#layanan" class="btn-outline-white">Program</a>
            </div>
        </div>

        <div class="jumbotron-image">
            <img src="{{ asset('images/jumbotron.jpg') }}" alt="Hero Image">
            <div class="jumbotron-image-overlay"></div>
        </div>

    </div>
</section>


{{-- ════════════════════════════════════════════
     TENTANG KAMI
════════════════════════════════════════════ --}}
<section id="tentang" class="py-16 bg-maroon-tiny">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div>
                <h2 class="text-3xl font-bold text-maroon mb-4">
                    PT Sinarta Multi Jasa Sertifikasi
                </h2>
                <p class="text-gray-600 mb-3 leading-relaxed">
                    PT Sinarta Multi Jasa Sertifikasi adalah perusahaan penyedia layanan pelatihan dan sertifikasi K3
                    yang telah dipercaya oleh ratusan perusahaan dan individu di seluruh Indonesia.
                </p>
                <p class="text-gray-600 mb-3 leading-relaxed">
                    Dengan instruktur bersertifikat, metode pembelajaran modern, dan fasilitas lengkap, kami
                    berkomitmen menghasilkan tenaga kerja profesional yang kompeten di bidang Keselamatan dan
                    Kesehatan Kerja.
                </p>

                <div class="space-y-4">
                    @foreach([
                        ['Instruktur Berpengalaman', 'Tim instruktur profesional dengan sertifikasi nasional dan internasional'],
                        ['Sertifikat Resmi',          'Sertifikat yang dikeluarkan diakui oleh Kemnaker dan BNSP'],
                        ['Fasilitas Lengkap',         'Ruang pelatihan modern dengan peralatan praktek yang memadai'],
                    ] as [$title, $desc])
                    <div class="flex items-start space-x-3">
                        <div class="bg-yellow rounded-lg p-2 mt-1 flex-shrink-0">
                            <svg class="w-5 h-5 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ $title }}</div>
                            <div class="text-gray-600 text-sm">{{ $desc }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div>
                <img src="{{ asset('images/tentang_kami_home.png') }}"
                     alt="Tim Profesional"
                     class="shadow-xl rounded w-full">
            </div>

        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════
     JADWAL TERDEKAT
════════════════════════════════════════════ --}}
<section id="jadwal" class="py-16 bg-maroon-tiny" style="background-color: white;">
    <div class="container mx-auto px-8">

        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                Jadwal Pelatihan <span class="text-maroon">Terdekat</span>
            </h2>
        </div>

        {{-- Filter --}}
        <form method="GET" action="{{ url()->current() }}#jadwal">
            <div class="flex flex-col sm:flex-row gap-3 mb-6">

                <select name="category"
                        class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-maroon">
                    <option value="">Jenis Sertifikasi</option>
                    @foreach($scheduleCategories as $cat)
                        <option value="{{ $cat }}"
                            {{ request('category') === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>

                <select name="title"
                        class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-maroon">
                    <option value="">Nama Pelatihan</option>
                    @foreach($scheduleTitles as $id => $title)
                        <option value="{{ $title }}"
                            {{ request('title') === $title ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="bg-maroon text-white px-3 py-2 rounded-lg hover:bg-maroon-dark transition font-semibold text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                    </svg>
                    Cari
                </button>

            </div>
        </form>

        {{-- Tabel Jadwal --}}
        @if($schedules->count() > 0)
            <div class="bg-white rounded-xl shadow" style="overflow-y: scroll; border-radius:0.75rem;">
                <div class="overflow-x-auto overflow-y-auto" style="min-height: 300px; max-height: 450px;">
                    <table class="w-full text-sm">
                        <thead class="bg-maroon text-white sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-3 text-center w-12">No</th>
                                <th class="px-4 py-3 text-left">Nama Pelatihan</th>
                                <th class="px-4 py-3 text-center whitespace-nowrap">Tanggal</th>
                                <th class="px-4 py-3 text-center w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($schedules as $i => $schedule)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-gray-500">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-gray-800 font-medium">
                                    {{ $schedule->program->title }}
                                </td>
                                <td class="px-4 py-3 text-center text-gray-600 whitespace-nowrap">
                                    {{ $schedule->start_date->format('d M') }}
                                    – {{ $schedule->end_date->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $link = $schedule->program->variants
                                            ->where('is_active', true)
                                            ->sortBy('order')
                                            ->first()
                                            ?->registration_link
                                            ?? '#';
                                    @endphp
                                    <a href="{{ $link }}" target="_blank"
                                    class="inline-block bg-maroon text-white px-4 py-1.5 rounded-lg text-xs font-semibold hover:bg-maroon-dark transition">
                                        Daftar
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @else
            <div class="text-center py-12 text-gray-500">
                <svg class="w-14 h-14 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="font-medium">Tidak ada jadwal yang tersedia</p>
                @if(request()->hasAny(['category','title']))
                    <a href="{{ url()->current() }}#jadwal"
                    class="mt-3 inline-block text-maroon text-sm hover:underline">
                        Reset filter
                    </a>
                @endif
            </div>
        @endif

    </div>
</section>


{{-- ════════════════════════════════════════════
     PROGRAM / LAYANAN
════════════════════════════════════════════ --}}
<section id="layanan" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-2">LAYANAN KAMI</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Program Pelatihan &amp; Sertifikasi
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Kami menyediakan berbagai program pelatihan dan sertifikasi K3 yang disesuaikan dengan kebutuhan industri
            </p>
        </div>

        @if($programs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($programs as $program)
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition group flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden rounded-t-xl">
                        @if($program->image)
                            <img src="{{ Storage::url($program->image) }}"
                                 alt="{{ $program->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-maroon to-maroon-dark flex items-center justify-center">
                                <svg class="w-16 h-16 text-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow text-maroon px-3 py-1 rounded-full text-sm font-bold">
                                {{ $program->category }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $program->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-1">
                            {!! Str::limit(strip_tags($program->description), 120) !!}
                        </p>
                        <div class="flex gap-2 justify-end mt-2">
                            <a href="{{ route('program.show', $program->id) }}"
                               onclick="trackClick('program_card', 'Detail - {{ addslashes($program->title) }}');"
                               class="bg-maroon text-white px-6 py-2 rounded-lg hover:bg-maroon-dark transition font-semibold text-sm">
                                Detail
                            </a>
                            <a href="{{ $program->variants->first()?->registration_link }}"
                               onclick="trackClick('program_card', 'Daftar - {{ addslashes($program->title) }}');"
                               class="bg-yellow text-maroon px-6 py-2 rounded-lg hover:bg-yellow-light transition font-semibold text-sm">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-20 h-20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
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


{{-- ════════════════════════════════════════════
     MENGAPA MEMILIH KAMI
════════════════════════════════════════════ --}}
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
            @foreach([
                ['M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'Sertifikat Resmi',       'Diakui Kemnaker RI dan BNSP dengan legalitas terjamin'],
                ['M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',                        'Instruktur Profesional', 'Tim pengajar bersertifikat dengan pengalaman industri'],
                ['M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'Fasilitas Lengkap',   'Ruang pelatihan modern dengan peralatan standar industri'],
                ['M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'Dukungan Penuh', 'Konsultasi gratis dan pendampingan hingga sertifikat terbit'],
            ] as [$path, $title, $desc])
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">{{ $title }}</h3>
                <p class="text-gray-300 text-sm">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════
     TESTIMONI
════════════════════════════════════════════ --}}
<section id="testimoni" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-2">TESTIMONI</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Pengalaman peserta yang telah mengikuti program pelatihan kami
            </p>
        </div>

        <div class="relative flex items-center gap-4">

            <button id="testi-prev"
                    class="flex-shrink-0 w-14 h-14 bg-white border border-gray-200 rounded-full shadow-md flex items-center justify-center hover:bg-gray-50 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <div class="overflow-hidden flex-1">
                <div id="testi-track" class="flex transition-transform duration-500 ease-in-out">

                    @forelse($testimonials as $testimonial)
                    <div class="testi-slide flex-shrink-0 px-3" style="width:33.3333%">
                        <div class="bg-white rounded-xl p-6 shadow-lg h-full">
                            <div class="flex items-center mb-4">
                                @if($testimonial->avatar)
                                    <img src="{{ Storage::url($testimonial->avatar) }}"
                                         alt="{{ $testimonial->name }}"
                                         class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                                @else
                                    <div class="w-12 h-12 bg-maroon rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                        {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                                    </div>
                                @endif
                                <div class="ml-4">
                                    <div class="font-bold text-gray-900">{{ $testimonial->name }}</div>
                                    <div class="text-sm text-gray-600">
                                        {{ $testimonial->position }}{{ $testimonial->company ? ' - '.$testimonial->company : '' }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex mb-4">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                <svg class="w-5 h-5 text-yellow" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                            <p class="text-gray-600 text-sm italic">"{{ $testimonial->content }}"</p>
                        </div>
                    </div>

                    @empty
                    @foreach([
                        ['BS', 'Budi Santoso', 'HSE Manager - PT Energi Jaya',  'Pelatihan AK3 Umum di SinartaMJS sangat profesional. Instruktur berpengalaman dan materi sangat aplikatif. Highly recommended!'],
                        ['SM', 'Siti Maulida', 'K3 Officer - PT Maju Bersama',  'Proses perpanjangan SKP sangat cepat dan mudah. Staff sangat responsif dan membantu. Pelayanan prima!'],
                        ['AP', 'Ahmad Putra',  'Safety Supervisor',             'Fasilitas pelatihan sangat memadai. Materi up to date sesuai regulasi terbaru. Top!'],
                    ] as [$init, $name, $role, $quote])
                    <div class="testi-slide flex-shrink-0 px-3" style="width:33.3333%">
                        <div class="bg-white rounded-xl p-6 shadow-lg h-full">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-maroon rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                    {{ $init }}
                                </div>
                                <div class="ml-4">
                                    <div class="font-bold text-gray-900">{{ $name }}</div>
                                    <div class="text-sm text-gray-600">{{ $role }}</div>
                                </div>
                            </div>
                            <div class="flex mb-4">
                                @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-yellow" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                            <p class="text-gray-600 text-sm italic">"{{ $quote }}"</p>
                        </div>
                    </div>
                    @endforeach
                    @endforelse

                </div>
            </div>

            <button id="testi-next"
                    class="flex-shrink-0 w-14 h-14 bg-white border border-gray-200 rounded-full shadow-md flex items-center justify-center hover:bg-gray-50 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════
     CTA
════════════════════════════════════════════ --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-maroon to-maroon-dark rounded-3xl p-8 md:p-16 text-center text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
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
                    <a href="{{ route('contact') }}"
                       onclick="trackClick('cta', 'Button - Hubungi Kami');"
                       class="bg-yellow text-maroon px-8 py-4 rounded-lg font-bold hover:bg-yellow-light transition inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Hubungi Kami
                    </a>
                    <a href="https://wa.me/6281351813731"
                       target="_blank"
                       onclick="trackClick('cta', 'Button - Chat WhatsApp');"
                       class="bg-green-500 text-white px-8 py-4 rounded-lg font-bold hover:bg-green-600 transition inline-flex items-center justify-center">
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


{{-- ════════════════════════════════════════════
     SCRIPTS
════════════════════════════════════════════ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Testimonial Slider ── */
    const track   = document.getElementById('testi-track');
    const prevBtn = document.getElementById('testi-prev');
    const nextBtn = document.getElementById('testi-next');

    if (track) {
        const slides = track.querySelectorAll('.testi-slide');
        let current  = 0;

        const visible  = () => window.innerWidth < 768 ? 1 : 3;
        const maxIdx   = () => Math.max(0, slides.length - visible());
        const slideW   = () => 100 / visible();

        function setWidths() {
            slides.forEach(s => s.style.width = slideW() + '%');
        }
        function update() {
            track.style.transform       = `translateX(-${current * slideW()}%)`;
            prevBtn.style.opacity       = current === 0       ? '0.35' : '1';
            prevBtn.style.pointerEvents = current === 0       ? 'none' : 'auto';
            nextBtn.style.opacity       = current >= maxIdx() ? '0.35' : '1';
            nextBtn.style.pointerEvents = current >= maxIdx() ? 'none' : 'auto';
        }

        prevBtn.addEventListener('click', () => { if (current > 0)          { current--; update(); } });
        nextBtn.addEventListener('click', () => { if (current < maxIdx())   { current++; update(); } });
        window.addEventListener('resize', () => { current = 0; setWidths(); update(); });

        setWidths();
        update();
    }

});
</script>

@endsection