<?php

namespace Database\Seeders;

use App\Models\QuizType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                "name" => "MC",
                "description" => "Multiple Choice",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "TF",
                "description" => "True False",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "ES",
                "description" => "Essay",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ];
        QuizType::insert($types);
    }
}
