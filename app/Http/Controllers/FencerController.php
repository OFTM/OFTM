<?php

namespace App\Http\Controllers;

use App\fencer;
use Illuminate\Http\Request;

class FencerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fencer.list');
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
     * @param  \App\fencer  $fencer
     * @return \Illuminate\Http\Response
     */
    public function show(fencer $fencer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\fencer  $fencer
     * @return \Illuminate\Http\Response
     */
    public function edit(fencer $fencer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\fencer  $fencer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fencer $fencer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\fencer  $fencer
     * @return \Illuminate\Http\Response
     */
    public function destroy(fencer $fencer)
    {
        //
    }
}
