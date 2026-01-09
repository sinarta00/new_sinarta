<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramPageController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::where('is_active', true);
        
        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        $programs = $query->orderBy('order')->paginate(9);
        
        return view('programs.index', compact('programs'));
    }
    
    public function show($slug)
    {
        // Untuk detail program (opsional)
        return view('programs.show');
    }
}