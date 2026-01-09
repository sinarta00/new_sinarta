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