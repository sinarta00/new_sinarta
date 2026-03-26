<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Training;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlumniController extends Controller
{
    public function showForm(): View
    {
        $trainings = Training::orderBy('training_year', 'desc')
            ->orderBy('training_name')
            ->orderBy('batch')
            ->get();

        return view('alumni.form', compact('trainings'));
    }

    public function submitForm(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'email'               => ['nullable', 'email', 'max:255'],
            'phone'               => ['required', 'string', 'max:20'],
            'training_id'         => ['required', 'exists:trainings,id'],
            'is_working'          => ['required', 'boolean'],
            'has_skp'             => ['required', 'boolean'],
            'skp_expired_date'    => ['nullable', 'date', 'required_if:has_skp,1'],
            'work_photo'          => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'allow_publish_photo' => ['nullable', 'boolean'],
            'company_name' => ['nullable', 'string', 'max:255', 'required_if:is_working,1'],
            'job_position' => ['nullable', 'string', 'max:255', 'required_if:is_working,1'],
        ], [
            'name.required'                => 'Nama lengkap wajib diisi.',
            'email.email'                  => 'Format email tidak valid.',
            'phone.required'               => 'Nomor HP wajib diisi.',
            'phone.max'                    => 'Nomor HP maksimal 20 karakter.',
            'training_id.required'         => 'Silakan pilih pelatihan.',
            'training_id.exists'           => 'Pelatihan yang dipilih tidak valid.',
            'is_working.required'          => 'Status pekerjaan wajib dipilih.',
            'has_skp.required'             => 'Status kepemilikan SKP wajib dipilih.',
            'skp_expired_date.required_if' => 'Tanggal expired SKP wajib diisi jika memiliki SKP.',
            'skp_expired_date.date'        => 'Format tanggal expired SKP tidak valid.',
            'work_photo.image'             => 'File yang diunggah harus berupa gambar.',
            'work_photo.mimes'             => 'Format foto harus JPG atau PNG.',
            'work_photo.max'               => 'Ukuran foto maksimal 5 MB.',
            'company_name.required_if' => 'Nama perusahaan wajib diisi jika sudah bekerja.',
            'job_position.required_if' => 'Posisi/jabatan wajib diisi jika sudah bekerja.',
        ]);

        // Handle file upload
        if ($request->hasFile('work_photo')) {
            $validated['work_photo'] = $request->file('work_photo')
                ->store('alumni/photos', 'public');
        }

        // Checkbox — kalau tidak dicentang maka tidak ada di request
        $validated['allow_publish_photo'] = $request->boolean('allow_publish_photo');

        Alumni::create($validated);

        return redirect()->route('alumni.success');
    }

    public function success(): View
    {
        return view('alumni.success');
    }
}
