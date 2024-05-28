<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            "Greenwood High School",
            "Maple Leaf Academy",
            "Riverdale Secondary",
            "Hillside School",
            "Sunnydale Institute",
            "Springfield Elementary",
            "Cedarwood High",
            "Lakeside College",
            "Mountainview Academy",
            "Ocean Breeze High",
            "Pinecrest School",
            "Silver Oaks Secondary",
            "Golden Valley School",
            "Redwood High",
            "Blue Ridge Academy",
            "Meadowbrook School",
            "Windy Hill High",
            "Crystal Lake Institute",
            "Bright Future Academy",
            "Starlight High",
            "Sunrise Elementary",
            "Evergreen Academy",
            "Whispering Pines School",
            "Northern Lights High",
            "Harmony Secondary"
        ];
        foreach ($schools as $school) {
            School::create([
                "name" => $school,
                "school_category_id" => rand(1, 2),
            ]);
        }
    }
}
