@extends('layouts.public')

@section('title', 'Form Pendaftaran Alumni')

@push('styles')
<style>
    .form-card {
        background: white; border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07), 0 1px 4px rgba(0,0,0,0.04);
        border: 1px solid #e8e0d8;
    }
    .input-field { transition: border-color 0.2s, box-shadow 0.2s; }
    .input-field:focus {
        border-color: #8B1A1A;
        box-shadow: 0 0 0 3px rgba(139,26,26,0.1);
        outline: none;
    }
    .btn-primary {
        background: linear-gradient(135deg, #8B1A1A, #A52020);
        transition: all 0.2s;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #6B1313, #8B1A1A);
        box-shadow: 0 4px 12px rgba(139,26,26,0.35);
        transform: translateY(-1px);
    }
    .btn-primary:active { transform: translateY(0); }
    .step-badge {
        background: #8B1A1A;
        color: #fff; font-weight: 700;
        border-radius: 50%; width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; flex-shrink: 0;
    }
</style>
@endpush

@section('content')

<div class="mb-8">
    <div class="accent-line mb-4"></div>
    <h2 class="font-serif text-2xl font-semibold text-slate-800">Formulir Pendataan Alumni Pelatihan</h2>
    <p class="text-slate-500 mt-2 text-sm leading-relaxed">
        Silakan isi data diri Anda dengan lengkap dan benar untuk keperluan pendataan alumni AK3U BNSP & Kemnaker.
    </p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- Form Utama --}}
    <div class="lg:col-span-2">
        <div class="form-card p-8">
            <h3 class="font-semibold text-slate-700 text-base mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Data Peserta
            </h3>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-red-700 font-semibold text-sm">Mohon perbaiki kesalahan berikut:</p>
                            <ul class="mt-1 list-disc list-inside text-red-600 text-sm space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('alumni.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap sesuai KTP"
                        class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm bg-slate-50 placeholder-slate-400 @error('name') border-red-400 bg-red-50 @enderror">
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Alamat Email <span class="text-slate-400 font-normal text-xs">(opsional)</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm bg-slate-50 placeholder-slate-400 @error('email') border-red-400 bg-red-50 @enderror">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor HP --}}
                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Nomor HP / WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-medium">+62</span>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            placeholder="8xx-xxxx-xxxx"
                            class="input-field w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm bg-slate-50 placeholder-slate-400 @error('phone') border-red-400 bg-red-50 @enderror">
                    </div>
                    @error('phone')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pilih Pelatihan --}}
                <div>
                    <label for="training_id" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Pelatihan yang Diikuti <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="training_id" name="training_id"
                            class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm bg-slate-50 appearance-none @error('training_id') border-red-400 bg-red-50 @enderror">
                            <option value="">— Pilih Pelatihan —</option>
                            @foreach ($trainings as $training)
                                <option value="{{ $training->id }}" {{ old('training_id') == $training->id ? 'selected' : '' }}>
                                    {{ $training->training_name }} {{ $training->organizer }} — Batch {{ $training->batch }}
                                </option>
                            @endforeach
                        </select>
                        <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    @error('training_id')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Bekerja --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Apakah saat ini sudah bekerja? <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-3">
                        <label class="radio-option flex-1 flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer transition-all hover:border-red-300 has-[:checked]:border-red-700 has-[:checked]:bg-red-50">
                            <input type="radio" name="is_working" value="1" class="accent-red-700"
                                {{ old('is_working') === '1' ? 'checked' : '' }} onchange="toggleWorkDetails(this)">
                            <span class="text-sm text-slate-700 font-medium">Sudah Bekerja</span>
                        </label>
                        <label class="radio-option flex-1 flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer transition-all hover:border-red-300 has-[:checked]:border-red-700 has-[:checked]:bg-red-50">
                            <input type="radio" name="is_working" value="0" onchange="toggleWorkDetails(this) class="accent-red-700"
                                {{ old('is_working') === '0' ? 'checked' : '' }} >
                            <span class="text-sm text-slate-700 font-medium">Belum Bekerja</span>
                        </label>
                    </div>
                    @error('is_working')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Detail Pekerjaan --}}
                <div id="work_details_wrapper" class="{{ old('is_working') === '1' ? '' : 'hidden' }}">
                    <div class="space-y-4 p-4 rounded-xl bg-red-50/50 border border-red-100">
                        <p class="text-xs font-semibold text-red-800 uppercase tracking-wider">Detail Pekerjaan</p>

                        <div>
                            <label for="company_name" class="block text-sm font-semibold text-slate-700 mb-1.5">
                                Nama Perusahaan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="company_name" name="company_name"
                                value="{{ old('company_name') }}"
                                placeholder="Contoh: PT. Pertamina"
                                class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm bg-white placeholder-slate-400 @error('company_name') border-red-400 bg-red-50 @enderror">
                            @error('company_name')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="job_position" class="block text-sm font-semibold text-slate-700 mb-1.5">
                                Posisi / Jabatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="job_position" name="job_position"
                                value="{{ old('job_position') }}"
                                placeholder="Contoh: Teknisi Listrik"
                                class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm bg-white placeholder-slate-400 @error('job_position') border-red-400 bg-red-50 @enderror">
                            @error('job_position')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Status SKP --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Apakah sudah memiliki SKP & Lisensi? <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-3">
                        <label class="radio-option flex-1 flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer transition-all hover:border-red-300 has-[:checked]:border-red-700 has-[:checked]:bg-red-50">
                            <input type="radio" name="has_skp" value="1" id="has_skp_yes" class="accent-red-700"
                                {{ old('has_skp') === '1' ? 'checked' : '' }}
                                onchange="toggleSkpDate(this)">
                            <span class="text-sm text-slate-700 font-medium">Punya SKP & Lisensi</span>
                        </label>
                        <label class="radio-option flex-1 flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer transition-all hover:border-red-300 has-[:checked]:border-red-700 has-[:checked]:bg-red-50">
                            <input type="radio" name="has_skp" value="0" id="has_skp_no" class="accent-red-700"
                                {{ old('has_skp', '0') === '0' ? 'checked' : '' }}
                                onchange="toggleSkpDate(this)">
                            <span class="text-sm text-slate-700 font-medium">Belum Punya SKP & Lisensi</span>
                        </label>
                    </div>
                    @error('has_skp')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Expired SKP --}}
                <div id="skp_date_wrapper" class="{{ old('has_skp') === '1' ? '' : 'hidden' }}">
                    <label for="skp_expired_date" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Tanggal Expired SKP <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="date"
                        id="skp_expired_date"
                        name="skp_expired_date"
                        value="{{ old('skp_expired_date') }}"
                        class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm bg-slate-50 @error('skp_expired_date') border-red-400 bg-red-50 @enderror">
                    @error('skp_expired_date')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Foto Sedang Bekerja --}}
                <div>
                    <label for="work_photo" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Foto diri (mengenakan seragam kerja)
                        <span class="text-slate-400 font-normal text-xs">(opsional)</span>
                    </label>
                    <div id="photo_dropzone"
                         class="relative border-2 border-dashed border-slate-200 rounded-xl bg-slate-50 p-6 text-center cursor-pointer transition-all hover:border-red-400 hover:bg-red-50/30 @error('work_photo') border-red-400 bg-red-50 @enderror"
                         onclick="document.getElementById('work_photo').click()">

                        {{-- Preview --}}
                        <div id="photo_preview_wrapper" class="hidden mb-4">
                            <img id="photo_preview" src="" alt="Preview" class="mx-auto max-h-48 rounded-lg object-cover shadow-sm">
                        </div>

                        {{-- Placeholder icon --}}
                        <div id="photo_placeholder">
                            <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-slate-500 font-medium">Klik untuk pilih foto</p>
                            <p class="text-xs text-slate-400 mt-1">JPG, PNG · Maks 5 MB</p>
                        </div>

                        {{-- File name display --}}
                        <p id="photo_filename" class="hidden text-xs text-slate-500 mt-2"></p>

                        <input
                            type="file"
                            id="work_photo"
                            name="work_photo"
                            accept=".jpg,.jpeg,.png"
                            class="hidden"
                            onchange="previewPhoto(this)">
                    </div>
                    @error('work_photo')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Izin Publish Foto --}}
                <div>
                    <label class="flex items-start gap-3 p-4 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer transition-all hover:border-red-300 hover:bg-red-50/30 has-[:checked]:border-red-700 has-[:checked]:bg-red-50">
                        <input
                            type="checkbox"
                            name="allow_publish_photo"
                            value="1"
                            class="mt-0.5 w-4 h-4 accent-red-700 flex-shrink-0"
                            {{ old('allow_publish_photo') ? 'checked' : '' }}>
                        <div>
                            <p class="text-sm font-semibold text-slate-700">Izin Publikasi Foto</p>
                            <p class="text-xs text-slate-500 mt-0.5 leading-relaxed">
                                Saya bersedia foto saya dipublikasikan di media sosial PT Sinarta MJS sebagai bagian dari dokumentasi alumni pelatihan.
                            </p>
                        </div>
                    </label>
                    @error('allow_publish_photo')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 border-t border-slate-100">
                    <p class="text-xs text-slate-400 mb-4"><span class="text-red-500">*</span> Wajib diisi.</p>
                    <button type="submit" class="btn-primary w-full text-white font-semibold py-3.5 px-6 rounded-xl text-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-5">
        <div class="form-card p-6">
            <h4 class="font-semibold text-stone-700 text-sm mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                Panduan Pengisian
            </h4>
            <div class="space-y-3">
                @foreach ([
                    ['1', 'Isi nama lengkap sesuai KTP atau ijazah Anda.'],
                    ['2', 'Email bersifat opsional namun membantu komunikasi.'],
                    ['3', 'Masukkan nomor HP aktif yang bisa dihubungi.'],
                    ['4', 'Pilih pelatihan sesuai yang Anda ikuti.'],
                ] as [$no, $text])
                    <div class="flex items-start gap-3">
                        <div class="step-badge">{{ $no }}</div>
                        <p class="text-stone-500 text-xs leading-relaxed pt-0.5">{{ $text }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-xl bg-red-50 border border-red-100 p-5">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-700 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <div>
                    <p class="text-red-900 font-semibold text-xs">Keamanan Data</p>
                    <p class="text-red-700 text-xs mt-1 leading-relaxed">Data Anda disimpan secara aman dan hanya digunakan untuk keperluan resmi pendataan.</p>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-stone-50 border border-stone-200 p-5">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-stone-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-stone-700 font-semibold text-xs">Butuh Bantuan?</p>
                    <p class="text-stone-500 text-xs mt-1 leading-relaxed">Jika pelatihan tidak tersedia, hubungi penyelenggara pelatihan Anda.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function toggleWorkDetails(radio) {
        const wrapper = document.getElementById('work_details_wrapper');
        if (radio.value === '1') {
            wrapper.classList.remove('hidden');
        } else {
            wrapper.classList.add('hidden');
            document.getElementById('company_name').value = '';
            document.getElementById('job_position').value = '';
        }
    }

    function toggleSkpDate(radio) {
        const wrapper = document.getElementById('skp_date_wrapper');
        const dateInput = document.getElementById('skp_expired_date');
        if (radio.value === '1') {
            wrapper.classList.remove('hidden');
            dateInput.required = true;
        } else {
            wrapper.classList.add('hidden');
            dateInput.required = false;
            dateInput.value = '';
        }
    }

    function previewPhoto(input) {
        const preview     = document.getElementById('photo_preview');
        const previewWrap = document.getElementById('photo_preview_wrapper');
        const placeholder = document.getElementById('photo_placeholder');
        const filename    = document.getElementById('photo_filename');

        if (input.files && input.files[0]) {
            const file   = input.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                previewWrap.classList.remove('hidden');
                placeholder.classList.add('hidden');
                filename.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                filename.classList.remove('hidden');
            };

            reader.readAsDataURL(file);
        }
    }

    // Jalankan saat halaman load (untuk kasus old() setelah validation error)
    document.addEventListener('DOMContentLoaded', function () {
        const checked = document.querySelector('input[name="has_skp"]:checked');
        if (checked) toggleSkpDate(checked);

        const checkedWork = document.querySelector('input[name="is_working"]:checked');
if (    checkedWork) toggleWorkDetails(checkedWork);
    });
</script>
@endpush
