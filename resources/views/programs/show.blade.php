@extends('layouts.app')

@section('content')

{{-- Hero Section --}}
<section class="lg:py-24">
    <div class="container mx-auto px-4 sm:px-6 py-16">

        {{-- flex-col di mobile (order diatur), flex-row di desktop --}}
        <div class="flex flex-col md:flex-row gap-8">

            {{-- LEFT: Text Content — order-2 di mobile (tampil bawah), order-none di lg --}}
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
                @php
                    $price = $program->price;
                    $discountPercent = $program->discount ?? 0;
                    $hasDiscount = $discountPercent > 0;
                    $discountedPrice = $hasDiscount
                        ? $price - ($price * $discountPercent / 100)
                        : null;
                @endphp

                <div class="mt-4 mb-4 flex items-center gap-3 flex-wrap">
                    @if($hasDiscount)
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-bold"
                            style="background: rgba(128,0,32,0.10); color: var(--maroon);">
                            Promo
                        </span>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-400" style="text-decoration: line-through;">
                                Rp {{ number_format($price, 0, ',', '.') }}
                            </span>
                            <span class="text-2xl sm:text-3xl font-bold" style="color: var(--maroon);">
                                Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                            </span>
                        </div>
                    @else
                        <span class="text-2xl sm:text-3xl font-bold" style="color: var(--maroon);">
                            Rp {{ number_format($price, 0, ',', '.') }}
                        </span>
                    @endif
                </div>

                {{-- Schedule --}}
                <p class="mb-4 text-sm sm:text-base" style="color: var(--maroon-dark);">
                    <span class="font-semibold">Jadwal yang akan datang:</span>
                    @foreach ($program->schedules as $schedule)
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($schedule->start_date)->translatedFormat('j F Y') }}</span>
                        -
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($schedule->end_date)->translatedFormat('j F Y') }}</span>
                        @if (!$loop->last)
                            <span class="font-bold text-xl">|</span>
                        @endif
                    @endforeach
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">

                    @if($program->pdf_file ?? null)
                    <a href="{{ asset('storage/' . $program->pdf_file) }}"
                        download
                        onclick="trackClick('hero', 'Unduh Proposal');"
                        class="inline-flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-semibold transition hover:opacity-90 sm:w-auto"
                        style="background: var(--yellow); color: var(--maroon-dark);">
                        Unduh Proposal
                    </a>
                    @endif

                    @if($program->registration_link ?? null)
                    <a href="{{ $program->registration_link }}"
                        target="_blank"
                        onclick="trackClick('hero', 'Daftar Sekarang');"
                        class="inline-flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-semibold text-white transition hover:opacity-90 sm:w-auto"
                        style="background: var(--maroon);">
                        Daftar Sekarang
                    </a>
                    @endif
                </div>
            </div>

            {{-- RIGHT: Visual Card — order-1 di mobile (tampil atas), order-none di lg --}}
            <div class="w-full order-1 md:order-2">
                <div class="relative overflow-hidden rounded-2xl p-6 text-white shadow-xl"
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
                   <div class="w-full h-40 sm:h-56 opacity-90" style="background: var(--maroon);">
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
                        $features = preg_split('/\r\n|\r|\n/', $program->features);
                        $requirements = preg_split('/\r\n|\r|\n/', $program->requirements);
                    @endphp

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
                </div>

                {{-- Divider hanya di mobile --}}
                <div class="block md:hidden border-t border-gray-200"></div>

                {{-- Persyaratan --}}
                <div class="w-full md:w-1/2 md:pl-10">
                    <h3 class="text-lg sm:text-xl font-bold text-[#0f172a] mb-4">
                        Persyaratan Administrasi
                    </h3>

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
                            @else
                            <span class="text-sm sm:text-base leading-snug text-gray-800">Data not found</span>
                            @endif
                        @endforeach
                    </ul>
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