<?php

namespace App\Hateoas;

use App\Models\Series;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class SeriesHateoas
{
    use CreatesLinks;

    public function self(Series $series) : ?Link
    {
        return $this->link('series.show', ['series' => $series->id]);
    }

    public function temporadas(Series $series) : ?Link
    {
        return $this->link('series.temporadas', ['id' => $series->id]);
    }

    public function episodios(Series $series) : ?Link
    {
        return $this->link('series.episodios', ['id' => $series->id]);
    }
}
