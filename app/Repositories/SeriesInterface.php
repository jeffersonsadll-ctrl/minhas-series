<?php 
namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;

interface SeriesInterface
{
    public function add(SeriesFormRequest $request): ?\App\Models\Series;
}