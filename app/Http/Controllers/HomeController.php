<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Service;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\Popup;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroes = Hero::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $programs = Program::where('is_active', true)->orderBy('order')->limit(6)->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->limit(6)->get();
        $partners = Partner::where('is_active', true)->orderBy('order')->get();
        $popup = Popup::active()->orderBy('order')->first();

        return view('home', compact(
            'heroes', 'services', 'programs', 'testimonials', 'partners', 'popup'
        ));
    }
}