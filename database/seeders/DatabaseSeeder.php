<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Dog',
            'last_name' => 'Whisperer',
            'role' => 'vet',
            'email' => 'test@test.com',
        ]);

        $users = User::factory(50)
            ->has(Patient::factory())
            ->create();
    }
}
