<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorPageContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            [
                'section_key' => 'hero',
                'content' => json_encode([
                    'title' => 'Join as Instructor',
                    'subtitle' => 'Dengan pengalaman yang anda miliki, mari bersama mencetak tenaga kerja yang lebih kompeten dan membangun budaya keselamatan yang berkelanjutan',
                    'description' => 'Setiap langkah menuju keselamatan dimulai dari pengetahuan. Dengan pengalaman Anda sebagai profesional K3, kini saatnya berbagi pengalaman dan menginspirasi generasi berikutnya. Melalui ruang ini, kami menghadirkan kesempatan untuk mengajar, membimbing, dan meninggalkan jejak berarti dalam pembangunan budaya keselamatan yang berkelanjutan.'
                ]),
                'is_active' => true,
            ],
            [
                'section_key' => 'programs',
                'content' => json_encode([
                    [
                        'title' => 'Pelatihan Sertifikasi Kemnaker RI',
                        'description' => 'Program pelatihan yang mengeluarkan sertifikat resmi dari Kementerian Ketenagakerjaan RI untuk berbagai bidang K3'
                    ],
                    [
                        'title' => 'Pelatihan Kompetensi BNSP RI',
                        'description' => 'Sertifikasi kompetensi sesuai standar BNSP untuk meningkatkan profesionalisme di bidang K3'
                    ],
                    [
                        'title' => 'Pelatihan Teknis & Spesialisasi',
                        'description' => 'Pelatihan khusus untuk mengembangkan keahlian teknis dan spesialisasi di berbagai aspek K3'
                    ],
                    [
                        'title' => 'Pelatihan Inhouse dan Sesuai Kebutuhan Perusahaan',
                        'description' => 'Pelatihan yang disesuaikan dengan kebutuhan spesifik perusahaan dan dilaksanakan di lokasi klien'
                    ],
                    [
                        'title' => 'Miniclass',
                        'description' => 'Kelas kecil dengan fokus pembelajaran intensif untuk topik-topik K3 tertentu'
                    ],
                    [
                        'title' => 'Sinartalks',
                        'description' => 'Sesi berbagi pengalaman dan diskusi interaktif seputar praktik terbaik K3 di industri'
                    ]
                ]),
                'is_active' => true,
            ],
            [
                'section_key' => 'requirements',
                'content' => json_encode([
                    'Memiliki keahlian dan sertifikasi yang relevan',
                    'Berpengalaman dalam berbagai pengetahuan K3',
                    'Komitmen terhadap profesionalisme'
                ]),
                'is_active' => true,
            ],
            [
                'section_key' => 'benefits',
                'content' => json_encode([
                    [
                        'title' => 'Kesempatan Berbagi dan Menginspirasi',
                        'description' => 'Menyalurkan pengalaman serta wawasan nyata di bidang K3 kepada peserta pelatihan dari berbagai sektor industri, sekaligus menjadi bagian dari proses pembentukan generasi praktisi K3 yang kompeten.'
                    ],
                    [
                        'title' => 'Jaringan Profesional yang Lebih Luas',
                        'description' => 'Terhubung dengan para instruktur, perusahaan pengguna jasa, serta komunitas K3 yang terus berkembang — membuka peluang kolaborasi lintas sektor.'
                    ],
                    [
                        'title' => 'Penghargaan yang Layak',
                        'description' => 'Mendapatkan honor sesuai skema pelatihan, dengan peluang kerja sama berkelanjutan dan pengakuan profesional dari lembaga pelatihan resmi.'
                    ],
                    [
                        'title' => 'Reputasi dan Dampak Positif',
                        'description' => 'Berperan aktif dalam membangun budaya keselamatan di tempat kerja, sekaligus memperkuat kredibilitas sebagai praktisi K3 yang berkompeten dan berpengaruh.'
                    ],
                    [
                        'title' => 'Pengembangan Kompetensi Berkelanjutan',
                        'description' => 'Akses prioritas untuk mengikuti pelatihan, seminar, atau workshop pengembangan diri yang mendukung peningkatan keahlian dan sertifikasi lanjutan.'
                    ],
                    [
                        'title' => 'Kesempatan Menjadi Narasumber Nasional',
                        'description' => 'Instruktur berprestasi berpeluang diundang dalam kegiatan tingkat regional atau nasional sebagai pembicara maupun fasilitator pelatihan.'
                    ]
                ]),
                'is_active' => true,
            ],
            [
                'section_key' => 'contact',
                'content' => json_encode([
                    'help_text' => 'Kesulitan daftar? Hubungi admin kami',
                    'whatsapp' => '6281351813731',
                    'contact_name' => 'Admin Sinarta'
                ]),
                'is_active' => true,
            ]
        ];

        foreach ($contents as $content) {
            DB::table('instructor_page_contents')->insert(array_merge($content, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}