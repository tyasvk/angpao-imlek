<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AngpaoPool;

class AngpaoSeeder extends Seeder
{
    public function run(): void
    {
        AngpaoPool::create([
            'name' => 'Angpao Berkah Imlek',
            'total_amount' => 500000, // Total uang Rp 500.000
            'total_slots' => 10,       // Untuk 10 orang
            'remaining_slots' => 10,
            'status' => 'active',
        ]);
    }
}