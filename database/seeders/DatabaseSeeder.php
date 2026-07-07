<?php

namespace Database\Seeders;

use App\Models\Series;
use App\Models\User;
use Database\Factories\series_lista_inicialFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (series_lista_inicialFactory::titles() as $title) {
            Series::firstOrCreate(['title' => $title]);
        }

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
