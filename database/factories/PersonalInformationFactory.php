<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalInformation>
 */
class PersonalInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        $first_name = fake()->firstName($gender);
        $last_name = fake()->lastName();
        $nationality = 'Filipino';
        $birthday = fake()->dateTimeBetween('1990-07-01', '2000-01-01');
        $age = 2024 - (int)Carbon::parse($birthday)->year;
        $civil_status = fake()->randomElement([
            "Single",
            "Married",
            "Divorced",
            "Widowed",
            "Separated",
            "Engaged",
            "In a civil partnership",
            "In a domestic partnership",
            "Annulled",
            "Common-Law"
        ]);

        return [
            "first_name" =>  $first_name,
            "last_name" =>  $last_name,
            "nationality" => $nationality,
            "gender" =>  $gender,
            "age" =>  $age,
            "civil_status" =>  $civil_status,
            "birthday" =>  $birthday,
        ];
    }
}
