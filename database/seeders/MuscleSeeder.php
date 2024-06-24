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
        // Muscles en francais
        $musclesFR = [
            'Abdominaux',
            'Adducteurs',
            'Biceps',
            'Bras',
            'Carrés des lombes',
            'Cuisses',
            'Deltoides',
            'Dos',
            'Erecteurs du rachis',
            'Fessiers',
            'Ischio-jambiers',
            'Mollets',
            'Obliques',
            'Pectoraux',
            'Quadriceps',
            'Trapezes',
            'Triceps',
        ];

        $musclesEN = [
            'Abs',
            'Adductors',
            'Biceps',
            'Arms',
            'Quadratus lumborum',
            'Thighs',
            'Deltoids',
            'Back',
            'Erector spinae',
            'Glutes',
            'Hamstrings',
            'Calves',
            'Obliques',
            'Pectorals',
            'Quadriceps',
            'Trapezius',
            'Triceps',
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
