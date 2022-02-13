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
            'first_name' => 'The Dog',
            'last_name' => 'Whisperer',
            'role' => 'vet',
            'email' => 'test@test.com',
        ]);

        User::factory()->create([
            'first_name' => 'Cesar',
            'last_name' => 'Millan',
            'role' => 'vet',
            'email' => 'test@testt.com',
        ]);

        User::factory()->create([
            'first_name' => 'The Pooch',
            'last_name' => 'Paramedic',
            'role' => 'vet',
            'email' => 'test@testtt.com',
        ]);

        $users = User::factory(50)
            ->has(Patient::factory()->count(2))
            ->create();
    }
}
