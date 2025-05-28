<?php

namespace Database\Seeders;

use App\Models\SchoolCategory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "name" => "SMP",
                "description" => "Младшая средняя школа",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "name" => "SMA",
                "description" => "Высшая средняя школа",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ];
        SchoolCategory::insert($categories);
    }
}
