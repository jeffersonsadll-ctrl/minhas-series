<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Models\User;
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

    public function test_update_serie_cadastrada(): void
    {
        $usuario = User::factory()->create();
        $this->actingAs($usuario);
        
        $serie = Series::create(['title' => 'Breaking Bad']);

        $response = $this->put(route('series.update', $serie), [
            "title" => "Breaking Bad Updated",
        ]);

        $response->assertStatus(302)
            ->assertSessionHas('message.success', 'Série \'Breaking Bad Updated\' atualizada com sucesso!')
            ->assertRedirect(route('series.index'));

        $this->assertDatabaseHas('series', [
            'id' => $serie->id,
            'title' => 'Breaking Bad Updated',
        ]);
    }

    public function test_delete_serie_cadastrada(): void
    {
        $usuario = User::factory()->create();
        $this->actingAs($usuario);

        $serie = Series::create(['title' => 'House of Cards']);

        $response = $this->delete(route("series.destroy", $serie));

        $response->assertRedirect(route("series.index"));

        $this->assertDatabaseMissing('series', [
            'id' => $serie->id,
            'title' => $serie->title
        ]);

    }
}
