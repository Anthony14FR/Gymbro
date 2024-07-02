<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Exercise;
use App\Models\Muscle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where('user_id', Auth::id())->with(['exercises', 'exercises.muscles'])->get();
        $muscles = Muscle::all();
        return view('programs.index', compact('programs', 'muscles'));
    }



    public function show($id)
    {
        $program = Program::findOrFail($id);
        return view('programs.show', compact('program'));
    }

    public function edit($id = null)
    {
        if (is_null($id)) {
            $program = Program::create([
                'name' => 'Nom du programme',
                'description' => 'Description du programme',
                'user_id' => Auth::id(),
            ]);
            return redirect()->route('programs.edit', ['id' => $program->id]);
        }

        $muscles = Muscle::with('exercises')->get();
        $program = Program::with(['exercises' => function($query) {
            $query->withPivot('id', 'rep', 'break', 'weight', 'order', 'day');
        }])->findOrFail($id);
        $days = $program->exercises->sortBy('pivot.order')->groupBy('pivot.day');

        $exerciseCounts = [];
        foreach ($days as $day => $exercises) {
            $exerciseCounts[$day] = count($exercises);
        }

        return view('programs.edit', compact('muscles', 'program', 'days', 'exerciseCounts'));
    }



    public function store(Request $request)
    {
        $program = Program::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['id' => $program->id]);
    }

    public function update(Request $request, Program $program)
    {
        try {
            $program->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateExercise(Request $request, $programId, $exerciseProgramId)
    {
        try {
            DB::table('exercises_programs')
                ->where('id', $exerciseProgramId)
                ->update([
                    'order' => $request->order,
                    'rep' => $request->rep,
                    'break' => $request->break_time,
                    'weight' => $request->weight,
                ]);

            return response()->json(['success' => true, 'id' => $exerciseProgramId]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addExercise(Request $request, Program $program)
    {
        try {
            $order = $program->exercises()->wherePivot('day', $request->day)->count() + 1;
            $program->exercises()->attach($request->exercise_id, [
                'day' => $request->day,
                'order' => $order,
                'rep' => $request->rep,
                'break' => $request->break_time,
                'weight' => $request->weight,
            ]);

            $exerciseProgramId = DB::table('exercises_programs')
                ->where('exercise_id', $request->exercise_id)
                ->where('program_id', $program->id)
                ->where('day', $request->day)
                ->where('order', $order)
                ->latest('id')
                ->value('id');

            return response()->json(['success' => true, 'id' => $exerciseProgramId]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function removeExercise($programId, $exerciseProgramId)
    {
        try {
            DB::table('exercises_programs')->where('id', $exerciseProgramId)->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




    public function saveProgram(Request $request, Program $program)
    {
        try {
            $program->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $program->exercises()->detach();

            foreach ($request->days as $day) {
                foreach ($day['exercises'] as $exercise) {
                    $program->exercises()->attach($exercise['exercise_id'], [
                        'day' => $day['day'],
                        'order' => $exercise['order'],
                        'rep' => $exercise['rep'],
                        'break' => $exercise['break_time'],
                        'weight' => $exercise['weight'],
                    ]);
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')
            ->with('success', 'Program deleted successfully.');
    }

    public function exportPdf($id)
    {
        $program = Program::with(['exercises' => function($query) {
            $query->withPivot('id', 'rep', 'break', 'weight', 'order', 'day');
        }])->findOrFail($id);

        $days = $program->exercises->sortBy('pivot.order')->groupBy('pivot.day');
        $pdfName = $program->name . '.pdf';
        $pdf = PDF::loadView('programs.pdf', compact('program', 'days'));
        return $pdf->download($pdfName);
    }
}
