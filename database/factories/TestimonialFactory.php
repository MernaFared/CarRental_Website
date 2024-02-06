<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
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
            'position' => fake()->jobTitle(),
            'content' => fake()->text(),
            'published' => fake()->numberBetween(0, 1),
            'image' => fake()->randomElement(['person_1.jpg', 'person_2.jpg', 'person_3.jpg', 'person_4.jpg', 'person_5.jpg'])
        ];
    
    }
}
