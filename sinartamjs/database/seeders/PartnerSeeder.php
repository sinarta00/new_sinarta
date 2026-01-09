<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Kementerian Ketenagakerjaan RI',
                'logo' => 'partners/kemnaker.png', // Placeholder
                'website' => 'https://kemnaker.go.id',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'BNSP (Badan Nasional Sertifikasi Profesi)',
                'logo' => 'partners/bnsp.png', // Placeholder
                'website' => 'https://bnsp.go.id',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'PT Pertamina',
                'logo' => 'partners/pertamina.png', // Placeholder
                'website' => 'https://pertamina.com',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'PT PLN (Persero)',
                'logo' => 'partners/pln.png', // Placeholder
                'website' => 'https://pln.co.id',
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}