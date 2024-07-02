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
            'status' => 1, // Public
            'user_id' => $userId,
        ]);

        $exercises = [
            'Jour 1' => [
                ['name' => 'Crunch', 'rep' => 20, 'break' => 60, 'weight' => 0],
                ['name' => 'Plank', 'rep' => 1, 'break' => 60, 'weight' => 0, 'duration' => 60],
            ],
            'Jour 2' => [
                ['name' => 'Russian twist', 'rep' => 30, 'break' => 60, 'weight' => 0],
                ['name' => 'Side plank', 'rep' => 1, 'break' => 60, 'weight' => 0, 'duration' => 60],
            ],
            'Jour 3' => [
                ['name' => 'Crunch', 'rep' => 25, 'break' => 60, 'weight' => 0],
                ['name' => 'Plank', 'rep' => 1, 'break' => 60, 'weight' => 0, 'duration' => 70],
            ],
            'Jour 4' => [
                ['name' => 'Russian twist', 'rep' => 35, 'break' => 60, 'weight' => 0],
                ['name' => 'Side plank', 'rep' => 1, 'break' => 60, 'weight' => 0, 'duration' => 70],
            ],
            'Jour 5' => [
                ['name' => 'Crunch', 'rep' => 30, 'break' => 60, 'weight' => 0],
                ['name' => 'Plank', 'rep' => 1, 'break' => 60, 'weight' => 0, 'duration' => 80],
            ],
            'Jour 6' => [
                ['name' => 'Russian twist', 'rep' => 40, 'break' => 60, 'weight' => 0],
                ['name' => 'Side plank', 'rep' => 1, 'break' => 60, 'weight' => 0, 'duration' => 80],
            ],
            'Jour 7' => [
                ['name' => 'Crunch', 'rep' => 35, 'break' => 60, 'weight' => 0],
                ['name' => 'Plank', 'rep' => 1, 'break' => 60, 'weight' => 0, 'duration' => 90],
            ],
            'Jour 8' => [
                ['name' => 'Russian twist', 'rep' => 45, 'break' => 60, 'weight' => 0],
                ['name' => 'Side plank', 'rep' => 1, 'break' => 60, 'weight' => 0, 'duration' => 90],
            ],
            'Jour 9' => [
                ['name' => 'Crunch', 'rep' => 40, 'break' => 60, 'weight' => 0],
                ['name' => 'Plank', 'rep' => 1, 'break' => 60, 'weight' => 0, 'duration' => 100],
            ],
            'Jour 10' => [
                ['name' => 'Russian twist', 'rep' => 50, 'break' => 60, 'weight' => 0],
                ['name' => 'Side plank', 'rep' => 1, 'break' => 60, 'weight' => 0, 'duration' => 100],
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
            'status' => 1,
            'user_id' => 2,
        ]);

        $exercises = [
            'Jour 1' => [
                ['name' => 'Squats', 'rep' => 20, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 20, 'break' => 60, 'weight' => 0],
            ],
            'Jour 2' => [
                ['name' => 'Squats', 'rep' => 25, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 25, 'break' => 60, 'weight' => 0],
            ],
            'Jour 3' => [
                ['name' => 'Squats', 'rep' => 30, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 30, 'break' => 60, 'weight' => 0],
            ],
            'Jour 4' => [
                ['name' => 'Squats', 'rep' => 35, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 35, 'break' => 60, 'weight' => 0],
            ],
            'Jour 5' => [
                ['name' => 'Squats', 'rep' => 40, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 40, 'break' => 60, 'weight' => 0],
            ],
            'Jour 6' => [
                ['name' => 'Squats', 'rep' => 45, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 45, 'break' => 60, 'weight' => 0],
            ],
            'Jour 7' => [
                ['name' => 'Squats', 'rep' => 50, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 50, 'break' => 60, 'weight' => 0],
            ],
            'Jour 8' => [
                ['name' => 'Squats', 'rep' => 55, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 55, 'break' => 60, 'weight' => 0],
            ],
            'Jour 9' => [
                ['name' => 'Squats', 'rep' => 60, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 60, 'break' => 60, 'weight' => 0],
            ],
            'Jour 10' => [
                ['name' => 'Squats', 'rep' => 65, 'break' => 60, 'weight' => 0],
                ['name' => 'Fentes', 'rep' => 65, 'break' => 60, 'weight' => 0],
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
