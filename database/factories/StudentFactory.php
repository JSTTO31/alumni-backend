<?php

namespace Database\Factories;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
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

        $departments = Department::all()->map(fn($item) => $item->id);

        $student_number = $this->faker->numberBetween(18, 23) . '-' . $this->faker->randomDigit() . $this->faker->randomDigit() . $this->faker->randomDigit() . $this->faker->randomDigit() . $this->faker->randomDigit();

        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'student_number' => $student_number,
            'department_id' => $this->faker->randomElement($departments),
            'first_name' => $this->faker->firstName($gender),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->lastName(),
            'nationality' => 'Filipino',
            'gender' => $gender,
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'marital_status' => $this->faker->randomElement(['single', 'single', 'married']),
            'birthday' => Carbon::parse('2000/10/20'),

        ];
    }
}
