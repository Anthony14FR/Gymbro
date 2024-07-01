<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exercise;
use App\Models\Muscle;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            // Abdominaux
            [
                'name' => 'Crunch',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Abdominaux'],
            ],
            [
                'name' => 'Plank',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Abs'],
            ],
            [
                'name' => 'Planche',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Abdominaux'],
            ],
            [
                'name' => 'Crunch',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Abs'],
            ],
            // Abdominaux obliques
            [
                'name' => 'Russian twist',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Abdominaux obliques'],
            ],
            [
                'name' => 'Russian twist',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Abs obliques'],
            ],
            [
                'name' => 'Planche sur le côté',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Abdominaux obliques'],
            ],
            [
                'name' => 'Side plank',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Abs obliques'],
            ],
            // Adducteurs
            [
                'name' => 'Adduction de la hanche',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Adducteurs'],
            ],
            [
                'name' => 'Hip adduction',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Adductors'],
            ],
            [
                'name' => 'Squat sumo',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Adducteurs'],
            ],
            [
                'name' => 'Sumo squat',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Adductors'],
            ],
            // Biceps
            [
                'name' => 'Curl biceps',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Biceps'],
            ],
            [
                'name' => 'Biceps curl',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Biceps'],
            ],
            [
                'name' => 'Curl marteau',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Biceps'],
            ],
            [
                'name' => 'Hammer curl',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Biceps'],
            ],
            // Deltoides
            [
                'name' => 'Élévation frontale',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Deltoides'],
            ],
            [
                'name' => 'Front raise',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Deltoids'],
            ],
            [
                'name' => 'Élévation latérale',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Deltoides'],
            ],
            [
                'name' => 'Lateral raise',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Deltoids'],
            ],
            // Dos
            [
                'name' => 'Traction pronation',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Dos'],
            ],
            [
                'name' => 'Pull-up pronated',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Back'],
            ],
            [
                'name' => 'Traction supination',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Dos' , 'Biceps'],
            ],
            [
                'name' => 'Pull-up supinated',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Back' , 'Biceps'],
            ],
            [
                'name' => 'Rowing dos',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Dos'],
            ],
            [
                'name' => 'Bent-over row',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Back'],
            ],
            // Fessiers
            [
                'name' => 'Squat',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Fessiers'],
            ],
            [
                'name' => 'Squat',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Glutes'],
            ],
            [
                'name' => 'Hip thrust',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Glutes'],
            ],
            [
                'name' => 'Hip thrust',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Fessiers'],
            ],
            // Ischio-jambiers
            [
                'name' => 'Leg curl',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Ischio-jambiers'],
            ],
            [
                'name' => 'Leg curl',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Hamstrings'],
            ],
            [
                'name' => 'Soulevé de terre roumain',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Ischio-jambiers'],
            ],
            [
                'name' => 'Romanian deadlift',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Hamstrings'],
            ],
            // Mollets
            [
                'name' => 'Élévation de mollets assis',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Mollets'],
            ],
            [
                'name' => 'Seated calf raise',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Calves'],
            ],
            [
                'name' => 'Élévation de mollets debout',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Mollets'],
            ],
            [
                'name' => 'Standing calf raise',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Calves'],
            ],
            // Pectoraux
            [
                'name' => 'Développé couché',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Pectoraux'],
            ],
            [
                'name' => 'Bench press',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Pectorals'],
            ],
            [
                'name' => 'Pull-over',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Pectoraux'],
            ],
            [
                'name' => 'Pull-over',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Pectorals'],
            ],
            // Quadriceps
            [
                'name' => 'Leg extension',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Quadriceps'],
            ],
            [
                'name' => 'Leg extension',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Quadriceps'],
            ],
            [
                'name' => 'Fentes',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Quadriceps'],
            ],
            [
                'name' => 'Lunges',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Quadriceps'],
            ],
            // Trapèzes
            [
                'name' => 'Shrug',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Trapèzes'],
            ],
            [
                'name' => 'Shrug',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Trapezius'],
            ],
            [
                'name' => 'Rowing vertical',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Trapèzes'],
            ],
            [
                'name' => 'Upright row',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Trapezius'],
            ],
            // Triceps
            [
                'name' => 'Extension triceps',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Triceps'],
            ],
            [
                'name' => 'Tricep extension',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Triceps'],
            ],
            [
                'name' => 'Dips',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Triceps'],
            ],
            [
                'name' => 'Dips',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Triceps'],
            ],
            // Arrière Épaule
            [
                'name' => 'Élévation arrière',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Arrière Épaule'],
            ],
            [
                'name' => 'Reverse fly',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Rear Deltoid'],
            ],
            [
                'name' => 'Face pull',
                'lang' => 'fr',
                'image' => '',
                'muscles' => ['Arrière Épaule'],
            ],
            [
                'name' => 'Face pull',
                'lang' => 'en',
                'image' => '',
                'muscles' => ['Rear Deltoid'],
            ],
        ];

        foreach ($exercises as $exerciseData) {
            $exercise = Exercise::create([
                'name' => $exerciseData['name'],
                'lang' => $exerciseData['lang'],
                'image' => $exerciseData['image'],
            ]);

            $muscleIds = Muscle::whereIn('name', $exerciseData['muscles'])->pluck('id');
            $exercise->muscles()->attach($muscleIds);
        }
    }
}
