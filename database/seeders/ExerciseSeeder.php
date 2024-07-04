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
                'image' => 'images/exercises/crunch.webp',
                'muscles' => ['Abdominaux'],
            ],
            [
                'name' => 'Plank',
                'lang' => 'en',
                'image' => 'images/exercises/plank.webp',
                'muscles' => ['Abs'],
            ],
            [
                'name' => 'Planche',
                'lang' => 'fr',
                'image' => 'images/exercises/plank.webp',
                'muscles' => ['Abdominaux'],
            ],
            [
                'name' => 'Crunch',
                'lang' => 'en',
                'image' => 'images/exercises/crunch.webp',
                'muscles' => ['Abs'],
            ],
            // Abdominaux obliques
            [
                'name' => 'Russian twist',
                'lang' => 'fr',
                'image' => 'images/exercises/russian-twist.webp',
                'muscles' => ['Abdominaux obliques'],
            ],
            [
                'name' => 'Russian twist',
                'lang' => 'en',
                'image' => 'images/exercises/russian-twist.webp',
                'muscles' => ['Abs obliques'],
            ],
            [
                'name' => 'Planche sur le côté',
                'lang' => 'fr',
                'image' => 'images/exercises/side plank.webp',
                'muscles' => ['Abdominaux obliques'],
            ],
            [
                'name' => 'Side plank',
                'lang' => 'en',
                'image' => 'images/exercises/side plank.webp',
                'muscles' => ['Abs obliques'],
            ],
            // Adducteurs
            [
                'name' => 'Adduction de la hanche',
                'lang' => 'fr',
                'image' => 'images/exercises/hip adduction.webp',
                'muscles' => ['Adducteurs'],
            ],
            [
                'name' => 'Hip adduction',
                'lang' => 'en',
                'image' => 'images/exercises/hip adduction.webp',
                'muscles' => ['Adductors'],
            ],
            [
                'name' => 'Squat sumo',
                'lang' => 'fr',
                'image' => 'images/exercises/squat sumo.webp',
                'muscles' => ['Adducteurs'],
            ],
            [
                'name' => 'Sumo squat',
                'lang' => 'en',
                'image' => 'images/exercises/squat sumo.webp',
                'muscles' => ['Adductors'],
            ],
            // Biceps
            [
                'name' => 'Curl biceps',
                'lang' => 'fr',
                'image' => 'images/exercises/curl biceps.webp',
                'muscles' => ['Biceps'],
            ],
            [
                'name' => 'Biceps curl',
                'lang' => 'en',
                'image' => 'images/exercises/curl biceps.webp',
                'muscles' => ['Biceps'],
            ],
            [
                'name' => 'Curl marteau',
                'lang' => 'fr',
                'image' => 'images/exercises/hammer curl.webp',
                'muscles' => ['Biceps'],
            ],
            [
                'name' => 'Hammer curl',
                'lang' => 'en',
                'image' => 'images/exercises/hammer curl.webp',
                'muscles' => ['Biceps'],
            ],
            // Deltoides
            [
                'name' => 'Élévation frontale',
                'lang' => 'fr',
                'image' => 'images/exercises/lateral raise.webp',
                'muscles' => ['Deltoides'],
            ],
            [
                'name' => 'Front raise',
                'lang' => 'en',
                'image' => 'images/exercises/lateral raise.webp',
                'muscles' => ['Deltoids'],
            ],
            [
                'name' => 'Élévation latérale',
                'lang' => 'fr',
                'image' => 'images/exercises/lateral raise.webp',
                'muscles' => ['Deltoides'],
            ],
            [
                'name' => 'Lateral raise',
                'lang' => 'en',
                'image' => 'images/exercises/lateral raise.webp',
                'muscles' => ['Deltoids'],
            ],
            // Dos
            [
                'name' => 'Traction pronation',
                'lang' => 'fr',
                'image' => 'images/exercises/pullup pronated.webp',
                'muscles' => ['Dos'],
            ],
            [
                'name' => 'Pull-up pronated',
                'lang' => 'en',
                'image' => 'images/exercises/pullup pronated.webp',
                'muscles' => ['Back'],
            ],
            [
                'name' => 'Traction supination',
                'lang' => 'fr',
                'image' => 'images/exercises/pullup supinated.webp',
                'muscles' => ['Dos' , 'Biceps'],
            ],
            [
                'name' => 'Pull-up supinated',
                'lang' => 'en',
                'image' => 'images/exercises/pullup supinated.webp',
                'muscles' => ['Back' , 'Biceps'],
            ],
            [
                'name' => 'Rowing dos',
                'lang' => 'fr',
                'image' => 'images/exercises/rowing-dos.gif',
                'muscles' => ['Dos'],
            ],
            [
                'name' => 'Bent-over row',
                'lang' => 'en',
                'image' => 'images/exercises/rowing-dos.gif',
                'muscles' => ['Back'],
            ],
            // Fessiers
            [
                'name' => 'Squat',
                'lang' => 'fr',
                'image' => 'images/exercises/squat.webp',
                'muscles' => ['Fessiers'],
            ],
            [
                'name' => 'Squat',
                'lang' => 'en',
                'image' => 'images/exercises/squat.webp',
                'muscles' => ['Glutes'],
            ],
            [
                'name' => 'Hip thrust',
                'lang' => 'en',
                'image' => 'images/exercises/hip thrust.webp',
                'muscles' => ['Glutes'],
            ],
            [
                'name' => 'Hip thrust',
                'lang' => 'fr',
                'image' => 'images/exercises/hip thrust.webp',
                'muscles' => ['Fessiers'],
            ],
            // Ischio-jambiers
            [
                'name' => 'Leg curl',
                'lang' => 'fr',
                'image' => 'images/exercises/leg extension.webp',
                'muscles' => ['Ischio-jambiers'],
            ],
            [
                'name' => 'Leg curl',
                'lang' => 'en',
                'image' => 'images/exercises/leg extension.webp',
                'muscles' => ['Hamstrings'],
            ],
            [
                'name' => 'Soulevé de terre roumain',
                'lang' => 'fr',
                'image' => 'images/exercises/romanian deadlift.webp',
                'muscles' => ['Ischio-jambiers'],
            ],
            [
                'name' => 'Romanian deadlift',
                'lang' => 'en',
                'image' => 'images/exercises/romanian deadlift.webp',
                'muscles' => ['Hamstrings'],
            ],
            // Mollets
            [
                'name' => 'Élévation de mollets assis',
                'lang' => 'fr',
                'image' => 'images/exercises/seated calf raise.webp',
                'muscles' => ['Mollets'],
            ],
            [
                'name' => 'Seated calf raise',
                'lang' => 'en',
                'image' => 'images/exercises/seated calf raise.webp',
                'muscles' => ['Calves'],
            ],
            [
                'name' => 'Élévation de mollets debout',
                'lang' => 'fr',
                'image' => 'images/exercises/standing calf raise.webp',
                'muscles' => ['Mollets'],
            ],
            [
                'name' => 'Standing calf raise',
                'lang' => 'en',
                'image' => 'images/exercises/standing calf raise.webp',
                'muscles' => ['Calves'],
            ],
            // Pectoraux
            [
                'name' => 'Développé couché',
                'lang' => 'fr',
                'image' => 'images/exercises/bench press.webp',
                'muscles' => ['Pectoraux'],
            ],
            [
                'name' => 'Bench press',
                'lang' => 'en',
                'image' => 'images/exercises/bench press.webp',
                'muscles' => ['Pectorals'],
            ],
            [
                'name' => 'Pull-over',
                'lang' => 'fr',
                'image' => 'images/exercises/pull-over.webp',
                'muscles' => ['Pectoraux'],
            ],
            [
                'name' => 'Pull-over',
                'lang' => 'en',
                'image' => 'images/exercises/pull-over.webp',
                'muscles' => ['Pectorals'],
            ],
            // Quadriceps
            [
                'name' => 'Leg extension',
                'lang' => 'fr',
                'image' => 'images/exercises/leg extension.webp',
                'muscles' => ['Quadriceps'],
            ],
            [
                'name' => 'Leg extension',
                'lang' => 'en',
                'image' => 'images/exercises/leg extension.webp',
                'muscles' => ['Quadriceps'],
            ],
            [
                'name' => 'Fentes',
                'lang' => 'fr',
                'image' => 'images/exercises/fentes.webp',
                'muscles' => ['Quadriceps'],
            ],
            [
                'name' => 'Lunges',
                'lang' => 'en',
                'image' => 'images/exercises/fentes.webp',
                'muscles' => ['Quadriceps'],
            ],
            // Trapèzes
            [
                'name' => 'Shrug',
                'lang' => 'fr',
                'image' => 'images/exercises/shrug.webp',
                'muscles' => ['Trapèzes'],
            ],
            [
                'name' => 'Shrug',
                'lang' => 'en',
                'image' => 'images/exercises/shrug.webp',
                'muscles' => ['Trapezius'],
            ],
            [
                'name' => 'Rowing vertical',
                'lang' => 'fr',
                'image' => 'images/exercises/upright row.webp',
                'muscles' => ['Trapèzes'],
            ],
            [
                'name' => 'Upright row',
                'lang' => 'en',
                'image' => 'images/exercises/upright row.webp',
                'muscles' => ['Trapezius'],
            ],
            // Triceps
            [
                'name' => 'Extension triceps',
                'lang' => 'fr',
                'image' => 'images/exercises/triceps extension.webp',
                'muscles' => ['Triceps'],
            ],
            [
                'name' => 'Tricep extension',
                'lang' => 'en',
                'image' => 'images/exercises/triceps extension.webp',
                'muscles' => ['Triceps'],
            ],
            [
                'name' => 'Dips',
                'lang' => 'en',
                'image' => 'images/exercises/dips.webp',
                'muscles' => ['Triceps'],
            ],
            [
                'name' => 'Dips',
                'lang' => 'fr',
                'image' => 'images/exercises/dips.webp',
                'muscles' => ['Triceps'],
            ],
            // Arrière Épaule
            [
                'name' => 'Élévation arrière',
                'lang' => 'fr',
                'image' => 'images/exercises/reverse fly.webp',
                'muscles' => ['Arrière Épaule'],
            ],
            [
                'name' => 'Reverse fly',
                'lang' => 'en',
                'image' => 'images/exercises/reverse fly.webp',
                'muscles' => ['Rear Deltoid'],
            ],
            [
                'name' => 'Face pull',
                'lang' => 'fr',
                'image' => 'images/exercises/face-pull.webp',
                'muscles' => ['Arrière Épaule'],
            ],
            [
                'name' => 'Face pull',
                'lang' => 'en',
                'image' => 'images/exercises/face-pull.webp',
                'muscles' => ['Rear Deltoid'],
            ],
            // Repos
            [
                'name' => 'Repos',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => [],
            ],
            [
                'name' => 'Rest',
                'lang' => 'en',
                'image' => 'images/exercises/rest.webp',
                'muscles' => [],
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
