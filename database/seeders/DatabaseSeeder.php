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

        User::factory()->admin()->create([
            'name' => 'Admin Demo',
            'password' => 'password',
            'email' => 'admin@thrif.test',
        ]);

        User::factory()->create([
            'name' => 'Customer Demo',
            'email' => 'customer@thrif.test',
        ]);
    }
}
