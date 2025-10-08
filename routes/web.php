<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServicePageController;
use App\Http\Controllers\ProgramPageController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/layanan', [ServicePageController::class, 'index'])->name('services');
Route::get('/layanan/{slug}', [ServicePageController::class, 'show'])->name('services.show');
Route::get('/program', [ProgramPageController::class, 'index'])->name('programs');
Route::get('/program/{slug}', [ProgramPageController::class, 'show'])->name('programs.show');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

use App\Helpers\AnalyticsHelper;

// API untuk tracking click (public)
Route::post('/api/track-click', function(\Illuminate\Http\Request $request) {
    AnalyticsHelper::trackClick(
        $request->type,
        $request->label,
        $request->page_url
    );
    
    return response()->json(['success' => true]);
})->name('api.track-click');