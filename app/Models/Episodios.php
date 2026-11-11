<?php

namespace App\Models;

use Attribute;
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
    protected $casts = [
        'assistido' => 'boolean',
    ];

    public function temporadas()
    {
        return $this->belongsTo(Temporadas::class, 'temporadas_id');
    }

    protected function assistido(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (bool) $value,
        );
    }
}
