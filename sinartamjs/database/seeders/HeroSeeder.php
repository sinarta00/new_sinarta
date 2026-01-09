<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hero;

class HeroSeeder extends Seeder
{
    public function run(): void
    {
        Hero::create([
            'title' => 'Pelatihan & Sertifikasi K3 Profesional',
            'subtitle' => 'PT Sinarta Multi Jasa Sertifikasi menyediakan pelatihan AK3 Umum Kemnaker, BNSP, Perpanjangan SKP, dan TOT BNSP dengan instruktur berpengalaman dan fasilitas terbaik.',
            'button_text' => 'Lihat Program',
            'button_link' => '/program',
            'is_active' => true,
            'order' => 1,
        ]);

        Hero::create([
            'title' => 'Tingkatkan Kompetensi K3 Anda',
            'subtitle' => 'Dapatkan sertifikat resmi dari Kemnaker dan BNSP dengan metode pembelajaran modern dan instruktur bersertifikat',
            'button_text' => 'Hubungi Kami',
            'button_link' => '/kontak',
            'is_active' => true,
            'order' => 2,
        ]);
    }
}