<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramPageController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::query()->where('is_active', true);
        
        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        $programs = $query->orderBy('order')->with('nearestSchedules')->paginate(9);
        
        return view('programs.index', compact('programs'));
    }
    
    public function show(Program $program)
   {
        $program->load([
            'variants' => fn($q) => $q->where('is_active', true)->orderBy('order'),
            'schedules' => fn($q) => $q->where('start_date', '>=', now())->orderBy('start_date'),
        ]);

        return view('programs.show', compact('program'));
    }
}