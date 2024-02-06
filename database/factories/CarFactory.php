<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                "Toyota","Honda","Ford,Chevrolet ", "Volkswagen","Nissan","BMW",
                "Mercedes-Benz","Audi","Tesla","Hyundai",
                "Kia","Subaru","Mazda","Porsche","Ferrari","Lamborghini",
                "Aston Martin" ,"Rolls-Royce","Bentley"
            ]),
            'doors' => fake()->numberBetween(4, 6),
            'luggage' => fake()->numberBetween(2, 6),
            'passengers' => fake()->numberBetween(2, 6),
            'price'=> fake()->randomFloat(nbMaxDecimals: 2, min: 10, max: 100),
            'description' => fake()->text(),
            'image' => fake()->randomElement(['car_1.jpg', 'car_2.jpg', 'car_3.jpg', 'car_4.jpg', 'car_5.jpg', 'car_6.jpg', 'car_7.jpg']),
            'active' =>fake()->numberBetween(0,1),
            'category_id' =>fake()->numberBetween(1, 10),
        ];
    }
}
