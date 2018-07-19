<?php

namespace App\Http\Controllers;

use App\ageclass;
use App\fencer;
use App\id;
use App\id_type;
use App\people;
use App\sex;
use App\weaponclass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\weapon;

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
        return view('fencer.create', ['sexes' => sex::all(), 'weaponclasses' => weaponclass::all(), 'id_types' => id_type::all()]);
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
        foreach($request->input('weaponclasses') as $weaponclass) {
            $weapon = new weapon;
            $class = weaponclass::all()->where('id', 'IS', $weaponclass)->first();
            $weapon->weaponclass()->associate($class);
            $weapon->fencer()->associate($fencer);
            $weapon->save();
            #$fencer->weapons()->save($weapon);
        }
        foreach (id_type::all() as $id_type) {
            if($request->has($id_type->name)){
                $id = new id();
                $id->fencer()->associate($fencer);
                $id->type()->associate($id_type);
                $id->value = $request->input($id_type->name);
                $id->save();
            }
        }
        $fencer->save();

        if($request->input('save') == 'next') {
            return redirect()->route('fencers.create');
        } else {
            return redirect()->route('fencers.show', ['fencer' => $fencer]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\fencer  $fencer
     * @return \Illuminate\Http\Response
     */
    public function show(fencer $fencer)
    {
        return view('fencer.view', ['fencer' => $fencer, 'ageclasses' => ageclass::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\fencer  $fencer
     * @return \Illuminate\Http\Response
     */
    public function edit(fencer $fencer)
    {
        return view('fencer.edit', ['fencer' => $fencer, 'sexes' => sex::all(), 'weaponclasses' => weaponclass::all(), 'id_types' => id_type::all()]);
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
        if ($fencer->person->sex->name != $validated['person-sex']) {
            $fencer->person->sex()->dissociate();
            $fencer->person->sex()->associate(sex::all()->where('name', 'IS', $validated['person-sex'])->first());
        }
        $fencer->save();
        $fencer->person->save();
        foreach (weaponclass::all() as $weaponclass) {
            if (count($fencer->weapons()->whereHas('weaponclass', function ($querry) use ($weaponclass) {
                $querry->where('id', $weaponclass->id);
            })->get())) {
                if (!$request->has('weaponclasses') || ($request->has('weaponclasses') && !in_array($weaponclass->id, $request->input('weaponclasses')))) {
                    $fencer->weapons()->whereHas('weaponclass', function ($querry) use ($weaponclass) {
                        $querry->where('id', $weaponclass->id);
                    })->delete();
                }
            } else {
                if ($request->has('weaponclasses') && in_array($weaponclass->id, $request->input('weaponclasses'))) {
                    $weapon = new weapon();
                    $weapon->fencer()->associate($fencer);
                    $weapon->weaponclass()->associate($weaponclass);
                    $weapon->save();
                }
            }
        }
        foreach (id_type::all() as $id_type) {
            if($request->has($id_type->name)){
                if(count($fencer->ids()->whereHas('type', function($query) use ($id_type) {$query->where('name', $id_type->name);})->get()) > 0) {
                    $id = id::all()->where('fencer_id', $fencer->id)->where('type_id', $id_type->id)->first();
                    $id->value = $request->input($id_type->name);
                    $id->save();
                } else {
                    $id = new id();
                    $id->fencer()->associate($fencer);
                    $id->type()->associate($id_type);
                    $id->value = $request->input($id_type->name);
                    $id->save();
                }
            }
        }
        $fencer->save();
        return redirect()->route('fencers.show', ['fencer' => $fencer]);
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
