<?php

namespace Database\Seeders;

use App\Models\Training;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    public function run(): void
    {
        $trainings = [
            ['training_name' => 'Pelatihan Kejuruan Teknik Pengelasan',       'batch' => '1', 'training_year' => 2023, 'organizer' => 'BNSP'],
            ['training_name' => 'Pelatihan Kejuruan Teknik Pengelasan',       'batch' => '2', 'training_year' => 2023, 'organizer' => 'BNSP'],
            ['training_name' => 'Pelatihan Operator Komputer',                'batch' => '1', 'training_year' => 2023, 'organizer' => 'Kemnaker'],
            ['training_name' => 'Pelatihan Teknisi Listrik',                  'batch' => '1', 'training_year' => 2024, 'organizer' => 'BNSP'],
            ['training_name' => 'Pelatihan Menjahit dan Garmen',              'batch' => '1', 'training_year' => 2024, 'organizer' => 'Kemnaker'],
            ['training_name' => 'Pelatihan Menjahit dan Garmen',              'batch' => '2', 'training_year' => 2024, 'organizer' => 'Kemnaker'],
            ['training_name' => 'Pelatihan Pengolahan Makanan (Food Processing)', 'batch' => '1', 'training_year' => 2024, 'organizer' => 'BNSP'],
            ['training_name' => 'Pelatihan Konstruksi Bangunan',              'batch' => '1', 'training_year' => 2024, 'organizer' => 'Kemnaker'],
            ['training_name' => 'Pelatihan Digital Marketing',                'batch' => '1', 'training_year' => 2025, 'organizer' => 'Kemnaker'],
            ['training_name' => 'Pelatihan Teknisi AC dan Refrigerasi',       'batch' => '1', 'training_year' => 2025, 'organizer' => 'BNSP'],
        ];

        foreach ($trainings as $training) {
            Training::create($training);
        }

        $this->command->info('✅ ' . count($trainings) . ' data pelatihan berhasil ditambahkan.');
    }
}
