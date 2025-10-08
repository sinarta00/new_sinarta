<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Popup;
use Carbon\Carbon;

class PopupSeeder extends Seeder
{
    public function run(): void
    {
        Popup::create([
            'title' => 'Promo Spesial Akhir Tahun!',
            'description' => 'Diskon hingga 30% untuk semua program pelatihan. Buruan daftar sebelum kehabisan!',
            'image' => 'popups/promo-sample.jpg', // Ganti dengan path gambar asli
            'link' => '/program',
            'open_new_tab' => false,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
            'order' => 1,
        ]);
    }
}