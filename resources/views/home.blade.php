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
    font-size: 28px;
    font-weight: 700;
    font-family: Arial, sans-serif;
    margin: 0;
}

.jumbotron-title {
    color: #fff;
    font-size: clamp(30px, 4vw, 50px);
    font-weight: 900;
    line-height: 1.05;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.jumbotron-desc {
    color: rgba(255,255,255,0.92);
    font-size: 18px;
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

    .jumbotron-title {
        font-size: 18px;
    }

    .jumbotron-desc {
        font-size: 13px;
        max-width: 300px;
    }

    .jumbotron-hashtags {
        font-size: 16px;
    }

    .btn-outline-white{
        padding-block: 5px;
        padding-inline: 10px;
        font-size: 12px;
    }

}

/* ══════════════════════════════════════
   JUMBOTRON ENTRANCE ANIMATIONS
══════════════════════════════════════ */

/* Hashtag — fade in dari atas */
@keyframes jumbotronHashtag {
    from { opacity: 0; transform: translateY(-20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Judul — fade in dari kiri */
@keyframes jumbotronTitle {
    from { opacity: 0; transform: translateX(-40px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* Deskripsi — fade in dari kiri, lebih lambat */
@keyframes jumbotronDesc {
    from { opacity: 0; transform: translateX(-30px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* Tombol — fade in dari bawah */
@keyframes jumbotronButtons {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Foto — fade in dari kanan */
@keyframes jumbotronImage {
    from { opacity: 0; transform: translateX(60px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* Terapkan ke masing-masing elemen */
.jumbotron-hashtags {
    animation: jumbotronHashtag 0.7s ease-out forwards;
    animation-delay: 0.1s;
    opacity: 0;
}

.jumbotron-title {
    animation: jumbotronTitle 0.8s ease-out forwards;
    animation-delay: 0.3s;
    opacity: 0;
}

.jumbotron-desc {
    animation: jumbotronDesc 0.8s ease-out forwards;
    animation-delay: 0.55s;
    opacity: 0;
}

.jumbotron-buttons {
    animation: jumbotronButtons 0.7s ease-out forwards;
    animation-delay: 0.75s;
    opacity: 0;
}

.jumbotron-image {
    animation: jumbotronImage 1s ease-out forwards;
    animation-delay: 0.2s;
    opacity: 0;
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
                DEVELOPING TRAINING<br>
                BUILDING A SAFETY CULTURE
            </h1>
            <p class="jumbotron-desc">
                Menyediakan pelatihan dan sertifikasi profesional yang
                dirancang untuk mempersiapkan tenaga kerja andal
                dan siap menghadapi tantangan dunia kerja di bidang Ahli K3.
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

            <div class="order-2 md:order-1">
                <h2 class="text-3xl font-bold text-maroon mb-4">
                    PT Sinarta Multi Jasa Sertifikasi
                </h2>
                <p class="text-gray-600 mb-3 leading-relaxed">
                    PT Sinarta Multi Jasa Sertifikasi adalah perusahaan penyedia layanan pelatihan dan sertifikasi K3
                    yang telah dipercaya oleh beberapa perusahaan di Kalimantan Timur.
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
                            <svg class="w-4 h-4 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">{{ $title }}</div>
                            <div class="text-gray-600 text-sm">{{ $desc }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="order-1 md:order-2">
                <img src="{{ asset('images/foto_profile.png') }}"
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
                                    class="inline-block bg-maroon text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-maroon-dark transition">
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
<section id="layanan" class="py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
 
        {{-- Header --}}
        <div class="text-center mb-12">
            <span class="inline-block text-maroon font-semibold text-sm uppercase tracking-widest mb-2">LAYANAN KAMI</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Pelatihan Yang Bisa Kamu Ikuti
            </h2>
            <p class="text-gray-500 max-w-xl mx-auto text-sm">
                Kami menyediakan berbagai program pelatihan dan sertifikasi K3 yang disesuaikan dengan kebutuhan industri
            </p>
        </div>
 
        @if($programs->count() > 0)
 
        <div class="relative flex items-center gap-1 md:gap-4">
 
            {{-- Prev Button --}}
            <button id="slider-prev"
                class="flex-shrink-0 h-6 w-6 md:w-14 md:h-14 bg-white border border-gray-200 rounded-full shadow-md
                       flex items-center justify-center hover:bg-maroon hover:text-white hover:border-maroon
                       transition-all duration-200 text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
 
            {{-- Slider Track --}}
            <div class="overflow-hidden flex-1">
                <div class="flex transition-transform duration-500 ease-in-out" id="slider-track">
                    @foreach($programs as $program)
                    <div class="program-slide flex-shrink-0 px-3" style="width:33.3333%">
                        <div class="bg-white rounded-lg border border-gray-100 shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col h-full">
 
                            {{-- Gambar --}}
                            <div class="relative h-44 overflow-hidden rounded-t-lg">
                                @if($program->image)
                                    <img src="{{ Storage::url($program->image) }}"
                                         alt="{{ $program->title }}"
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                @else
                                    <img src="{{ asset('images/about_photo.jpg') }}"
                                         alt="{{ $program->title }}"
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
 
                            {{-- Konten Card --}}
                            <div class="px-4 py-2 flex flex-col flex-1">
 
                                <h3 class="text-2xl font-bold text-maroon mb-3">{{ $program->title }}</h3>
 
                                {{-- Badge Info --}}
                                <div class="flex flex-wrap gap-2 mb-2">
                                    @if($program->category)
                                    <span class="inline-flex items-center gap-1 font-medium px-3 rounded-full border border-maroon text-maroon border-1" style="font-size: 10px">
                                        {{ $program->category }}
                                    </span>
                                    @endif
                                    @if($program->duration)
                                    <span class="inline-flex items-center gap-1 font-medium px-3 rounded-full border border-maroon text-maroon border-1" style="font-size: 10px">
                                        {{ $program->duration }}
                                    </span>
                                    @endif
                                </div>
 
                                {{-- Persyaratan --}}
                                <div class="mb-2 flex-1">
                                    <p class="text-md font-semibold text-black-500 mb-1 uppercase tracking-wide">
                                        Persyaratan Umum
                                    </p>

                                    @php
                                        $requirements = $program->requirements
                                            ? preg_split('/\r\n|\r|\n/', $program->requirements)
                                            : [];
                                    @endphp

                                    @if(!empty(array_filter($requirements)))
                                        <ul>
                                            @foreach (array_slice(array_filter($requirements), 0, 3)  as $item)
                                                @if(trim($item))
                                                    <li class="flex items-start text-xs text-gray-600 leading-relaxed">
                                                        <span>
                                                            {{ trim($item) }}
                                                        </span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-xs text-gray-400">
                                            Belum ada data persyaratan.
                                        </p>
                                    @endif
                                </div>
 
                                {{-- Tombol --}}
                                <div class="flex flex-col gap-2 mt-1">
                                    <a href="{{ $program->variants->first()?->registration_link ?? '#' }}"
                                       onclick="trackClick('program_card', 'Daftar - {{ addslashes($program->title) }}');"
                                       class="w-full text-center bg-maroon text-white py-2 font-semibold text-sm hover:bg-maroon-dark transition-colors duration-200">
                                        Daftar Pelatihan Sekarang
                                    </a>
                                    <a href="{{ route('programs.show', $program->id) }}"
                                       onclick="trackClick('program_card', 'Detail - {{ addslashes($program->title) }}');"
                                       class="w-full text-center bg-yellow text-maroon py-2 font-semibold text-sm hover:bg-yellow-light transition-colors duration-200">
                                        Detail Pelatihan
                                    </a>
                                </div>
 
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
 
            {{-- Next Button --}}
            <button id="slider-next"
                class="flex-shrink-0 h-6 w-6 md:w-14 md:h-14 bg-white border border-gray-200 rounded-full shadow-md
                       flex items-center justify-center hover:bg-maroon hover:text-white hover:border-maroon
                       transition-all duration-200 text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
 
        </div>
 
        @else
        <div class="text-center py-16">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Program Tidak Ditemukan</h3>
            <p class="text-gray-500 text-sm mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
            <a href="{{ route('programs') }}"
               class="inline-block bg-maroon text-white px-8 py-3 rounded-xl hover:bg-maroon-dark transition font-semibold text-sm">
                Lihat Semua Program
            </a>
        </div>
        @endif
 
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const track   = document.getElementById('slider-track');
    const prevBtn = document.getElementById('slider-prev');
    const nextBtn = document.getElementById('slider-next');
 
    if (!track) return;
 
    const slides  = track.querySelectorAll('.program-slide');
    let current   = 0;
 
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
 
    prevBtn.addEventListener('click', () => { if (current > 0)        { current--; update(); } });
    nextBtn.addEventListener('click', () => { if (current < maxIdx()) { current++; update(); } });
    window.addEventListener('resize', () => { current = 0; setWidths(); update(); });
 
    setWidths();
    update();
});
</script>
@endpush



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
    <div class="container mx-auto py-2 px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <div class="inline-block text-maroon font-semibold mb-2">TESTIMONI</div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Pengalaman peserta yang telah mengikuti program pelatihan kami
            </p>
        </div>

        <div class="relative flex items-center gap-1 md:gap-4">

            <button id="testi-prev"
                    class="flex-shrink-0 h-6 w-6 md:w-14 md:h-14 bg-white border border-gray-200 rounded-full shadow-md flex items-center justify-center hover:bg-gray-50 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <div class="overflow-hidden flex-1 pb-4">
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
                    class="flex-shrink-0 h-6 w-6 md:w-14 md:h-14 bg-white border border-gray-200 rounded-full shadow-md flex items-center justify-center hover:bg-gray-50 transition">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

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

{{-- ════════════════════════════════════════════
     SCROLL ANIMATIONS
════════════════════════════════════════════ --}}
<style>
/* ── Section fade-in dari bawah ── */
.reveal-section {
    opacity: 0;
    transform: translateY(50px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}
.reveal-section.visible {
    opacity: 1;
    transform: translateY(0);
}

/* ── Child items: fade + stagger ── */
.reveal-item {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}
.reveal-item.visible {
    opacity: 1;
    transform: translateY(0);
}
.reveal-item:nth-child(1) { transition-delay: 0.05s; }
.reveal-item:nth-child(2) { transition-delay: 0.15s; }
.reveal-item:nth-child(3) { transition-delay: 0.25s; }
.reveal-item:nth-child(4) { transition-delay: 0.35s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── 1. Setiap <section> fade-in saat masuk viewport ── */
    document.querySelectorAll('section').forEach(function (el) {
        /* Skip jumbotron — sudah langsung kelihatan saat load */
        if (el.classList.contains('jumbotron-section')) return;
        el.classList.add('reveal-section');
    });

    /* ── 2. Stagger untuk grid cards & list items ── */
    const staggerTargets = [
        /* Tentang Kami — checklist items */
        '#tentang .space-y-4 > div',
        /* Mengapa Memilih — 4 icon cards */
        '.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-4 > div',
    ];
    staggerTargets.forEach(function (sel) {
        document.querySelectorAll(sel).forEach(function (el) {
            el.classList.add('reveal-item');
        });
    });

    /* ── 3. IntersectionObserver ── */
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 0.08,
        rootMargin: '0px 0px -40px 0px',
    });

    document.querySelectorAll('.reveal-section, .reveal-item').forEach(function (el) {
        observer.observe(el);
    });

});
</script>

@endsection