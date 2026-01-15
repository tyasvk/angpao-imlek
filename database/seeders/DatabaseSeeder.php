<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
public function run(): void
{
    \App\Models\AngpaoPool::create([
        'name' => 'Angpao Berkah Imlek 2026',
        'total_amount' => 1000000, // Rp 1.000.000
        'total_slots' => 50, // Untuk 50 orang
        'remaining_slots' => 50,
        'status' => 'active',
    ]);
}
}
