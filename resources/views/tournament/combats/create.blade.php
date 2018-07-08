@extends('base')
@section('content')
    <br xmlns="http://www.w3.org/1999/html">  <!-- TODO: Make clean -->
    <div class="card tournament-show col-sm-6">
        <div class="card-header w-100">

            <i class="fa fa-trophy"></i> {{ $tournament->name }}
            <span class="pull-right btn-group btn-group-sm" role="group">
                <a class="btn btn-outline-secondary"
                   href="{{ route('tournament.show', ['tournament' => $tournament]) }}"><i
                            class="fa fa-times"></i></a>
            </span>
            </form>
        </div>
        <div>
            <table class=" table w-100">
                <tbody>
                <tr>
                    <td>Name</td>
                    <td>{{ $tournament->name }}</td>
                </tr>
                <tr>
                    <td>Regelsatz</td>
                    <td>{{ $tournament->ruleset->name }}</td>
                </tr>
                <tr>
                    <td>Altersklasse</td>
                    <td>{{ $tournament->ageclass->name }}</td>
                </tr>
                <tr>
                    <td>Geschlecht</td>
                    <td>
                        @switch($tournament->sex->name)
                            @case("male")
                            <i class="fa fa-15x fa-male"></i>
                            @break
                            @case("female")
                            <i class="fa fa-15x fa-female"></i>
                            @break
                            @default
                            {{ $tournament->sex->name }}
                            @break
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <td>Waffengattung</td>
                    <td>{{ $tournament->weaponclass->name }}</td>
                </tr>
                @if(($tournament->ruleset->name == "Schweizermodus" or $tournament->ruleset->name == "Dänischermodus") and isset($tournament->round_now))
                    <tr>
                        <td>Aktuelle Runde</td>
                        <td>{{ $tournament->round_now }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card tournament-show col-sm-6">
        <div class="card-header w-100">
            <i class="fa fa-table"></i> Gefecht erstellen
        </div>
        <div>
            <form method="POST" action="{{ route('tournament.combats_store', ['tournament' => $tournament]) }}">
                {{ csrf_field() }}
                @if(($tournament->ruleset->name == "Schweizermodus" or $tournament->ruleset->name == "Dänischermodus") and isset($tournament->round_now))
                    <input type="hidden" name="round-now" value="{{ $tournament->round_now }}">
                @endif
                <table class="table w-100 text-center">
                    <tr>
                        <td>
                            <label for="fencer-a">Fechter A</label>
                        </td>
                        <td>
                            <label for="hits-a">Treffer</label>
                        </td>
                        <td></td>
                        <td>
                            <label for="hits-b">Treffer</label>
                        </td>
                        <td>
                            <label for="fencer-b">Fechter B</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="custom-select" id="fencer-a" name="fencer-a">
                                @foreach($tournament->participants as $participant)
                                    <option value="{{ $participant->id }}">{{ $participant->fencer->person->forename  }} {{ $participant->fencer->person->surname }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" class="form-control" id="hits-a" name="hits-a"></td>
                        <td class="font-weight-bold align-middle">:</td>
                        <td><input type="number" class="form-control" id="hits-b" name="hits-b"></td>
                        <td>
                            <select class="custom-select" id="fencer-b" name="fencer-b">
                                @foreach($tournament->participants as $participant)
                                    <option value="{{ $participant->id }}">{{ $participant->fencer->person->forename  }} {{ $participant->fencer->person->surname }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-primary">Speichern</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection