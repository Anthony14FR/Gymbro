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
            [
                'name' => 'Crunch',
                'lang' => 'fr',
                'image' => 'images/exercises/crunch.webp',
                'muscles' => ['Abdominaux'],
            ],
            [
                'name' => 'Planche',
                'lang' => 'fr',
                'image' => 'images/exercises/plank.webp',
                'muscles' => ['Abdominaux'],
            ],
            [
                'name' => 'Russian twist',
                'lang' => 'fr',
                'image' => 'images/exercises/russian-twist.webp',
                'muscles' => ['Abdominaux obliques'],
            ],
            [
                'name' => 'Planche sur le côté',
                'lang' => 'fr',
                'image' => 'images/exercises/side plank.webp',
                'muscles' => ['Abdominaux obliques'],
            ],
            [
                'name' => 'Adduction de la hanche',
                'lang' => 'fr',
                'image' => 'images/exercises/hip adduction.webp',
                'muscles' => ['Adducteurs'],
            ],
            [
                'name' => 'Squat sumo',
                'lang' => 'fr',
                'image' => 'images/exercises/squat sumo.webp',
                'muscles' => ['Adducteurs'],
            ],
            [
                'name' => 'Curl biceps',
                'lang' => 'fr',
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
                'name' => 'Élévation frontale',
                'lang' => 'fr',
                'image' => 'images/exercises/lateral raise.webp',
                'muscles' => ['Deltoides'],
            ],
            [
                'name' => 'Élévation latérale',
                'lang' => 'fr',
                'image' => 'images/exercises/lateral raise.webp',
                'muscles' => ['Deltoides'],
            ],
            [
                'name' => 'Traction pronation',
                'lang' => 'fr',
                'image' => 'images/exercises/pullup pronated.webp',
                'muscles' => ['Dos'],
            ],
            [
                'name' => 'Traction supination',
                'lang' => 'fr',
                'image' => 'images/exercises/pullup supinated.webp',
                'muscles' => ['Dos', 'Biceps'],
            ],
            [
                'name' => 'Rowing dos',
                'lang' => 'fr',
                'image' => 'images/exercises/rowing-dos.gif',
                'muscles' => ['Dos'],
            ],
            [
                'name' => 'Squat',
                'lang' => 'fr',
                'image' => 'images/exercises/squat.webp',
                'muscles' => ['Fessiers', 'Quadriceps'],
            ],
            [
                'name' => 'Hip thrust',
                'lang' => 'fr',
                'image' => 'images/exercises/hip thrust.webp',
                'muscles' => ['Fessiers'],
            ],
            [
                'name' => 'Leg curl',
                'lang' => 'fr',
                'image' => 'images/exercises/leg extension.webp',
                'muscles' => ['Ischio-jambiers'],
            ],
            [
                'name' => 'Soulevé de terre roumain',
                'lang' => 'fr',
                'image' => 'images/exercises/romanian deadlift.webp',
                'muscles' => ['Ischio-jambiers'],
            ],
            [
                'name' => 'Élévation de mollets assis',
                'lang' => 'fr',
                'image' => 'images/exercises/seated calf raise.webp',
                'muscles' => ['Mollets'],
            ],
            [
                'name' => 'Élévation de mollets debout',
                'lang' => 'fr',
                'image' => 'images/exercises/standing calf raise.webp',
                'muscles' => ['Mollets'],
            ],
            [
                'name' => 'Développé couché',
                'lang' => 'fr',
                'image' => 'images/exercises/bench press.webp',
                'muscles' => ['Pectoraux'],
            ],
            [
                'name' => 'Pull-over',
                'lang' => 'fr',
                'image' => 'images/exercises/pull-over.webp',
                'muscles' => ['Pectoraux', 'Dos'],
            ],
            [
                'name' => 'Leg extension',
                'lang' => 'fr',
                'image' => 'images/exercises/leg extension.webp',
                'muscles' => ['Quadriceps'],
            ],
            [
                'name' => 'Fentes',
                'lang' => 'fr',
                'image' => 'images/exercises/fentes.webp',
                'muscles' => ['Quadriceps', 'Fessiers'],
            ],
            [
                'name' => 'Shrug',
                'lang' => 'fr',
                'image' => 'images/exercises/shrug.webp',
                'muscles' => ['Trapèzes'],
            ],
            [
                'name' => 'Rowing vertical',
                'lang' => 'fr',
                'image' => 'images/exercises/upright row.webp',
                'muscles' => ['Trapèzes', 'Deltoides'],
            ],
            [
                'name' => 'Extension triceps',
                'lang' => 'fr',
                'image' => 'images/exercises/triceps extension.webp',
                'muscles' => ['Triceps'],
            ],
            [
                'name' => 'Dips',
                'lang' => 'fr',
                'image' => 'images/exercises/dips.webp',
                'muscles' => ['Triceps', 'Pectoraux'],
            ],
            [
                'name' => 'Élévation arrière',
                'lang' => 'fr',
                'image' => 'images/exercises/reverse fly.webp',
                'muscles' => ['Arrière Épaule'],
            ],
            [
                'name' => 'Face pull',
                'lang' => 'fr',
                'image' => 'images/exercises/face-pull.webp',
                'muscles' => ['Arrière Épaule'],
            ],
            [
                'name' => 'Repos',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => [],
            ],
            [
                'name' => 'Burpees',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => ['Pectoraux', 'Quadriceps', 'Abdominaux'],
            ],
            [
                'name' => 'Mountain climbers',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => ['Abdominaux', 'Quadriceps'],
            ],
            [
                'name' => 'Jumping jacks',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => ['Quadriceps', 'Deltoides'],
            ],
            [
                'name' => 'Pompes classiques',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => ['Pectoraux', 'Triceps', 'Deltoides'],
            ],
            [
                'name' => 'Pompes diamant',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => ['Triceps', 'Pectoraux'],
            ],
            [
                'name' => 'Pompes surélevées (pieds surélevés)',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => ['Pectoraux', 'Deltoides'],
            ],
            [
                'name' => 'Pompes surélevées (mains surélevées)',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => ['Pectoraux'],
            ],
            [
                'name' => 'Fentes sautées',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => ['Quadriceps', 'Fessiers'],
            ],
            [
                'name' => 'V-up',
                'lang' => 'fr',
                'image' => 'images/exercises/rest.webp',
                'muscles' => ['Abdominaux'],
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