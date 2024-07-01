<?php
namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Exercise;
use App\Models\Muscle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where('user_id', Auth::id())->get();
        return view('programs.index', compact('programs'));
    }

    public function show($id)
    {
        $program = Program::findOrFail($id);
        return view('programs.show', compact('program'));
    }

    public function edit($id = null)
    {
        $muscles = Muscle::with('exercises')->get();
        $program = $id ? Program::with('exercises')->find($id) : null;
        $days = [];

        if ($program) {
            $days = $program->exercises->sortBy('pivot.order')->groupBy('pivot.day');
        }

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

    public function addExercise(Request $request, Program $program)
    {
        try {
            $existingRecord = DB::table('exercises_programs')
                ->where('exercise_id', $request->exercise_id)
                ->where('program_id', $program->id)
                ->where('day', $request->day)
                ->first();

            if ($existingRecord) {
                DB::table('exercises_programs')
                    ->where('id', $existingRecord->id)
                    ->update([
                        'order' => $request->order,
                        'rep' => $request->repetitions,
                        'break' => $request->break,
                        'weight' => $request->weight,
                    ]);
            } else {
                $order = $program->exercises()->wherePivot('day', $request->day)->count() + 1;
                $program->exercises()->attach($request->exercise_id, [
                    'day' => $request->day,
                    'order' => $order,
                    'rep' => $request->repetitions,
                    'break' => $request->break,
                    'weight' => $request->weight,
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function removeExercise(Request $request, Program $program, Exercise $exercise)
    {
        try {
            $program->exercises()->detach($exercise->id);

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
                        'rep' => $exercise['repetitions'],
                        'break' => $exercise['break'],
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
}
