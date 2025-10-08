<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
    $metaTitle = config('seo.about.title');
    $metaDescription = config('seo.about.description');
    $metaKeywords = config('seo.about.keywords');
        
    return view('about', compact('metaTitle', 'metaDescription', 'metaKeywords'));
    }
}