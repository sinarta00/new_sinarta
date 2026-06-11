@extends('layouts.app')

@section('content')

{{-- Hero Section --}}
<section>
    <div class="container mx-auto px-4 sm:px-6 py-16">

        @php
            $variants = $program->variants;
            $hasVariants = $variants->count() > 1 || $variants->first()?->name !== null;
        @endphp

        {{-- flex-col di mobile (order diatur), flex-row di desktop --}}
        <div class="flex flex-col md:flex-row gap-8">

            {{-- LEFT: Text Content --}}
            <div class="w-full order-2 md:order-1">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-semibold uppercase tracking-widest"
                    style="background: rgba(128,0,32,0.08); color: var(--maroon);">
                    <span class="h-1.5 w-1.5 rounded-full" style="background: var(--maroon);"></span>
                    #GetCertified
                </div>

                {{-- Title --}}
                <h1 class="mb-4 text-3xl font-bold sm:text-4xl lg:text-5xl"
                    style="color: var(--maroon);">
                    {{ $program->title }}
                </h1>

                {{-- Description --}}
                <div class="mb-4 text-base text-justify leading-relaxed text-gray-600 lg:text-lg">
                    {!! $program->description !!}
                </div>

                {{-- Harga --}}
                <div class="mt-8 mb-8">
                    @if($hasVariants)
                        {{-- Program dengan tipe (Personal/Utusan/Online/Offline) --}}
                        <div class="flex gap-6">
                            @foreach($variants as $variant)
                                @php
                                    $hasDiscount = ($variant->discount ?? 0) > 0;
                                    $discountedPrice = $hasDiscount
                                        ? $variant->price - ($variant->price * $variant->discount / 100)
                                        : null;
                                @endphp
                                <div class="flex items-center gap-4 flex-wrap border rounded-xl px-4 py-3 bg-white shadow-sm">
                                    {{-- Badge nama varian --}}
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-bold"
                                        style="background: rgba(128,0,32,0.10); color: var(--maroon);">
                                        {{ $variant->name }}
                                    </span>

                                    {{-- Harga --}}
                                    @if($hasDiscount)
                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-400 line-through">
                                                Rp {{ number_format($variant->price, 0, ',', '.') }}
                                            </span>
                                            <span class="text-xl font-bold" style="color: var(--maroon);">
                                                Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-xl font-bold" style="color: var(--maroon);">
                                            Rp {{ number_format($variant->price, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    @else
                        {{-- Program 1 harga tanpa tipe --}}
                        @php
                            $single = $variants->first();
                            $hasDiscount = ($single?->discount ?? 0) > 0;
                            $discountedPrice = $hasDiscount
                                ? $single->price - ($single->price * $single->discount / 100)
                                : null;
                        @endphp

                        <div class="flex items-center gap-3 flex-wrap">
                            @if($hasDiscount)
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-bold"
                                    style="background: rgba(128,0,32,0.10); color: var(--maroon);">
                                    Promo
                                </span>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-400 line-through">
                                        Rp {{ number_format($single->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-2xl sm:text-3xl font-bold" style="color: var(--maroon);">
                                        Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                    </span>
                                </div>
                            @elseif($single?->price)
                                <span class="text-2xl sm:text-3xl font-bold" style="color: var(--maroon);">
                                    Rp {{ number_format($single->price, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Schedule --}}
                @if($program->schedules->isNotEmpty())
                <div class="relative inline-block mb-4">
                    <button id="scheduleBtn"
                            class="mx-auto px-4 py-2 rounded-lg border font-semibold bg-white transition hover:opacity-90"
                            style="color: var(--maroon-dark);">
                        Jadwal yang akan datang
                    </button>

                    <div id="scheduleDropdown"
                        class="hidden absolute top-full left-0 mt-2 w-80 bg-white rounded-xl shadow-xl border z-50">
                        <div class="p-3 space-y-2 max-h-64 overflow-y-auto">
                            @foreach ($program->schedules as $schedule)
                                <div class="rounded-lg bg-gray-50 p-3">
                                    {{ \Carbon\Carbon::parse($schedule->start_date)->translatedFormat('j F Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($schedule->end_date)->translatedFormat('j F Y') }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <script>
                document.getElementById('scheduleBtn').addEventListener('click', function() {
                    document.getElementById('scheduleDropdown').classList.toggle('hidden');
                });
                </script>
                @endif

                {{-- CTA Buttons --}}
                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">

                    {{-- Tombol Unduh Proposal --}}
                    @if($program->pdf_file ?? null)
                    <a href="{{ asset('storage/' . $program->pdf_file) }}"
                        download
                        onclick="trackClick('hero', 'Unduh Proposal');"
                        class="inline-flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-semibold transition hover:opacity-90 sm:w-auto"
                        style="background: var(--yellow); color: var(--maroon-dark);">
                        Unduh Proposal
                    </a>
                    @endif

                    {{-- Tombol Daftar --}}
                    @if($hasVariants)
                        {{-- Multi varian: tombol per varian --}}
                        @foreach($variants->where('is_active', true) as $variant)
                            @if($variant->registration_link)
                            <a href="{{ $variant->registration_link }}"
                                target="_blank"
                                onclick="trackClick('hero', 'Daftar {{ $variant->name }}');"
                                class="inline-flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-semibold text-white transition hover:opacity-90"
                                style="background: var(--maroon);">
                                Daftar – {{ $variant->name }}
                            </a>
                            @endif
                        @endforeach
                    @else
                        {{-- 1 harga: tombol daftar tunggal --}}
                        @if($variants->first()?->registration_link)
                        <a href="{{ $variants->first()->registration_link }}"
                            target="_blank"
                            onclick="trackClick('hero', 'Daftar Sekarang');"
                            class="inline-flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-semibold text-white transition hover:opacity-90 sm:w-auto"
                            style="background: var(--maroon);">
                            Daftar Sekarang
                        </a>
                        @endif
                    @endif

                </div>
            </div>

            {{-- RIGHT: Visual Card --}}
            <div class="w-full order-1 md:order-2 flex items-center justify-center">
                <div class="relative overflow-hidden rounded-2xl p-6 text-white shadow-xl w-full"
                    style="background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);">
                    <div class="pointer-events-none absolute -top-10 -right-10 h-36 w-36 rounded-full"
                            style="background: rgba(255,215,0,0.12);"></div>
                    <div class="pointer-events-none absolute -bottom-12 -left-6 h-44 w-44 rounded-full"
                            style="background: rgba(255,255,255,0.05);"></div>

                    @if($program->image ?? null)
                    <div class="relative overflow-hidden rounded-xl"
                            style="background: rgba(255,255,255,0.1);">
                        <img src="{{ asset('storage/' . $program->image) }}"
                                alt="{{ $program->title }}"
                                class="h-full w-full object-cover opacity-90 sm:h-56 lg:h-40">
                    </div>
                    @else
                    <div class="w-full h-40 sm:h-56 opacity-90 rounded-xl" style="background: rgba(255,255,255,0.05);"></div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    {{-- Fasilitas & Persyaratan --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 my-4 lg:mt-0 mb-4">
        <div class="mb-8" style="color: var(--maroon);">
            <p class="text-base sm:text-xl text-gray-700 font-medium">
                Mudah & Aman
            </p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#1e3a6e] leading-tight">
                Fasilitas & Persyaratan
            </h2>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white shadow-lg p-6 sm:p-8 lg:p-10">
            <div class="flex flex-col md:flex-row justify-center gap-8">

                {{-- Fasilitas --}}
                <div class="w-full md:w-1/2 md:pr-10 md:border-r md:border-gray-200">
                    <h3 class="text-lg sm:text-xl font-bold text-[#0f172a] mb-4">
                        Fasilitas
                    </h3>

                    @php
                        $features = $program->features
                            ? preg_split('/\r\n|\r|\n/', $program->features)
                            : [];
                    @endphp

                    @if(!empty(array_filter($features)))
                    <ul class="space-y-4">
                        @foreach ($features as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 flex-shrink-0 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12l2.5 2.5L16 9"></path>
                                    </svg>
                                </span>
                                <span class="text-sm sm:text-base leading-snug text-gray-800">
                                    {{ trim($item) }}
                                </span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                    @else
                        <p class="text-sm text-gray-400">Belum ada data fasilitas.</p>
                    @endif
                </div>

                {{-- Divider hanya di mobile --}}
                <div class="block md:hidden border-t border-gray-200"></div>

                {{-- Persyaratan --}}
                <div class="w-full md:w-1/2 md:pl-10">
                    <h3 class="text-lg sm:text-xl font-bold text-[#0f172a] mb-4">
                        Persyaratan Administrasi
                    </h3>

                    @php
                        $requirements = $program->requirements
                            ? preg_split('/\r\n|\r|\n/', $program->requirements)
                            : [];
                    @endphp

                    @if(!empty(array_filter($requirements)))
                    <ul class="space-y-4">
                        @foreach ($requirements as $item)
                            @if(trim($item))
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 flex-shrink-0 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12l2.5 2.5L16 9"></path>
                                    </svg>
                                </span>
                                <span class="text-sm sm:text-base leading-snug text-gray-800">
                                    {{ trim($item) }}
                                </span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                    @else
                        <p class="text-sm text-gray-400">Belum ada data persyaratan.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- Alur Registrasi --}}
    @if($program->registration_flow_image ?? null)
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-10 lg:mt-12">
        <div class="mb-8" style="color: var(--maroon)">
            <p class="text-base sm:text-xl text-gray-700 font-medium">
                Langkah demi Langkah
            </p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#1e3a6e] leading-tight">
                Alur Registrasi
            </h2>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white shadow-lg p-6 sm:p-8 lg:p-10">
            <img
                src="{{ asset('storage/' . $program->registration_flow_image) }}"
                alt="Alur Registrasi {{ $program->title }}"
                class="w-full h-auto rounded-xl object-contain"
            >
        </div>
    </div>
    @endif

</section>

@endsection