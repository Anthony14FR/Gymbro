<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Exercise;
use App\Models\Muscle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\ExercisesPrograms;

class ProgramController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        if(Auth::user()->hasRole('premium')) {
            $myPrograms = Program::where('user_id', $user_id)->with(['exercises', 'exercises.muscles'])->paginate(9);
            $communityPrograms = Program::where('status', 1)->where('user_id', '!=', $user_id)->with(['exercises', 'exercises.muscles'])->paginate(9);
            $gymbroPrograms = Program::where('user_id', 1)->with(['exercises', 'exercises.muscles'])->paginate(9);
            return view('programs.index', compact('myPrograms', 'communityPrograms', 'gymbroPrograms'));
        } else {
            $myPrograms = Program::where('user_id', $user_id)->with(['exercises', 'exercises.muscles'])->paginate(3);
            $gymbroPrograms = Program::where('status', 1)->where('user_id', 1)->with(['exercises', 'exercises.muscles'])->paginate(3);
            return view('programs.index', compact('myPrograms', 'gymbroPrograms'));
        }
    }

    public function show($id)
    {
        $program = Program::findOrFail($id);
        if ($program->user_id !== Auth::id() && $program->status !== 1) {
            abort(404, 'Unauthorized action.');
        }
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
        $program = Program::with(['exercises' => function ($query) {
            $query->withPivot('id', 'rep', 'break', 'weight', 'order', 'day');
        }])->findOrFail($id);

        if ($program->user_id !== Auth::id()) {
            abort(404, 'Unauthorized action.');
        }

        $days = $program->exercises->sortBy('pivot.order')->groupBy('pivot.day');
        $exerciseCounts = [];
        foreach ($days as $day => $exercises) {
            $exerciseCounts[$day] = count($exercises);
        }

        $exercises = Exercise::Where('lang', 'fr')->get();
        return view('programs.edit', compact('muscles', 'program', 'days', 'exerciseCounts', 'exercises'));
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
        if ($program->user_id !== Auth::id()) {
            abort(404, 'Unauthorized action.');
        }

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
        $program = Program::findOrFail($programId);

        if ($program->user_id !== Auth::id()) {
            abort(404, 'Unauthorized action.');
        }

        try {
            $exerciseProgram = ExercisesPrograms::findOrFail($exerciseProgramId);
            $exerciseProgram->update([
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
        if ($program->user_id !== Auth::id()) {
            abort(404, 'Unauthorized action.');
        }

        try {
            $order = ExercisesPrograms::where('program_id', $program->id)
                    ->where('day', $request->day)
                    ->count() + 1;

            $data = [
                'program_id' => $program->id,
                'exercise_id' => $request->exercise_id,
                'day' => $request->day,
                'order' => $order,
                'rep' => $request->rep,
                'break' => $request->break_time,
                'weight' => $request->weight,
            ];

            $exerciseProgram = ExercisesPrograms::create($data);

            return response()->json(['success' => true, 'id' => $exerciseProgram->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function removeExercise($programId, $exerciseProgramId)
    {
        $program = Program::findOrFail($programId);

        if ($program->user_id !== Auth::id()) {
            abort(404, 'Unauthorized action.');
        }

        try {
            ExercisesPrograms::findOrFail($exerciseProgramId)->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function saveProgram(Request $request, Program $program)
    {
        if ($program->user_id !== Auth::id()) {
            abort(404, 'Unauthorized action.');
        }

        try {
            $program->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            ExercisesPrograms::where('program_id', $program->id)->delete();

            foreach ($request->days as $day) {
                foreach ($day['exercises'] as $exercise) {
                    ExercisesPrograms::create([
                        'program_id' => $program->id,
                        'exercise_id' => $exercise['exercise_id'],
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

    public function saveImage(Request $request, Program $program)
    {
        if ($program->user_id !== Auth::id()) {
            abort(404, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imageName = $program->id . '.' . $request->image->extension();
        if (!is_dir(public_path('images/programs/'))) {
            mkdir(public_path('images/programs/'));
        }
        if (!is_dir(public_path('images/programs/' . Auth::id()))) {
            mkdir(public_path('images/programs/' . Auth::id()));
        }
        $request->image->move(public_path('images/programs/' . Auth::id()), $imageName);
        $userId = Auth::id();
        $program->update(['image' => 'images/programs/' . $userId . '/' . $imageName]);
        $imagePath = $program->image;
        return response()->json(['success' => true, 'image' => $imagePath]);
    }

    public function toggleStatus(Request $request, Program $program)
    {
        if ($program->user_id !== Auth::id()) {
            abort(404, 'Unauthorized action.');
        }

        try {
            $program->update(['status' => $request->status]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Program $program)
    {
        if ($program->user_id !== Auth::id()) {
            abort(404, 'Unauthorized action.');
        }

        $program->delete();

        return redirect()->route('programs.index')
            ->with('success', 'Program deleted successfully.');
    }

    public function exportPdf($id)
    {
        $program = Program::with(['exercises' => function ($query) {
            $query->withPivot('id', 'rep', 'break', 'weight', 'order', 'day');
        }])->findOrFail($id);

        if ($program->user_id !== Auth::id() && $program->status !== 1) {
            abort(404, 'Unauthorized action.');
        }

        $days = $program->exercises->sortBy('pivot.order')->groupBy('pivot.day');
        $pdfName = $program->name . '.pdf';
        $pdf = PDF::loadView('programs.pdf', compact('program', 'days'));
        return $pdf->download($pdfName);
    }


    public function exportCsv($id)
    {
        $program = Program::findOrFail($id);
        $exercisesByDay = $program->exercises->groupBy('pivot.day');
    
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=programme_" . $program->name . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
    
        $callback = function() use ($program, $exercisesByDay) {
            $file = fopen('php://output', 'w');
            
            // Utiliser le point-virgule comme séparateur pour une meilleure compatibilité avec Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // Ajouter BOM pour l'encodage UTF-8
            
            // En-tête du programme
            fputcsv($file, array("Programme d'entraînement : " . $program->name), ';');
            fputcsv($file, array("Description : " . $program->description), ';');
            fputcsv($file, array("Créé le : " . $program->created_at->format('d/m/Y')), ';');
            fputcsv($file, array(""), ';'); // Ligne vide
    
            foreach ($exercisesByDay as $day => $exercises) {
                fputcsv($file, array("Jour " . $day), ';');
                fputcsv($file, array("Exercice", "Répétitions", "Pause (secondes)", "Poids (kg)"), ';');
    
                foreach ($exercises as $exercise) {
                    fputcsv($file, array(
                        $exercise->name,
                        $exercise->pivot->rep,
                        $exercise->pivot->break,
                        $exercise->pivot->weight
                    ), ';');
                }
    
                fputcsv($file, array(""), ';'); // Ligne vide entre les jours
            }
    
            fputcsv($file, array(""), ';');
            fputcsv($file, array("Conseils :"), ';');
            fputcsv($file, array("- Échauffez-vous correctement avant chaque séance"), ';');
            fputcsv($file, array("- Restez hydraté pendant l'entraînement"), ';');
            fputcsv($file, array("- Concentrez-vous sur la bonne exécution des mouvements"), ';');
            fputcsv($file, array("- Respectez les temps de pause"), ';');
            fputcsv($file, array("- Ajustez les poids si nécessaire"), ';');
    
            fclose($file);
        };
    
        return Response::stream($callback, 200, $headers);
    }
}
