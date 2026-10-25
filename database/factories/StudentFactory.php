<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),

            'gender' => fake()->randomElement([
                'male',
                'female'
            ]),

            'stream' => fake()->randomElement([
                'BSc',
                'BA',
                'BCom',
                'BEng',
                'BBA'
            ]),

            'subject' => fake()->randomElement([
                'C,Java',
                'C++,Python',
                'Java,PHP',
                'Python,JavaScript',
                'PHP,JavaScript'
            ]),

            'stdimg' => 'default.jpg',
        ];
    }
}
