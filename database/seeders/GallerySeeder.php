<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        // Foto fallback statis dari public/images/
        $fallbackPhoto = 'images/about_photo.jpg';

        $items = [
            [
                'title'      => 'Pelatihan AK3 Umum Batch 1',
                'category'   => 'Pelatihan',
                'sort_order' => 1,
            ],
            [
                'title'      => 'Sertifikasi K3 Angkatan 2',
                'category'   => 'Sertifikasi',
                'sort_order' => 2,
            ],
            [
                'title'      => 'Pembukaan Program K3 Konstruksi',
                'category'   => 'Pelatihan',
                'sort_order' => 3,
            ],
            [
                'title'      => 'Kegiatan Praktik Lapangan',
                'category'   => 'Kegiatan',
                'sort_order' => 4,
            ],
            [
                'title'      => 'Wisuda Peserta AK3 Umum',
                'category'   => 'Sertifikasi',
                'sort_order' => 5,
            ],
            [
                'title'      => 'Seminar K3 Nasional',
                'category'   => 'Kegiatan',
                'sort_order' => 6,
            ],
        ];

        foreach ($items as $item) {
            // Cek apakah file fisik ada di public/
            $photoExists = File::exists(public_path($fallbackPhoto));

            Gallery::create([
                'title'      => $item['title'],
                'category'   => $item['category'],
                'sort_order' => $item['sort_order'],
                'is_active'  => true,
                // Kalau foto ada pakai fallback, kalau tidak ada tetap isi
                // string path-nya (tidak akan crash, hanya gambar tidak tampil)
                'image_path' => $photoExists ? $fallbackPhoto : $fallbackPhoto,
            ]);
        }

        $this->command->info('GallerySeeder: ' . count($items) . ' item berhasil dibuat.');

        if (!File::exists(public_path($fallbackPhoto))) {
            $this->command->warn('Peringatan: File ' . $fallbackPhoto . ' tidak ditemukan di folder public/.');
            $this->command->warn('Foto tidak akan tampil sampai file tersedia.');
        }
    }
}