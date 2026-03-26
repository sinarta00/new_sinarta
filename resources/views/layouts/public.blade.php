<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pendataan Alumni Pelatihan') — BNSP & Kemnaker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #FAF7F2; }
        .font-serif { font-family: 'Lora', serif; }
        .hero-bg {
            background: linear-gradient(135deg, #6B1313 0%, #8B1A1A 55%, #A52020 100%);
        }
        .accent-line {
            width: 48px; height: 4px;
            background: #C0392B; border-radius: 2px;
        }
        .dot-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='2' cy='2' r='1.5' fill='%23ffffff' fill-opacity='0.08'/%3E%3C/svg%3E");
        }
    </style>
    @stack('styles')
</head>
<body class="h-full bg-slate-50">

    <header class="hero-bg dot-pattern shadow-xl">
        <div class="max-w-5xl mx-auto px-4 py-6">
            <div class="flex items-center gap-4">
                <div>
                    <p class="text-red-700 text-xs font-bold tracking-widest uppercase">Sistem Pendataan Alumni</p>
                    <h1 class="text-red-800 font-serif text-xl font-semibold leading-tight">Pelatihan BNSP & Kemnaker</h1>
                    <p class="text-red-500 text-xs mt-0.5">Badan Nasional Sertifikasi Profesi · Kementerian Ketenagakerjaan RI</p>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-10">
        @yield('content')
    </main>

    <footer class="border-t border-stone-200 bg-white mt-16">
        <div class="max-w-5xl mx-auto px-4 py-6 text-center">
            <p class="text-slate-400 text-sm">
                &copy; {{ date('Y') }} Sistem Pendataan Alumni Pelatihan BNSP & Kemnaker.
            </p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
