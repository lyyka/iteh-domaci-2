<?php

namespace Database\Factories;

use App\Enums\PetColor;
use App\Enums\PetType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'type' => $this->faker->randomElement(PetType::all()),
            'colors' => $this->faker->randomElements(PetColor::all(), 2),
            'date_of_birth' => $this->faker->date(),
        ];
    }

    public function forUser(User $user): PetFactory
    {
        return $this->state(fn(array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}
