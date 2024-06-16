<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            "Communication",
            "Teamwork",
            "Problem-solving",
            "Time management",
            "Critical thinking",
            "Project management",
            "Adaptability",
            "Creativity",
            "Conflict resolution",
            "Leadership",
            "Technical writing",
            "Customer service",
            "Data analysis",
            "Coding",
            "Networking",
            "Graphic design",
            "SEO",
            "Social media management",
            "Public speaking",
            "Research",
            "Decision making",
            "Attention to detail",
            "Sales",
            "Marketing",
            "Budgeting",
            "Financial analysis",
            "Human resources",
            "Negotiation",
            "Strategic planning",
            "Mentoring",
            "Coaching",
            "Presentation",
            "Scheduling",
            "Multitasking",
            "Delegation",
            "Writing",
            "Editing",
            "Training",
            "Event planning",
            "Technical support",
            "Quality assurance",
            "Inventory management",
            "Logistics",
            "Foreign languages",
            "Legal knowledge",
            "Compliance",
            "Web development",
            "Database management",
            "IT support",
            "User experience (UX) design"
        ]);

        return [
            'name' => $name,
            'years' => rand(1, 5),
            'proficiency' => rand(1, 4),
            'pinned' => fake()->randomElement([true, false])
        ];
    }
}
