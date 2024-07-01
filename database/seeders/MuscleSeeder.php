<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Muscle;

class MuscleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $musclesFR = [
            'Abdominaux',
            'Abdominaux obliques',
            'Adducteurs',
            'Biceps',
            'Deltoides',
            'Dos',
            'Fessiers',
            'Ischio-jambiers',
            'Mollets',
            'Pectoraux',
            'Quadriceps',
            'Trapèzes',
            'Triceps',
            'Arrière Épaule',
        ];

        $musclesEN = [
            'Abs',
            'Abs obliques',
            'Adductors',
            'Biceps',
            'Deltoids',
            'Back',
            'Glutes',
            'Hamstrings',
            'Calves',
            'Pectorals',
            'Quadriceps',
            'Trapezius',
            'Triceps',
            'Rear Deltoid',
        ];

        foreach ($musclesFR as $muscle) {
            Muscle::create([
                'name' => $muscle,
                'lang' => 'fr',
            ]);
        }

        foreach ($musclesEN as $muscle) {
            Muscle::create([
                'name' => $muscle,
                'lang' => 'en',
            ]);
        }
    }
}
