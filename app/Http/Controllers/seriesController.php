<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class seriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listSeries = [
            'Breaking Bad',
            'Game of Thrones',
            'The Office',
            'Stranger Things',
            'The Crown',
            'The Mandalorian',
            'Chernobyl',
            'Sherlock',
            'The Witcher',
            'Peaky Blinders',
            'Dark',
            'Ozark',
            'The Boys',
            'Money Heist',
            'Narcos',
            'The Last of Us',
            'Succession',
            'The Marvelous Mrs. Maisel',
            'Mindhunter',
            'Dexter'
        ];

        return view('series.index')
            ->with('listSeries', $listSeries);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
