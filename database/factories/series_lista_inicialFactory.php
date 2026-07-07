<?php

namespace Database\Factories;

use App\Models\Series;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Series>
 */
class series_lista_inicialFactory extends Factory
{
    protected $model = Series::class;

    private const TITLES = [
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

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(self::TITLES),
        ];
    }

    /**
     * @return array<int, string>
     */
    public static function titles(): array
    {
        return self::TITLES;
    }
}
