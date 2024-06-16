<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GeneralInformation>
 */
class GeneralInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => rand(1, 27),
            'branch_id' => rand(1, 8),
            'student_number' => rand(18, 24) . "-" . rand(1000, 5000),
            'graduation_year' => rand(2018, 2024),
        ];
    }
}
