<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Series;
use Tests\TestCase;

class SeriesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_lista_as_series_cadastradas(): void
    {
        Series::create(['title' => 'Breaking Bad']);
        Series::create(['title' => 'The Office']);
        Series::create(['title' => 'teste']);

        $response = $this->get('/series');

        $response->assertOk()
            ->assertViewIs('series.index')
            ->assertViewHas('listSeries', function ($series) {
                return $series->pluck('title')->all() === ['Breaking Bad', 'The Office', 'teste'];
            });
    }
}
