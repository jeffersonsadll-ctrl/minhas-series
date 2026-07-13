<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporadas extends Model
{
    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id');
    }

    public function episodios()
    {
        return $this->hasMany(Episodios::class, 'temporadas_id');
    }
}
