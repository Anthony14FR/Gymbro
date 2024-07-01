<?php

namespace App\Http\Controllers;

use App\Models\Muscle;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        $muscles = Muscle::where('lang', 'fr')->whereHas('exercises', function ($query) {
            $query->where('lang', 'fr');
        })->with(['exercises' => function ($query) {
            $query->where('lang', 'fr');
        }])->get();

        return view('exercises.index', compact('muscles'));
    }
}
