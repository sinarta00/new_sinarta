<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Pelatihan AK3 Umum Kemnaker',
                'description' => '<p>Program pelatihan Ahli K3 Umum yang diselenggarakan sesuai standar Kementerian Ketenagakerjaan RI. Pelatihan ini bertujuan untuk menghasilkan tenaga ahli K3 yang kompeten dalam mengelola sistem manajemen K3 di perusahaan.</p><p>Materi mencakup peraturan perundangan K3, identifikasi bahaya, penilaian risiko, dan pengendalian risiko K3.</p>',
                'features' => "Sertifikat Kemnaker RI\nModul lengkap dan terbaru\nInstruktur bersertifikat\nPraktek lapangan\nStudi kasus industri\nKonsultasi pasca pelatihan",
                'duration' => '12 Hari',
                'price' => 7500000,
                'category' => 'KEMNAKER',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Sertifikasi Kompetensi BNSP - Teknisi K3',
                'description' => '<p>Sertifikasi profesi untuk teknisi K3 sesuai standar SKKNI. Program ini memberikan pengakuan kompetensi secara nasional bagi para praktisi K3 di berbagai sektor industri.</p><p>Asesmen dilakukan secara komprehensif baik teori maupun praktek oleh asesor BNSP yang kompeten.</p>',
                'features' => "Sertifikat BNSP\nAsesmen teori dan praktek\nDampingi oleh asesor kompeten\nPengakuan nasional\nBerlaku 3 tahun",
                'duration' => '3-5 Hari',
                'price' => 3500000,
                'category' => 'BNSP',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Perpanjangan SKP (Surat Keterangan Pendamping)',
                'description' => '<p>Layanan perpanjangan SKP untuk sertifikat K3 yang akan habis masa berlakunya. Proses cepat dan mudah dengan persyaratan yang minimal.</p><p>SKP diperlukan sebagai pelengkap sertifikat K3 untuk dapat bertugas di lapangan.</p>',
                'features' => "Proses cepat 3-5 hari kerja\nPersyaratan minimal\nBantuan konsultasi dokumen\nLegalisir resmi\nLayanan mutasi SKP",
                'duration' => '3-5 Hari',
                'price' => 1500000,
                'category' => 'SKP',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Training of Trainer (TOT) BNSP',
                'description' => '<p>Pelatihan untuk menjadi asesor kompetensi BNSP yang profesional. Program eksklusif untuk meningkatkan kompetensi dalam melakukan asesmen kompetensi sesuai standar BNSP.</p><p>Peserta akan dibekali kemampuan merencanakan, melaksanakan, dan mengevaluasi asesmen kompetensi.</p>',
                'features' => "Sertifikat asesor BNSP\nMateri sesuai pedoman BNSP\nPraktek asesmen\nMentoring intensif\nNetworking dengan asesor lain\nUpdate regulasi BNSP",
                'duration' => '7 Hari',
                'price' => 12000000,
                'category' => 'TOT',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Pelatihan K3 Konstruksi',
                'description' => '<p>Pelatihan khusus untuk sektor konstruksi yang mencakup standar K3 konstruksi, identifikasi bahaya di proyek konstruksi, dan pengendalian risiko konstruksi.</p><p>Sangat cocok untuk HSE officer, site manager, dan project manager di industri konstruksi.</p>',
                'features' => "Sertifikat pelatihan\nMateri khusus konstruksi\nStudi kasus proyek nyata\nKunjungan lapangan\nPraktek penerapan K3",
                'duration' => '5 Hari',
                'price' => 4500000,
                'category' => 'KEMNAKER',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'title' => 'Pelatihan Petugas P3K (Pertolongan Pertama Pada Kecelakaan)',
                'description' => '<p>Pelatihan untuk menjadi petugas P3K di perusahaan. Peserta akan dibekali pengetahuan dan keterampilan dalam memberikan pertolongan pertama pada kecelakaan kerja.</p><p>Sesuai Permenaker No. 15 Tahun 2008 tentang Pertolongan Pertama Pada Kecelakaan di Tempat Kerja.</p>',
                'features' => "Sertifikat Kemnaker\nPraktek langsung\nMateri CPR dan AED\nPenanganan trauma\nSimulasi kecelakaan kerja\nKit P3K lengkap",
                'duration' => '3 Hari',
                'price' => 2500000,
                'category' => 'KEMNAKER',
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}