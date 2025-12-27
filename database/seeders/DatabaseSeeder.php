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

        User::factory()->admin()->create([
            'name' => 'Admin 1',
            'password' => 'password',
            'email' => 'admin1@thrif.test',
        ]);

        User::factory()->admin()->create([
            'name' => 'Admin 2',
            'password' => 'password',
            'email' => 'admin2@thrif.test',
        ]);
    }
}
