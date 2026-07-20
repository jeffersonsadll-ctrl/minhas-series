<?php

namespace Database\Seeders;

use App\Models\Series;
use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
    /**
     * Seed the application's database with initial series titles.
     */
    public function run(): void
    {
        $titles = [
            'Breaking Bad',
            'Game of Thrones',
            'The Office',
            'Stranger Things',
            'The Crown',
            'The Mandalorian',
            'Chernobyl',
            'Sherlock',
            'The Witcher',
            'Peaky Blinders',
            'Dark',
            'Ozark',
            'The Boys',
            'Money Heist',
            'Narcos',
            'The Last of Us',
            'Succession',
            'The Marvelous Mrs. Maisel',
            'Mindhunter',
            'Dexter',
        ];

        foreach ($titles as $title) {
            Series::firstOrCreate(['title' => $title]);
        }
    }
}
