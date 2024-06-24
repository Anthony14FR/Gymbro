<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            [
                'name' => 'Squat',
                'lang' => 'fr',
                'image' => 'https://www.youtube.com/watch?v=U3Hj5XQ6rjY',
                'muscle_id' => 1,
            ],
            [
                'name' => 'Soulevé de terre',
                'lang' => 'fr',
                'image' => 'https://www.youtube.com/watch?v=U3Hj5XQ6rjY',
                'muscle_id' => 1,
            ],
            [
                'name' => 'Développé couché',
                'lang' => 'fr',
                'image' => 'https://www.youtube.com/watch?v=U3Hj5XQ6rjY',
                'muscle_id' => 2,
            ],
            [
                'name' => 'Traction',
                'lang' => 'fr',
                'image' => 'https://www.youtube.com/watch?v=U3Hj5XQ6rjY',
                'muscle_id' => 3,
            ],
            [
                'name' => 'Rowing dos',
                'lang' => 'fr',
                'image' => 'https://www.youtube.com/watch?v=U3Hj5XQ6rjY',
                'muscle_id' => 3,
            ],
            [
                'name' => 'Curl biceps',
                'lang' => 'fr',
                'image' => 'https://www.youtube.com/watch?v=U3Hj5XQ6rjY',
                'muscle_id' => 4,
            ],
            [
                'name' => 'Extension triceps',
                'lang' => 'fr',
                'image' => 'https://www.youtube.com/watch?v=U3Hj5XQ6rjY',
                'muscle_id' => 5,
            ],
            [
                'name' => 'Crunch',
                'lang' => 'fr',
                'image' => 'https://www.youtube.com/watch?v=U3Hj5XQ6rjY',
                'muscle_id' => 6,
            ],
            [
                'name' => 'Leg curl',
                'lang' => 'fr',
                'image' => 'https://www.youtube.com/watch?v=U3Hj5XQ6rjY',
                'muscle_id' => 7,
            ],
            [
                'name' => 'Leg extension',
                'lang' => 'fr',
                'image' => 'https://www.youtube.com/watch?v=U3Hj5XQ6rjY',
                'muscle_id' => 7,
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
