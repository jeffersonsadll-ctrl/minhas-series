<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $table = 'series';

    protected $fillable = [
        'title',
    ];

    public function temporadas()
    {
        return $this->hasMany(Temporadas::class, 'series_id');
    }
}
