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
                "description" => "Несколько вариантов",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "TF",
                "description" => "Правда Ложь",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "ES",
                "description" => "Сочинение",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ];
        QuizType::insert($types);
    }
}
