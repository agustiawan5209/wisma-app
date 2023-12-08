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
            ['tipe'=> 'VVIP', 'harga'=> '300000'],
            ['tipe'=> 'VIP', 'harga'=> '250000'],
            ['tipe'=> 'DELUXE', 'harga'=> '200000'],
            ['tipe'=> 'EKONOMIS', 'harga'=> '150000'],
        ]);
    }
}
