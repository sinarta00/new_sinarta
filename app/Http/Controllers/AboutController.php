<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationalStructure;

class AboutController extends Controller
{
    public function index()
    {
    $metaTitle = config('seo.about.title');
    $metaDescription = config('seo.about.description');
    $metaKeywords = config('seo.about.keywords');

    $orgTree = OrganizationalStructure::where('is_active', true)
    ->whereNull('parent_id')
    ->with('children.children') // 3 level dalam; tambah nesting kalau perlu lebih
    ->orderBy('order')
    ->get();

    return view('about', compact('metaTitle', 'metaDescription', 'metaKeywords', 'orgTree'));
    }
}