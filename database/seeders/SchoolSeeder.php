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
            'Средняя школа Гринвуд',
            'Академия Кленового Листа',
            'Ривердейлская средняя школа',
            'Школа Хиллсайд',
            'Саннидейлский институт',
            'Спрингфилдская начальная школа',
            'Кедровая школа',
            'Лейксайдский колледж',
            'Академия Маунтинвью',
            'Ocean Breeze High',
            'Школа Пайнкрест',
            'Серебряные дубы средняя школа',
            'Golden Valley School',
            'Редвуд Хай',
            'Академия Блю Ридж',
            'Meadowbrook School',
            'Windy Hill High',
            'Crystal Lake Institute',
            'Академия светлого будущего',
            'Старлайт Хай',
            'Sunrise Elementary',
            'Эвергрин Академия',
            'Whispering Pines School',
            'Northern Lights High',
            'Средняя школа Гармонии'
        ];
        foreach ($schools as $school) {
            School::create([
                "name" => $school,
                "school_category_id" => rand(1, 2),
            ]);
        }
    }
}
