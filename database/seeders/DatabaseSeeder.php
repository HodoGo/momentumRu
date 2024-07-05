<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            "name" => "momentum24",
            "username" => "momentum24",
            "email" => "momentum24@gmail.com",
            "password" => Hash::make("momentum2024password"),
            "school_category_id" => null,
        ]);
        User::create([
            "name" => "momentumsmp",
            "username" => "momentumsmp",
            "email" => "momentumsmp@gmail.com",
            "password" => Hash::make("password"),
            "school_category_id" => "1",
        ]);
        User::create([
            "name" => "momentumsma",
            "username" => "momentumsma",
            "email" => "momentumsma@gmail.com",
            "password" => Hash::make("password"),
            "school_category_id" => "2",
        ]);
        $this->call(SchoolCategorySeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(QuizTypeSeeder::class);
        $this->call(StudentSeeder::class);
    }
}
