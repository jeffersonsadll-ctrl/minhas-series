<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Series;

class seriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listSeries = Series::query()
            ->select('title', 'id')
            ->orderBy('title', 'asc')
            ->get();

        return view('series.index')
            ->with('listSeries', $listSeries);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rs_insert = Series::create($request->all());

        if( $rs_insert ) {
            return redirect()->route('series.index');
        } else {
            return redirect()->back()->withInput();
        }
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
        Series::destroy($id);
        return redirect()->route('series.index');
    }
}
