<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamar>
 */
class KamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = ['Luxury','Ekonomis'];
        $status = ['1','2'];
        return [
            'tipe_kamar'=> $this->faker->randomElement($type),
            'kode'=> $this->faker->unique()->randomDigit(),
            'status'=> $this->faker->randomElement($status),
        ];
    }
}
