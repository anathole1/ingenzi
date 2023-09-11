<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' =>  $this->faker->sentence(3),
            'slug'  =>  $this->faker->slug(),
            'description'   =>  $this->faker->paragraph(),
            'category_id'   =>  1,
            'image' => null
        ];
    }
}
