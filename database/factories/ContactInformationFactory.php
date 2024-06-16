<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactInformation>
 */
class ContactInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = fake()->randomElement([
            "Caloocan",
            "Las Piñas",
            "Makati",
            "Malabon",
            "Mandaluyong",
            "Manila",
            "Marikina",
            "Muntinlupa",
            "Navotas",
            "Parañaque",
            "Pasay",
            "Pasig",
            "Quezon City",
            "San Juan",
            "Taguig",
            "Valenzuela",
            "Pateros",
            "Meycauayan",
            "San Jose del Monte",
            "Obando"
        ]);


        return [
            'mobile_number' => fake()->phoneNumber(),
            'home_number' => fake()->phoneNumber(),
            'work_number' => fake()->phoneNumber(),
            'address'=> fake()->address(),
            'region' => 'NCR',
            'city' => $city,
            'postal_code' => 1470,
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://x.com',
            'linkedin' => 'https://www.linkedin.com'
        ];
    }
}
