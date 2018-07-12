<?php

namespace App\Http\Controllers;

use App\combat;
use App\referee;
use App\tournament;
use App\participant;
use App\sex;
use App\weaponclass;
use App\ruleset;
use App\ageclass;
use App\fencer;
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
        return view('tournament.create', ['sexes' => sex::all(), 'weaponclasses' => weaponclass::all(), 'rulesets' => ruleset::all(), 'ageclasses' => ageclass::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'ruleset' => 'required',
            'sex' => 'required',
            'weaponclass' => 'required',
            'ageclass' => 'required',
        ]);
        $t = new tournament();
        $t->name = $validated['name'];
        if ($validated['ruleset'] == "Schweizermodus" OR $validated['ruleset'] == "Dänischermodus") {
            $t->round_now = 0;
        }
        $t->ruleset()->associate(ruleset::all()->where('name', $validated['ruleset'])->first());
        $t->sex()->associate(sex::all()->where('name', $validated['sex'])->first());
        $t->weaponclass()->associate(weaponclass::all()->where('name', $validated['weaponclass'])->first());
        $t->ageclass()->associate(ageclass::all()->where('name', $validated['ageclass'])->first());
        $t->save();
        return redirect()->route('tournament.show', ['tournament' => $t]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(tournament $tournament)
    {
        return view('tournament.view', ['tournament' => $tournament]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(tournament $tournament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tournament $tournament)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(tournament $tournament)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function participants_edit(tournament $tournament)
    {
        $canidates = [];
        $fencers = fencer::whereHas('weapons', function ($querry) use ($tournament) {
            $querry->where('weaponclass_id', $tournament->weaponclass_id);
        })->whereHas('person.sex', function ($querry) use ($tournament) {
            $querry->where('id', $tournament->sex_id);
        })->get();

        foreach ($fencers as $fencer) {
            if ($fencer->person->birthdate->age >= $tournament->ageclass->min && $fencer->person->birthdate->age <= $tournament->ageclass->max) {
                array_push($canidates, $fencer);
            }
        }

        return view('tournament.participants.edit', ['tournament' => $tournament, 'canidates' => $canidates]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function participants_store(Request $request, tournament $tournament)
    {
        if ($request->has('reg')) {
            foreach ($request->input('reg') as $row) {
                $participant = participant::firstOrCreate(['fencer_id' => $row, 'tournament_id' => $tournament->id]);
                $participant->save();
            }
            foreach ($tournament->participants as $participant) {
                if (!in_array($participant->fencer_id, $request->input('reg'))) {
                    $tournament->participants()->where('id', $participant->id)->first()->delete();
                }
            }
        }
        return redirect()->route('tournament.show', ['tournament' => $tournament]);
    }

    public function combats_create(tournament $tournament)
    {
        return view('tournament.combats.create', ['tournament' => $tournament]);
    }

    public function combats_store(Request $request, tournament $tournament)
    {
        $validated = $request->validate([
            'fencer-a' => 'required|integer',
            'fencer-b' => 'required|integer',
            'hits-a' => 'required|integer',
            'hits-b' => 'required|integer',
            'round-now' => 'integer'
        ]);

        $combat = new combat();
        $combat->participant1()->associate(participant::all()->where('id', $validated['fencer-a'])->first()->id);
        $combat->participant2()->associate(participant::all()->where('id', $validated['fencer-b'])->first()->id);
        $combat->tournament()->associate($tournament->id);
        $combat->referee()->associate(referee::all()->first()->id);
        $combat->hits1 = $validated['hits-a'];
        $combat->hits2 = $validated['hits-b'];
        $combat->round = $validated['round-now'];
        $combat->save();

        return redirect()->route('tournament.show', ['tournament' => $tournament]);
    }

    public function end_round(Request $request, tournament $tournament)
    {
        if ($tournament->ruleset->name == "Schweizermodus") {
            $validated = $request->validate([
                'round-now' => 'required|integer'
            ]);
            $tournament->round_now = $validated['round-now'] + 1;
            $tournament->save();
            if ($tournament->round_now == 1) {
                $rparticipants = $tournament->participants()->inRandomOrder()->get();
                $half = ceil($rparticipants->count() / 2);
                $participants = $rparticipants->chunk($half);
                for ($i = 0; $i < count($participants[0]); $i++) {
                    $c = new combat();
                    $c->participant1()->associate($participants[0][$i]->id);
                    $c->participant2()->associate($participants[1][$half + $i]->id);
                    $c->referee()->associate(referee::all()->first()->id);
                    $c->tournament()->associate($tournament->id);
                    $c->round = $tournament->round_now;
                    $c->save();
                }
            } else {
                $rank = GenerateRanking($tournament);

                usort($rank, "SortRanking");
                for ($i = 0; $i < count($rank); $i++) {
                    if (!$rank[$i]['assigned']) {
                        for ($j = 0; $j < count($rank); $j++) {
                            if (!$rank[$j]['assigned'] && $i != $j) {
                                if (count($tournament->combats()->where(function ($query) use ($i, $j, $rank) {
                                        $query->where('participant1_id', $rank[$i]['id'])->where('participant2_id', $rank[$j]['id']);
                                    })->orWhere(function ($query) use ($i, $j, $rank) {
                                        $query->Where('participant1_id', $rank[$j]['id'])->where('participant2_id', $rank[$i]['id']);
                                    })->get()) == 0) {
                                    $c = new combat();
                                    $c->tournament()->associate($tournament->id);
                                    $c->referee(referee::all()->first()->id);
                                    $c->participant1()->associate($rank[$i]['id']);
                                    $c->participant2()->associate($rank[$j]['id']);
                                    $c->round = $tournament->round_now;
                                    $c->save();
                                    $rank[$j]['assigned'] = True;
                                    $rank[$i]['assigned'] = True;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        } elseif ($tournament->ruleset->name == "Dänischermodus") {
        $validated = $request->validate([
            'round-now' => 'required|integer'
        ]);
        $tournament->round_now = $validated['round-now'] + 1;
        $tournament->save();
        if ($tournament->round_now == 1) {
            $rparticipants = $tournament->participants()->inRandomOrder()->get();
            $half = ceil($rparticipants->count() / 2);
            $participants = $rparticipants->chunk($half);
            for ($i = 0; $i < count($participants[0]); $i++) {
                $c = new combat();
                $c->participant1()->associate($participants[0][$i]->id);
                $c->participant2()->associate($participants[1][$half + $i]->id);
                $c->referee()->associate(referee::all()->first()->id);
                $c->tournament()->associate($tournament->id);
                $c->round = $tournament->round_now;
                $c->save();
            }
        } else {
            $rank = GenerateRanking($tournament);

            for ($i = 0; $i < count($rank); $i++) {
                if (!$rank[$i]['assigned']) {
                    for ($j = 0; $j < count($rank); $j++) {
                        if (!$rank[$j]['assigned'] && $i != $j) {
                            if (count($tournament->combats()->where(function ($query) use ($i, $j, $rank) {
                                    $query->where('participant1_id', $rank[$i]['id'])->where('participant2_id', $rank[$j]['id']);
                                })->orWhere(function ($query) use ($i, $j, $rank) {
                                    $query->Where('participant1_id', $rank[$j]['id'])->where('participant2_id', $rank[$i]['id']);
                                })->where('id', $tournament->round_now - 1)->get()) == 0) {
                                $c = new combat();
                                $c->tournament()->associate($tournament->id);
                                $c->referee(referee::all()->first()->id);
                                $c->participant1()->associate($rank[$i]['id']);
                                $c->participant2()->associate($rank[$j]['id']);
                                $c->round = $tournament->round_now;
                                $c->save();
                                $rank[$j]['assigned'] = True;
                                $rank[$i]['assigned'] = True;
                                break;
                            }
                        }
                    }
                }
            }
        }
    }
        return redirect()->route('tournament.show', ['tournament' => $tournament]);
    }

    public function combats_update(Request $request, tournament $tournament, combat $combat) {
        $validated = $request->validate([
            'hits1' => 'required|numeric',
            'hits2' => 'required|numeric'
        ]);

        $combat->hits1 = $validated['hits1'];
        $combat->hits2 = $validated['hits2'];
        $combat->save();

        return redirect()->route('tournament.show', ['tournament' => $tournament]);
    }

    public function beamer(tournament $tournament) {

        $rank = GenerateRanking($tournament);

        return view('tournament.beamer', ['tournament' => $tournament, 'ranking' => $rank]);
    }
}
