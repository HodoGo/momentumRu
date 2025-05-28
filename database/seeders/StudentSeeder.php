<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                "username" => "ivanovivan",
                "password" => "password",
                "name" => "Иванов Иван Иванович",
                "gender" => "male",
                "school_id" => "3",
            ],
        ];
        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
