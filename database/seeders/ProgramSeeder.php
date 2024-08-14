<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Exercise;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        $userId = 1;

        $program = Program::create([
            'name' => 'Défi 10 jours abdos',
            'description' => 'Défi de 10 jours pour travailler les abdos',
            'image' => 'images/programs/defi-10-jours-abdos.webp',
            'status' => 1, // Public
            'user_id' => $userId,
        ]);

        $exercises = [
            'Jour 1' => [
                ['name' => 'Crunch', 'rep' => 20, 'break' => 45, 'weight' => 0],
                ['name' => 'Planche', 'rep' => 1, 'break' => 45, 'weight' => 0, 'duration' => 30],
                ['name' => 'Russian twist', 'rep' => 20, 'break' => 45, 'weight' => 0],
                ['name' => 'Mountain climbers', 'rep' => 30, 'break' => 45, 'weight' => 0],
            ],
            'Jour 2' => [
                ['name' => 'V-up', 'rep' => 15, 'break' => 45, 'weight' => 0],
                ['name' => 'Planche sur le côté', 'rep' => 1, 'break' => 45, 'weight' => 0, 'duration' => 20],
                ['name' => 'Crunch', 'rep' => 25, 'break' => 45, 'weight' => 0],
                ['name' => 'Bicycle crunch', 'rep' => 20, 'break' => 45, 'weight' => 0],
            ],
            'Jour 3' => [
                ['name' => 'Russian twist', 'rep' => 25, 'break' => 45, 'weight' => 0],
                ['name' => 'Planche', 'rep' => 1, 'break' => 45, 'weight' => 0, 'duration' => 40],
                ['name' => 'Leg raises', 'rep' => 15, 'break' => 45, 'weight' => 0],
                ['name' => 'Mountain climbers', 'rep' => 35, 'break' => 45, 'weight' => 0],
            ],
            'Jour 4' => [
                ['name' => 'Crunch', 'rep' => 30, 'break' => 45, 'weight' => 0],
                ['name' => 'Planche sur le côté', 'rep' => 1, 'break' => 45, 'weight' => 0, 'duration' => 25],
                ['name' => 'V-up', 'rep' => 20, 'break' => 45, 'weight' => 0],
                ['name' => 'Bicycle crunch', 'rep' => 25, 'break' => 45, 'weight' => 0],
            ],
            'Jour 5' => [
                ['name' => 'Russian twist', 'rep' => 30, 'break' => 45, 'weight' => 0],
                ['name' => 'Planche', 'rep' => 1, 'break' => 45, 'weight' => 0, 'duration' => 50],
                ['name' => 'Crunch', 'rep' => 35, 'break' => 45, 'weight' => 0],
                ['name' => 'Mountain climbers', 'rep' => 40, 'break' => 45, 'weight' => 0],
            ],
            'Jour 6' => [
                ['name' => 'V-up', 'rep' => 25, 'break' => 45, 'weight' => 0],
                ['name' => 'Planche sur le côté', 'rep' => 1, 'break' => 45, 'weight' => 0, 'duration' => 30],
                ['name' => 'Leg raises', 'rep' => 20, 'break' => 45, 'weight' => 0],
                ['name' => 'Bicycle crunch', 'rep' => 30, 'break' => 45, 'weight' => 0],
            ],
            'Jour 7' => [
                ['name' => 'Crunch', 'rep' => 40, 'break' => 45, 'weight' => 0],
                ['name' => 'Planche', 'rep' => 1, 'break' => 45, 'weight' => 0, 'duration' => 60],
                ['name' => 'Russian twist', 'rep' => 35, 'break' => 45, 'weight' => 0],
                ['name' => 'Mountain climbers', 'rep' => 45, 'break' => 45, 'weight' => 0],
            ],
            'Jour 8' => [
                ['name' => 'V-up', 'rep' => 30, 'break' => 45, 'weight' => 0],
                ['name' => 'Planche sur le côté', 'rep' => 1, 'break' => 45, 'weight' => 0, 'duration' => 35],
                ['name' => 'Crunch', 'rep' => 45, 'break' => 45, 'weight' => 0],
                ['name' => 'Bicycle crunch', 'rep' => 35, 'break' => 45, 'weight' => 0],
            ],
            'Jour 9' => [
                ['name' => 'Russian twist', 'rep' => 40, 'break' => 45, 'weight' => 0],
                ['name' => 'Planche', 'rep' => 1, 'break' => 45, 'weight' => 0, 'duration' => 70],
                ['name' => 'Leg raises', 'rep' => 25, 'break' => 45, 'weight' => 0],
                ['name' => 'Mountain climbers', 'rep' => 50, 'break' => 45, 'weight' => 0],
            ],
            'Jour 10' => [
                ['name' => 'Crunch', 'rep' => 50, 'break' => 45, 'weight' => 0],
                ['name' => 'Planche sur le côté', 'rep' => 1, 'break' => 45, 'weight' => 0, 'duration' => 40],
                ['name' => 'V-up', 'rep' => 35, 'break' => 45, 'weight' => 0],
                ['name' => 'Bicycle crunch', 'rep' => 40, 'break' => 45, 'weight' => 0],
            ],
        ];

        foreach ($exercises as $day => $exercisesForDay) {
            $dayIndex = (int) filter_var($day, FILTER_SANITIZE_NUMBER_INT);

            foreach ($exercisesForDay as $index => $exerciseData) {
                $exercise = Exercise::where('name', $exerciseData['name'])->first();

                if ($exercise) {
                    $program->exercises()->attach($exercise->id, [
                        'day' => $dayIndex,
                        'order' => $index + 1,
                        'rep' => $exerciseData['rep'],
                        'break' => $exerciseData['break'],
                        'weight' => $exerciseData['weight'],
                    ]);
                }
            }
        }



        $program = Program::create([
            'name' => 'Défi 10 jours fessiers',
            'description' => 'Défi de 10 jours pour travailler les fessiers',
            'image' => 'images/programs/defi-10-jours-fessiers.webp',
            'status' => 1,
            'user_id' => 2,
        ]);

        $exercises = [
            'Jour 1' => [
                ['name' => 'Squat', 'rep' => 15, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 12, 'break' => 60, 'weight' => 0],
                ['name' => 'Soulevé de terre roumain', 'rep' => 12, 'break' => 60, 'weight' => 0],
                ['name' => 'Élévation de mollets debout', 'rep' => 20, 'break' => 60, 'weight' => 0],
            ],
            'Jour 2' => [
                ['name' => 'Fentes sautées', 'rep' => 20, 'break' => 60, 'weight' => 0],
                ['name' => 'Squat sumo', 'rep' => 15, 'break' => 60, 'weight' => 0],
                ['name' => 'Adduction de la hanche', 'rep' => 15, 'break' => 60, 'weight' => 0],
                ['name' => 'Élévation de mollets assis', 'rep' => 20, 'break' => 60, 'weight' => 0],
            ],
            'Jour 3' => [
                ['name' => 'Squat', 'rep' => 20, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 15, 'break' => 60, 'weight' => 0],
                ['name' => 'Leg curl', 'rep' => 12, 'break' => 60, 'weight' => 0],
                ['name' => 'Élévation de mollets debout', 'rep' => 25, 'break' => 60, 'weight' => 0],
            ],
            'Jour 4' => [
                ['name' => 'Jumping jacks', 'rep' => 30, 'break' => 60, 'weight' => 0],
                ['name' => 'Squat sumo', 'rep' => 20, 'break' => 60, 'weight' => 0],
                ['name' => 'Soulevé de terre roumain', 'rep' => 15, 'break' => 60, 'weight' => 0],
                ['name' => 'Élévation de mollets assis', 'rep' => 25, 'break' => 60, 'weight' => 0],
            ],
            'Jour 5' => [
                ['name' => 'Squat', 'rep' => 25, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 20, 'break' => 60, 'weight' => 0],
                ['name' => 'Adduction de la hanche', 'rep' => 20, 'break' => 60, 'weight' => 0],
                ['name' => 'Élévation de mollets debout', 'rep' => 30, 'break' => 60, 'weight' => 0],
            ],
            'Jour 6' => [
                ['name' => 'Fentes sautées', 'rep' => 25, 'break' => 60, 'weight' => 0],
                ['name' => 'Squat sumo', 'rep' => 25, 'break' => 60, 'weight' => 0],
                ['name' => 'Leg curl', 'rep' => 15, 'break' => 60, 'weight' => 0],
                ['name' => 'Élévation de mollets assis', 'rep' => 30, 'break' => 60, 'weight' => 0],
            ],
            'Jour 7' => [
                ['name' => 'Squat', 'rep' => 30, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 25, 'break' => 60, 'weight' => 0],
                ['name' => 'Soulevé de terre roumain', 'rep' => 20, 'break' => 60, 'weight' => 0],
                ['name' => 'Élévation de mollets debout', 'rep' => 35, 'break' => 60, 'weight' => 0],
            ],
            'Jour 8' => [
                ['name' => 'Jumping jacks', 'rep' => 40, 'break' => 60, 'weight' => 0],
                ['name' => 'Squat sumo', 'rep' => 30, 'break' => 60, 'weight' => 0],
                ['name' => 'Adduction de la hanche', 'rep' => 25, 'break' => 60, 'weight' => 0],
                ['name' => 'Élévation de mollets assis', 'rep' => 35, 'break' => 60, 'weight' => 0],
            ],
            'Jour 9' => [
                ['name' => 'Squat', 'rep' => 35, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 30, 'break' => 60, 'weight' => 0],
                ['name' => 'Leg curl', 'rep' => 20, 'break' => 60, 'weight' => 0],
                ['name' => 'Élévation de mollets debout', 'rep' => 40, 'break' => 60, 'weight' => 0],
            ],
            'Jour 10' => [
                ['name' => 'Fentes sautées', 'rep' => 30, 'break' => 60, 'weight' => 0],
                ['name' => 'Squat sumo', 'rep' => 35, 'break' => 60, 'weight' => 0],
                ['name' => 'Soulevé de terre roumain', 'rep' => 25, 'break' => 60, 'weight' => 0],
                ['name' => 'Élévation de mollets assis', 'rep' => 40, 'break' => 60, 'weight' => 0],
            ],
        ];

        foreach ($exercises as $day => $exercisesForDay) {
            $dayIndex = (int) filter_var($day, FILTER_SANITIZE_NUMBER_INT);

            foreach ($exercisesForDay as $index => $exerciseData) {
                $exercise = Exercise::where('name', $exerciseData['name'])->first();

                if ($exercise) {
                    $program->exercises()->attach($exercise->id, [
                        'day' => $dayIndex,
                        'order' => $index + 1,
                        'rep' => $exerciseData['rep'],
                        'break' => $exerciseData['break'],
                        'weight' => $exerciseData['weight'],
                    ]);
                }
            }
        }
    }
}
