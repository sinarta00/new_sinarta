<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        // ── Bersihkan tabel terkait (urutan penting karena FK) ──
        DB::table('program_schedules')->delete();
        DB::table('program_variants')->delete();
        DB::table('programs')->delete();

        // ════════════════════════════════════════════
        // PROGRAMS
        // ════════════════════════════════════════════
        $programs = [
            [
                'id'          => 1,
                'title'       => 'Ahli K3 Umum',
                'category'    => 'Kemnaker RI',
                'description' => '<p>Program pelatihan dan sertifikasi Ahli Keselamatan dan Kesehatan Kerja (AK3) Umum yang diselenggarakan berdasarkan Permenaker No. 2 Tahun 1992. Peserta akan mendapatkan pemahaman mendalam tentang regulasi K3, manajemen risiko, dan implementasi SMK3 di tempat kerja.</p>',
                'features'    => json_encode([
                    'Materi sesuai regulasi terbaru Kemnaker RI',
                    'Instruktur bersertifikat nasional',
                    'Sertifikat resmi diakui Kemnaker RI',
                    'Modul & bahan ajar lengkap',
                ]),
                'duration'    => '12 Hari',
                'is_active'   => true,
                'order'       => 1,
            ],
            [
                'id'          => 2,
                'title'       => 'Teknisi K3 Listrik',
                'category'    => 'Kemnaker RI',
                'description' => '<p>Pelatihan kompetensi teknis di bidang keselamatan instalasi listrik sesuai Permenaker No. 12 Tahun 2015. Cocok untuk teknisi, supervisor, dan engineer yang bekerja di lingkungan dengan risiko bahaya listrik.</p>',
                'features'    => json_encode([
                    'Praktek langsung instalasi listrik',
                    'Sertifikat Teknisi K3 Listrik Kemnaker RI',
                    'Materi PUIL terbaru',
                    'Fasilitas lab listrik lengkap',
                ]),
                'duration'    => '8 Hari',
                'is_active'   => true,
                'order'       => 2,
            ],
            [
                'id'          => 3,
                'title'       => 'Operator Forklift',
                'category'    => 'Kemnaker RI',
                'description' => '<p>Sertifikasi Operator Forklift kelas I dan II sesuai Permenaker No. 8 Tahun 2020. Program mencakup teori keselamatan, teknik pengoperasian, perawatan harian, dan simulasi praktik lapangan.</p>',
                'features'    => json_encode([
                    'Praktek operasional forklift langsung',
                    'Sertifikat Operator Kelas I & II',
                    'SIO (Surat Izin Operator) resmi',
                    'Tersedia kelas reguler & in-house',
                ]),
                'duration'    => '5 Hari',
                'is_active'   => true,
                'order'       => 3,
            ],
            [
                'id'          => 4,
                'title'       => 'Riksa Uji Pesawat Angkat & Angkut',
                'category'    => 'Kemnaker RI',
                'description' => '<p>Pelatihan dan sertifikasi untuk Ahli K3 Bidang Pesawat Angkat dan Angkut. Meliputi pemeriksaan, pengujian, dan pengawasan crane, hoist, conveyor, dan peralatan angkat lainnya sesuai standar Kemnaker RI.</p>',
                'features'    => json_encode([
                    'Sertifikasi Ahli K3 PAA Kemnaker RI',
                    'Praktek inspeksi alat angkat nyata',
                    'Materi NDT dasar',
                    'Sertifikat berlaku 3 tahun',
                ]),
                'duration'    => '10 Hari',
                'is_active'   => true,
                'order'       => 4,
            ],
            [
                'id'          => 5,
                'title'       => 'Ahli K3 Konstruksi',
                'category'    => 'BNSP',
                'description' => '<p>Sertifikasi kompetensi Ahli K3 Konstruksi dari BNSP berdasarkan SKKNI. Program ini dirancang untuk profesional di bidang konstruksi yang bertanggung jawab terhadap keselamatan kerja proyek.</p>',
                'features'    => json_encode([
                    'Sertifikat BNSP diakui nasional',
                    'Uji kompetensi oleh asesor berlisensi',
                    'Materi SKKNI terkini',
                    'Berlaku untuk tender proyek pemerintah',
                ]),
                'duration'    => '6 Hari',
                'is_active'   => true,
                'order'       => 5,
            ],
            [
                'id'          => 6,
                'title'       => 'Petugas P3K di Tempat Kerja',
                'category'    => 'Kemnaker RI',
                'description' => '<p>Pelatihan Petugas Pertolongan Pertama Pada Kecelakaan (P3K) di tempat kerja sesuai Permenaker No. 15 Tahun 2008. Peserta akan terlatih menangani kedaruratan medis ringan hingga sedang di lingkungan industri.</p>',
                'features'    => json_encode([
                    'Praktek CPR & BLS langsung',
                    'Sertifikat P3K Kemnaker RI',
                    'Kit P3K gratis untuk peserta',
                    'Materi OSHA First Aid',
                ]),
                'duration'    => '3 Hari',
                'is_active'   => true,
                'order'       => 6,
            ],
        ];

        DB::table('programs')->insert(array_map(function ($p) {
            return array_merge($p, [
                'registration_link'        => null,
                'image'                    => null,
                'pdf_file'                 => null,
                'requirements'             => null,
                'registration_flow_image'  => null,
                'created_at'               => now(),
                'updated_at'               => now(),
            ]);
        }, $programs));

        // ════════════════════════════════════════════
        // PROGRAM VARIANTS
        // ════════════════════════════════════════════
        $variants = [
            // AK3 Umum
            ['program_id' => 1, 'name' => 'Online',  'price' => 5500000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+AK3+Umum+Online',  'order' => 1],
            ['program_id' => 1, 'name' => 'Offline', 'price' => 6500000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+AK3+Umum+Offline', 'order' => 2],

            // Teknisi K3 Listrik
            ['program_id' => 2, 'name' => 'Online',  'price' => 4500000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+K3+Listrik+Online',  'order' => 1],
            ['program_id' => 2, 'name' => 'Offline', 'price' => 5200000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+K3+Listrik+Offline', 'order' => 2],

            // Operator Forklift
            ['program_id' => 3, 'name' => 'Offline', 'price' => 3500000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+Forklift', 'order' => 1],

            // Riksa Uji PAA
            ['program_id' => 4, 'name' => 'Online',  'price' => 6000000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+PAA+Online',  'order' => 1],
            ['program_id' => 4, 'name' => 'Offline', 'price' => 6800000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+PAA+Offline', 'order' => 2],

            // AK3 Konstruksi
            ['program_id' => 5, 'name' => 'Online',  'price' => 4800000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+AK3+Konstruksi+Online',  'order' => 1],
            ['program_id' => 5, 'name' => 'Offline', 'price' => 5500000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+AK3+Konstruksi+Offline', 'order' => 2],

            // P3K
            ['program_id' => 6, 'name' => 'Online',  'price' => 2500000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+P3K+Online',  'order' => 1],
            ['program_id' => 6, 'name' => 'Offline', 'price' => 3000000, 'registration_link' => 'https://wa.me/6281351813731?text=Daftar+P3K+Offline', 'order' => 2],
        ];

        DB::table('program_variants')->insert(array_map(function ($v) {
            return array_merge($v, [
                'discount'   => null,
                'duration'   => null,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }, $variants));

        // ════════════════════════════════════════════
        // PROGRAM SCHEDULES
        // ════════════════════════════════════════════
        $now   = Carbon::now();
        $schedules = [];

        // Helper: buat jadwal dari offset minggu
        $make = function (int $programId, int $weeksFromNow, int $durationDays, string $city, int $quota) use ($now, &$schedules) {
            $start = $now->copy()->addWeeks($weeksFromNow)->startOfWeek()->addDays(0); // Senin
            $end   = $start->copy()->addDays($durationDays - 1);
            $schedules[] = [
                'program_id' => $programId,
                'start_date' => $start->toDateString(),
                'end_date'   => $end->toDateString(),
                'city'       => $city,
                'location'   => $city === 'Online' ? 'Zoom Meeting' : 'Gedung Sinarta, ' . $city,
                'quota'      => $quota,
                'registered' => rand(0, (int) ($quota * 0.6)),
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        };

        // AK3 Umum (12 hari) — program_id 1
        $make(1, 1,  12, 'Online',     30);
        $make(1, 2,  12, 'Samarinda',  20);
        $make(1, 4,  12, 'Online',     30);
        $make(1, 6,  12, 'Balikpapan', 20);
        $make(1, 8,  12, 'Online',     30);
        $make(1, 10, 12, 'Jakarta',    25);

        // Teknisi K3 Listrik (8 hari) — program_id 2
        $make(2, 1, 8, 'Online',     25);
        $make(2, 3, 8, 'Samarinda',  15);
        $make(2, 5, 8, 'Online',     25);
        $make(2, 7, 8, 'Balikpapan', 15);

        // Operator Forklift (5 hari) — program_id 3
        $make(3, 1, 5, 'Samarinda',  15);
        $make(3, 3, 5, 'Balikpapan', 15);
        $make(3, 5, 5, 'Samarinda',  15);
        $make(3, 7, 5, 'Jakarta',    20);

        // Riksa Uji PAA (10 hari) — program_id 4
        $make(4, 2,  10, 'Online',     20);
        $make(4, 5,  10, 'Samarinda',  15);
        $make(4, 9,  10, 'Online',     20);
        $make(4, 12, 10, 'Balikpapan', 15);

        // AK3 Konstruksi (6 hari) — program_id 5
        $make(5, 1, 6, 'Online',     25);
        $make(5, 3, 6, 'Samarinda',  15);
        $make(5, 6, 6, 'Online',     25);
        $make(5, 8, 6, 'Makassar',   15);

        // P3K (3 hari) — program_id 6
        $make(6, 1, 3, 'Online',     30);
        $make(6, 2, 3, 'Samarinda',  20);
        $make(6, 3, 3, 'Balikpapan', 20);
        $make(6, 4, 3, 'Online',     30);
        $make(6, 5, 3, 'Jakarta',    20);

        DB::table('program_schedules')->insert($schedules);

        $this->command->info('✅ Seeder selesai:');
        $this->command->info('   - ' . count($programs) . ' programs');
        $this->command->info('   - ' . count($variants) . ' variants');
        $this->command->info('   - ' . count($schedules) . ' schedules');
    }
}