@extends('layouts.public')

@section('title', 'Pendaftaran Berhasil')

@push('styles')
<style>
    @keyframes scaleIn {
        from { transform: scale(0.5); opacity: 0; }
        to   { transform: scale(1);   opacity: 1; }
    }
    @keyframes fadeUp {
        from { transform: translateY(20px); opacity: 0; }
        to   { transform: translateY(0);    opacity: 1; }
    }
    .animate-scale-in  { animation: scaleIn 0.5s cubic-bezier(0.34,1.56,0.64,1) forwards; }
    .animate-fade-up-1 { animation: fadeUp 0.5s ease forwards 0.3s;  opacity: 0; }
    .animate-fade-up-2 { animation: fadeUp 0.5s ease forwards 0.45s; opacity: 0; }
    .animate-fade-up-3 { animation: fadeUp 0.5s ease forwards 0.6s;  opacity: 0; }
    .success-card {
        background: white; border-radius: 20px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.08);
        border: 1px solid #e8e0d8;
    }
    .btn-back { background: linear-gradient(135deg,#8B1A1A,#A52020); transition: all 0.2s; }
    .btn-back:hover { background: linear-gradient(135deg,#6B1313,#8B1A1A); box-shadow: 0 4px 12px rgba(139,26,26,.35); transform: translateY(-1px); }
</style>
@endpush

@section('content')
<div class="max-w-lg mx-auto py-8">
    <div class="success-card p-10 text-center">

        <div class="animate-scale-in inline-flex items-center justify-center w-24 h-24 rounded-full mb-6"
             style="background: linear-gradient(135deg,#d4f5e2,#a7f3c4); border: 4px solid #6ee7a4;">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <div class="animate-fade-up-1">
            <div class="accent-line mx-auto mb-4"></div>
            <h2 class="font-serif text-2xl font-semibold text-slate-800 mb-2">Data Berhasil Dikirim!</h2>
            <p class="text-slate-500 text-sm leading-relaxed">
                Terima kasih! Data Anda telah berhasil tersimpan dalam sistem pendataan alumni.
            </p>
        </div>

        <div class="animate-fade-up-2 mt-6 rounded-xl bg-slate-50 border border-slate-100 p-5 text-left">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Informasi Selanjutnya</p>
            <div class="space-y-2.5">
                @foreach ([
                    'Data Anda telah dicatat dalam sistem pendataan alumni BNSP & Kemnaker.',
                    'Tim penyelenggara dapat menghubungi Anda melalui nomor HP atau email yang dimasukkan.',
                    'Simpan nomor HP Anda agar dapat dihubungi untuk informasi lanjutan.',
                ] as $info)
                    <div class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-slate-600 text-xs leading-relaxed">{{ $info }}</p>
                    </div>
                @endforeach
            </div>
        </div>
{{-- 
        <div class="animate-fade-up-3 mt-6">
            <a href="{{ route('alumni.form') }}" class="btn-back block w-full text-white font-semibold py-3.5 px-6 rounded-xl text-sm text-center">
                Daftarkan Alumni Lain
            </a>
        </div> --}}

    </div>
</div>
@endsection
