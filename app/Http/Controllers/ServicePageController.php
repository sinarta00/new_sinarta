<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicePageController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();
        
        return view('services.index', compact('services'));
    }
    
    public function show($slug)
    {
        // Untuk detail service (opsional)
        return view('services.show');
    }
}