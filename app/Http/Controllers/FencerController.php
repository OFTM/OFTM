<?php

namespace App\Http\Controllers;

use App\fencer;
use App\people;
use App\sex;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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
        return view('fencer.create', ['sexes' => sex::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'person-forename' => 'required',
            'person-surname' => 'required',
            'person-birthdate' => 'required|date',
            'person-sex' => 'required'
        ]);

        $fencer = new fencer;
        $person = new people(['forename' => $validated['person-forename'], 'surname' => $validated['person-surname'], 'birthdate' => Carbon::parse($validated['person-birthdate'])]);
        $sex = sex::all()->where('name', 'IS', $validated['person-sex'])->first();
        $person->sex()->associate($sex);
        $person->save();
        $fencer->person()->associate($person);
        $fencer->save();
        return redirect()->route('fencers.show', ['fencer' => $fencer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\fencer  $fencer
     * @return \Illuminate\Http\Response
     */
    public function show(fencer $fencer)
    {
        return view('fencer.view', ['fencer' => $fencer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\fencer  $fencer
     * @return \Illuminate\Http\Response
     */
    public function edit(fencer $fencer)
    {
        return view('fencer.edit', ['fencer' => $fencer, 'sexes' => sex::all()]);
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
        $validated = $request->validate([
            'person-forename' => 'required',
            'person-surname' => 'required',
            'person-birthdate' => 'required|date',
            'person-sex' => 'required'
        ]);
        $fencer->load('person');
        $fencer->person->load('sex');
        $fencer->person->update(['forename' => $validated['person-forename'], 'surname' => $validated['person-surname'], 'birthdate' => Carbon::parse($validated['person-birthdate'])]);
        if($fencer->person->sex->name != $validated['person-sex']) {
            $fencer->person->sex()->dissociate();
            $fencer->person->sex()->associate(sex::all()->where('name', 'IS', $validated['person-sex'])->first());
        }
        $fencer->save();
        $fencer->person->save();
        return view('fencer.view', ['fencer' => $fencer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\fencer $fencer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(fencer $fencer)
    {
        $fencer->delete();
        return redirect()->route('fencers.index');
    }
}
