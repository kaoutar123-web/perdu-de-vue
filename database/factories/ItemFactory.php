<?php

namespace Database\Factories;

use App\Enums\Color;
use App\Models\Item;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'place_id' => Place::factory(),
            'name' => fake()->words(3, true),
            'description' => fake()->optional()->sentence(),
            'color' => fake()->randomElement(Color::cases()),
            'found_on' => fake()->dateTimeBetween('2026-10-01', '2026-10-31'),
            'returned_at' => null,
        ];
    }

    public function returned(): static
    {
        return $this->state(fn () => [
            'returned_at' => fake()->dateTimeBetween('2026-10-15', '2026-10-31'),
        ]);
    }
}
