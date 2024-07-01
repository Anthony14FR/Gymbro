<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Muscle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'lang' => 'fr',
            'image' => $this->faker->imageUrl(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Exercise $exercise) {
            $muscles = Muscle::inRandomOrder()->take(2)->pluck('id');
            $exercise->muscles()->attach($muscles);
        });
    }
}