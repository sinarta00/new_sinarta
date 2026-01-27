<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            
            'expertise_fields' => 'required|array|min:1',
            'expertise_fields.*' => 'string',
            'other_expertise' => 'nullable|string|max:500',
            
            'cv_file' => 'required|file|mimes:pdf|max:5120', // 5MB
            'certificate_files' => 'required|array|min:1',
            'certificate_files.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
            
            'availability_time' => 'required|array|min:1',
            'availability_time.*' => 'string|in:weekday,weekend,malam,jam_kerja',
            
            'availability_programs' => 'required|array|min:1',
            'availability_programs.*' => 'string',
            
            'motivation' => 'required|string|max:2000',
            'usulan_kegiatan_dan_materi' => 'required|string|max:2000',
            
            'recaptcha_token' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => 'nama lengkap',
            'city' => 'kota domisili',
            'whatsapp' => 'nomor WhatsApp',
            'email' => 'email',
            'expertise_fields' => 'bidang keahlian',
            'other_expertise' => 'topik lainnya',
            'cv_file' => 'CV',
            'certificate_files' => 'sertifikat',
            'availability_time' => 'kesediaan waktu',
            'availability_programs' => 'program yang diminati',
            'motivation' => 'motivasi',
            'usulan_kegiatan_dan_materi' => 'usulan kegiatan dan materi'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'email' => ':attribute harus berupa email yang valid.',
            'max' => ':attribute maksimal :max karakter.',
            'array' => ':attribute harus berupa pilihan.',
            'min' => ':attribute minimal :min pilihan.',
            'mimes' => ':attribute harus berupa file :values.',
            'file.max' => 'Ukuran :attribute maksimal 5MB.',
            'usulan_kegiatan_dan_materi.required' => 'Usulan kegiatan dan materi wajib diisi.',
        ];
    }
}