<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episodios extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'numero_episodio',
        'titulo',
        'descricao',
    ];
    protected $table = 'episodios';

    public function temporadas()
    {
        return $this->belongsTo(Temporadas::class, 'temporadas_id');
    }
}
