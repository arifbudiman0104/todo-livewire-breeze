<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
        User::factory()->create([
            'name' => 'Arif Budiman Arrosyid',
            'email' => 'arifbudimanarrosyid@gmail.com',
        ]);
        Todo::factory(20)->create();
    }
}
