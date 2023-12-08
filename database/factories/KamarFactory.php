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
        $type = ['VVIP','VIP','DELUXE','EKONOMIS'];
        $status = ['1','2'];
        return [
            'tipe_kamar'=> $this->faker->randomElement($type),
            'kode'=> 'KA-0'. $this->faker->unique()->randomDigit(),
            'ket'=> $this->faker->paragraph(),
            'ruangan'=> $this->faker->word(),
            'status'=> $this->faker->randomElement($status),
        ];
    }
}
