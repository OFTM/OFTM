<?php

namespace App\Http\Controllers;

use App\tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tournament.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(tournament $tournament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(tournament $tournament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tournament $tournament)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(tournament $tournament)
    {
        //
    }
}
