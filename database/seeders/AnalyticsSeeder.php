<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageView;
use App\Models\PageClick;
use Carbon\Carbon;

class AnalyticsSeeder extends Seeder
{
    public function run(): void
    {
        // Generate page views untuk 7 hari terakhir
        $pages = ['Home', 'Program', 'Layanan', 'Tentang Kami', 'Kontak'];
        $devices = ['mobile', 'desktop', 'tablet'];

        for ($i = 7; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $viewsCount = rand(20, 100); // Random 20-100 views per hari

            for ($j = 0; $j < $viewsCount; $j++) {
                PageView::create([
                    'page_url' => url('/'),
                    'page_name' => $pages[array_rand($pages)],
                    'ip_address' => '192.168.1.' . rand(1, 255),
                    'user_agent' => 'Mozilla/5.0',
                    'device_type' => $devices[array_rand($devices)],
                    'referer' => 'https://google.com',
                    'visited_at' => $date->addHours(rand(8, 20))->addMinutes(rand(0, 59)),
                ]);
            }
        }

        // Generate clicks
        $clickTypes = ['whatsapp', 'program', 'service', 'contact'];
        
        for ($i = 7; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $clicksCount = rand(10, 50);

            for ($j = 0; $j < $clicksCount; $j++) {
                PageClick::create([
                    'click_type' => $clickTypes[array_rand($clickTypes)],
                    'click_label' => 'Test Click',
                    'page_url' => url('/'),
                    'ip_address' => '192.168.1.' . rand(1, 255),
                    'clicked_at' => $date->addHours(rand(8, 20))->addMinutes(rand(0, 59)),
                ]);
            }
        }

        $this->command->info('Analytics data seeded successfully!');
    }
}