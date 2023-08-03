<?php

namespace Database\Seeders;

use App\Models\TipeKamar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipeKamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipeKamar::insert([
            ['tipe'=> 'Luxury'],
            ['tipe'=> 'Ekonomis'],
        ]);
    }
}
