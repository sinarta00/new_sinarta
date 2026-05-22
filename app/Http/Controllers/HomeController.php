<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Hero;
use App\Models\Service;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Popup;
use App\Models\ProgramSchedule;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $heroes       = Hero::where('is_active', true)->orderBy('order')->get();
        $services     = Service::where('is_active', true)->orderBy('order')->get();
        $programs     = Program::where('is_active', true)->orderBy('order')->limit(6)->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->limit(6)->get();
        $partners     = Partner::where('is_active', true)->orderBy('order')->get();
        $popup        = Popup::active()->orderBy('order')->first();

        // ── Jadwal Terdekat ──────────────────────────────
        $scheduleQuery = ProgramSchedule::with(['program.variants' => function ($q) {
                $q->where('is_active', true)->orderBy('order');
            }])
            ->upcoming(); // scope: is_active=true & start_date >= today

        // Filter: Jenis Sertifikasi (category)
        if ($request->filled('category')) {
            $scheduleQuery->whereHas('program', fn($q) =>
                $q->where('category', $request->category)
            );
        }

        // Filter: Nama Pelatihan (title)
        if ($request->filled('title')) {
            $scheduleQuery->whereHas('program', fn($q) =>
                $q->where('title', $request->title)
            );
        }

        $schedules = $scheduleQuery->get();
        // Untuk option dropdown filter
        $scheduleCategories = Program::where('is_active', true)
            ->whereHas('schedules', fn($q) => $q->upcoming())
            ->distinct()->pluck('category');

        $scheduleTitles = Program::where('is_active', true)
            ->whereHas('schedules', fn($q) => $q->upcoming())
            ->distinct()->pluck('title', 'id');

        return view('home', compact(
            'heroes', 'services', 'programs', 'testimonials',
            'partners', 'popup',
            'schedules', 'scheduleCategories', 'scheduleTitles'
        ));
    }
}