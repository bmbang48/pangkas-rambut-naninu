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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        \App\Models\Barber::insert([
            ['name' => 'Ahmad Rizki', 'experience' => 8],
            ['name' => 'Budi Santoso', 'experience' => 5],
            ['name' => 'Dimas Pratama', 'experience' => 6],
            ['name' => 'Eko Wijaya', 'experience' => 4],
        ]);

        \App\Models\Service::insert([
            ['name' => 'Haircut', 'duration' => 30, 'price' => 30000],
            ['name' => 'Haircut + Wash', 'duration' => 45, 'price' => 40000],
            ['name' => 'Haircut + Beard', 'duration' => 45, 'price' => 45000],
        ]);
    }
}
