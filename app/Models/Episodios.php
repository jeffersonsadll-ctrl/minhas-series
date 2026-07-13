<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episodios extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function temporadas()
    {
        return $this->belongsTo(Temporadas::class, 'temporadas_id');
    }
}
