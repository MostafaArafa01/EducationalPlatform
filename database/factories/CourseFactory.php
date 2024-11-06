<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $instructors = User::whereHas('roles', function ($query) {
            $query->where('name', 'Instructor');
        })->get();
        return [
            'title' => $this->faker->sentence(),
            'instructor_id' => $instructors->random(),
        ];
    }
}