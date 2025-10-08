<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Pelatihan AK3 Umum',
                'description' => 'Pelatihan Ahli K3 Umum dengan sertifikat Kemnaker untuk meningkatkan kompetensi di bidang K3. Program ini dirancang untuk memenuhi standar keselamatan kerja nasional.',
                'icon' => 'shield-check',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Sertifikasi BNSP',
                'description' => 'Program sertifikasi kompetensi dari Badan Nasional Sertifikasi Profesi sesuai standar SKKNI. Mendapatkan pengakuan kompetensi secara nasional.',
                'icon' => 'document-check',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Perpanjangan SKP',
                'description' => 'Layanan perpanjangan dan mutasi Surat Keterangan Pendamping untuk sertifikat K3. Proses cepat dan mudah dengan dukungan penuh.',
                'icon' => 'refresh',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Pelatihan TOT BNSP',
                'description' => 'Training of Trainer untuk menjadi asesor kompetensi BNSP yang profesional dan tersertifikasi. Membuka peluang karir sebagai trainer K3.',
                'icon' => 'academic-cap',
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}