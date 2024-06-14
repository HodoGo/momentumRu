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
                "username" => "ikbaldjaya",
                "password" => "password",
                "name" => "Ikbal Djaya",
                "gender" => "male",
                "school_id" => "1",
            ],
        ];
        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
