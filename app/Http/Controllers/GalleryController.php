<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Gallery::active()
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $query = Gallery::active()->ordered();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->get();

        // Gunakan accessor image_url — otomatis handle public/ vs storage/
        $galleryJson = $galleries->map(function ($g) {
            return [
                'url'      => $g->image_url,
                'title'    => $g->title,
                'category' => $g->category ?? '',
            ];
        });

        return view('gallery.index', compact('galleries', 'categories', 'galleryJson'));
    }
}