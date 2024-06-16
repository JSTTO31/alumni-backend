<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $caption = fake()->randomElement([
            "Enjoying the little things in life. 🌟",
            "Exploring new horizons. 🌄",
            "Chasing dreams and catching sunsets. 🌅",
            "Embracing the journey, one step at a time. 👣",
            "Finding beauty in every moment. 🌺",
            "Creating memories that last a lifetime. 📸",
            "Living life with a grateful heart. ❤️",
            "Adventures await! 🌿",
            "Life is a beautiful ride. 🚲",
            "Dream big, sparkle more, shine bright. ✨",
            "Inhale confidence, exhale doubt. 💪",
            "Savoring the sweetness of life. 🍭",
            "Dancing through life like nobody's watching. 💃",
            "Sunshine and smiles. ☀️😊",
            "Making waves and catching rays. 🌊",
            "Blessed beyond measure. 🙏",
            "Laughing our way through life. 😄",
            "Here's to new beginnings! 🌟",
            "Living the adventure one photo at a time. 📷",
            "Every moment counts. ⏳",
            "Wander often, wonder always. 🌍",
            "Seize the day and make it yours. 🌟",
            "Happiness is homemade. 🏡❤️",
            "Collecting memories, not things. 🎈",
            "Smile, it's contagious! 😊"
        ]);
        return [
            'title' => $caption,
            'location' => 'https://productivity-pink.vercel.app/'
        ];
    }
}
