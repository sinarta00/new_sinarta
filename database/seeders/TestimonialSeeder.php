<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Budi Santoso',
                'position' => 'HSE Manager',
                'company' => 'PT Energi Jaya Abadi',
                'content' => 'Pelatihan AK3 Umum di SinartaMJS sangat profesional. Instruktur berpengalaman dan materi sangat aplikatif. Sertifikat langsung terbit tanpa hambatan. Highly recommended untuk perusahaan yang ingin upgrade kompetensi K3 karyawannya!',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Siti Maulida',
                'position' => 'K3 Officer',
                'company' => 'PT Maju Bersama Sejahtera',
                'content' => 'Proses perpanjangan SKP sangat cepat dan mudah. Staff sangat responsif dan membantu dari awal sampai selesai. Pelayanan prima dengan harga yang kompetitif. Terima kasih SinartaMJS!',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Putra',
                'position' => 'Safety Supervisor',
                'company' => 'PT Konstruksi Mega',
                'content' => 'Fasilitas pelatihan sangat memadai dan nyaman. Materi up to date sesuai regulasi terbaru. Tim support sangat helpful dari awal sampai akhir. Recommended!',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Dewi Lestari',
                'position' => 'HSE Coordinator',
                'company' => 'PT Industri Manufaktur',
                'content' => 'Saya mengikuti program TOT BNSP di sini. Materinya sangat lengkap dan instruktur sangat kompeten. Sekarang saya sudah jadi asesor BNSP berkat bimbingan dari SinartaMJS. Terima kasih!',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Rizky Firmansyah',
                'position' => 'Safety Engineer',
                'company' => 'PT Pertambangan Nusantara',
                'content' => 'Pelayanan sangat memuaskan. Dari pendaftaran sampai penerbitan sertifikat semua berjalan lancar. Harga juga terjangkau untuk kualitas yang diberikan. Pasti akan recommend ke rekan-rekan lain.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Linda Wijaya',
                'position' => 'HRD Manager',
                'company' => 'PT Teknologi Digital',
                'content' => 'Kami mengirim 10 karyawan untuk pelatihan AK3 Umum. Semuanya lulus dengan hasil memuaskan. Koordinasi dengan tim SinartaMJS sangat baik dan profesional. Akan kerjasama lagi untuk batch berikutnya.',
                'rating' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}