<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $attainment = fake()->randomElement([
            "No Formal Education",
            "Elementary Graduate",
            "High School Graduate",
            "Vocational Diploma/Certificate",
            "Bachelor's Degree",
            "Master's Degree",
            "Doctorate Degree",
            "Post-Doctorate Degree"
        ]);

        $school = fake()->randomElement([
            "University of the Philippines (UP)",
            "Ateneo de Manila University",
            "De La Salle University (DLSU)",
            "University of Santo Tomas (UST)",
            "Far Eastern University (FEU)",
            "Mapua University",
            "Adamson University",
            "University of the East (UE)",
            "Polytechnic University of the Philippines (PUP)",
            "National University (NU)",
            "Arellano University",
            "San Beda University",
            "University of Asia and the Pacific (UA&P)",
            "Lyceum of the Philippines University",
            "Technological University of the Philippines (TUP)"
        ]);

        $field = fake()->randomElement([
            "Computer Science",
            "Engineering",
            "Business Administration",
            "Psychology",
            "Education",
            "Biology",
            "Architecture",
            "Communication Studies",
            "Accounting",
            "Political Science"
        ]);

        return [
            'attainment' => $attainment,
            'school' => $school,
            'field' => $field,
            'major' => $field,
            'graduated_at' => fake()->dateTimeBetween('-5 years'),
        ];
    }
}
