{{-- resources/views/gallery/index.blade.php --}}
@extends('layouts.app')

@section('content')
{{-- ================================================================
     HERO SECTION
     ================================================================ --}}
<section class="bg-maroon py-16 md:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center"
         data-animate="fade-up">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
            Galeri Kegiatan
        </h1>
        <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto">
            Dokumentasi pelatihan dan sertifikasi K3 bersama PT Sinarta Multi Jasa Sertifikasi
        </p>
    </div>
</section>

{{-- ================================================================
     FILTER KATEGORI
     ================================================================ --}}
@if($categories->isNotEmpty())
<section class="bg-white border-b border-gray-100 sticky top-[75px] z-30 shadow-sm">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide pb-1">
            {{-- Tombol "Semua" --}}
            <a href="{{ route('gallery') }}"
               class="flex-shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition
                      {{ !request('category') ? 'bg-maroon text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </a>

            @foreach($categories as $cat)
                <a href="{{ route('gallery', ['category' => $cat]) }}"
                   class="flex-shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition
                          {{ request('category') === $cat ? 'bg-maroon text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ================================================================
     GRID GALERI
     ================================================================ --}}
<section class="py-12 md:py-16" style="background-color: #FFFAFA">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        @if($galleries->isEmpty())
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-24 text-center"
                 data-animate="fade-up">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-gray-400 text-lg">Belum ada foto untuk kategori ini.</p>
            </div>
        @else
            {{-- Masonry-style responsive grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"
                 id="gallery-grid">

                @foreach($galleries as $index => $item)
                    <div class="group relative overflow-hidden rounded-xl shadow-sm hover:shadow-lg
                                transition-all duration-300 cursor-pointer bg-white"
                         data-animate="fade-up"
                         style="animation-delay: {{ ($index % 8) * 60 }}ms"
                         onclick="openLightbox({{ $index }})"
                         data-index="{{ $index }}">

                        {{-- Foto --}}
                        <div class="aspect-[4/3] overflow-hidden">
                            <img src="{{ $item->image_url }}"
                                 alt="{{ $item->title }}"
                                 class="w-full h-full object-cover transition-transform duration-500
                                        group-hover:scale-110"
                                 loading="lazy">
                        </div>

                        {{-- Overlay saat hover --}}
                        <div class="absolute inset-0 bg-maroon/70 opacity-0 group-hover:opacity-100
                                    transition-opacity duration-300 flex flex-col justify-end p-4">
                            <p class="text-white font-semibold text-sm leading-tight">{{ $item->title }}</p>
                            @if($item->category)
                                <span class="inline-block mt-2 text-xs bg-white/20 text-white
                                             rounded-full px-2 py-0.5 self-start">
                                    {{ $item->category }}
                                </span>
                            @endif
                        </div>

                        {{-- Ikon zoom di pojok kanan atas --}}
                        <div class="absolute top-3 right-3 bg-white/90 rounded-full p-1.5
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-4 h-4 text-maroon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                            </svg>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Jumlah foto --}}
            <p class="text-center text-sm text-gray-400 mt-8">
                Menampilkan {{ $galleries->count() }} foto
                @if(request('category'))
                    dalam kategori <span class="font-medium text-maroon">{{ request('category') }}</span>
                @endif
            </p>
        @endif

    </div>
</section>

{{-- ================================================================
     LIGHTBOX MODAL
     ================================================================ --}}
<div id="lightbox"
     class="fixed inset-0 z-50"
     style="background: rgba(0,0,0,0.92); display:none;"
     onclick="closeLightboxOnBackdrop(event)">

    <div class="relative max-w-5xl w-full mx-4 flex flex-col items-center"
         id="lightbox-inner">

        {{-- Tombol tutup --}}
        <button onclick="closeLightbox()"
                class="absolute right-5 -top-[25px] text-white/70 hover:text-white transition text-4xl leading-none"
                aria-label="Tutup">
            &times;
        </button>

        {{-- Foto utama --}}
        <div class="w-full flex items-center justify-center">
            <img id="lightbox-img"
                 src=""
                 alt=""
                 class="max-h-[50vh] w-3/4 rounded-xl object-contain shadow-2xl">
        </div>

        {{-- Caption --}}
        <div class="mt-4 text-center px-4">
            <p id="lightbox-title" class="text-white font-semibold text-lg"></p>
            <p id="lightbox-cat"   class="mt-2"></p>
        </div>

        {{-- Navigasi prev / next --}}
        <div class="flex items-center gap-4 mt-6">
            <button onclick="prevPhoto()"
                    class="bg-white/10 hover:bg-white/20 text-white rounded-full p-3 transition"
                    aria-label="Sebelumnya">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <span id="lightbox-counter" class="text-white/60 text-sm min-w-[60px] text-center"></span>

            <button onclick="nextPhoto()"
                    class="bg-white/10 hover:bg-white/20 text-white rounded-full p-3 transition"
                    aria-label="Berikutnya">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>

    </div>
</div>

@endsection

@push('styles')
<style>
    /* CSS Variable maroon sudah ada di layout */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    /* Fade-up animation — ikuti pola yang sudah ada di layout */
    [data-animate="fade-up"] {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    [data-animate="fade-up"].is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Lightbox tampil sebagai flex saat active */
    /* SESUDAH */
    #lightbox {
        display: none;
        align-items: center;
        justify-content: center;
    }

    #lightbox.active {
        display: flex !important;
    }

    /* Line-clamp fallback */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
// ----------------------------------------------------------------
// Data galeri dari server → array JS
// ----------------------------------------------------------------
const galleryData = @json($galleryJson);

let currentIndex = 0;

// ----------------------------------------------------------------
// Lightbox
// ----------------------------------------------------------------
function openLightbox(index) {
    currentIndex = index;
    renderLightbox();
    const lb = document.getElementById('lightbox');
    lb.style.display = 'flex';
    lb.style.alignItems = 'center';
    lb.style.justifyContent = 'center';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = '';
}

function closeLightboxOnBackdrop(e) {
    // Tutup hanya jika klik di luar #lightbox-inner
    if (!document.getElementById('lightbox-inner').contains(e.target)) {
        closeLightbox();
    }
}

function renderLightbox() {
    const item = galleryData[currentIndex];
    document.getElementById('lightbox-img').src   = item.url;
    document.getElementById('lightbox-img').alt   = item.title;
    document.getElementById('lightbox-title').textContent = item.title;
    document.getElementById('lightbox-counter').textContent =
        (currentIndex + 1) + ' / ' + galleryData.length;

    const catEl = document.getElementById('lightbox-cat');
    if (item.category) {
        catEl.innerHTML = `<span class="inline-block text-xs rounded-full px-3 py-1"
                                  style="background:var(--maroon);color:white;">
                               ${item.category}
                           </span>`;
    } else {
        catEl.innerHTML = '';
    }
}

function prevPhoto() {
    currentIndex = (currentIndex - 1 + galleryData.length) % galleryData.length;
    renderLightbox();
}

function nextPhoto() {
    currentIndex = (currentIndex + 1) % galleryData.length;
    renderLightbox();
}

// Navigasi keyboard
document.addEventListener('keydown', (e) => {
    const lb = document.getElementById('lightbox');
    if (lb.classList.contains('hidden')) return;
    if (e.key === 'ArrowRight') nextPhoto();
    if (e.key === 'ArrowLeft')  prevPhoto();
    if (e.key === 'Escape')     closeLightbox();
});
</script>
@endpush