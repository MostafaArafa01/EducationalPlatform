<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courses=Course::all();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Student');
        })->get();
        return [
            // 'progress' => $this->faker->randomFloat(null,0,100,
            'course_id' => $courses->random(),
            'user_id' => $users->random(),
        ];
    }
}
