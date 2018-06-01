@extends('base')
@section('content')
    <br xmlns="http://www.w3.org/1999/html">  <!-- TODO: Make clean -->
    <div class="card tournament-show col-sm-6">
        <div class="card-header w-100">

            <i class="fa fa-trophy"></i> {{ $tournament->name }}
            <form method="post" action="{{ route('tournament.destroy', ['tournament' => $tournament->id]) }}"
                  class="form-inline pull-right">
                @method('delete')
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm form" role="group">
                    <a class="btn btn-primary" href="{{ route('tournament.edit', ['tournament' => $tournament->id]) }}"><i
                                class="fa fa-edit"></i></a>
                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </div>
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
                </tbody>
            </table>
        </div>
    </div>
    <div class="card tournament-show col-sm-6">
        <div class="card-header w-100">
            <i class="fa fa-table"></i> Gefechte
        </div>
        <div>
            <table class="table w-100">
                <tr>
                    <th>Fechter 1</th>
                    <th class="text-center">Treffer</th>
                    <th class="text-center">vs.</th>
                    <th class="text-center">Treffer</th>
                    <th class="text-right">Fechter 2</th>
                </tr>
                @foreach($tournament->combats as $combat)
                    <tr>
                        <td>{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</td>
                        <td class="text-center">{{ $combat->hits1 }}</td>
                        <td class="text-center">vs.</td>
                        <td class="text-center">{{ $combat->hits2 }}</td>
                        <td class="text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="card tournament-show col-sm-6">
        <div class="card-header w-100">
            <i class="fa fa-group"></i> Teilnehmer
        </div>
        <div>
            <table class="table w-100">
               <tr>
                   <th>Name</th>
               </tr>
                @foreach($tournament->participants as $participant)
                    <tr>
                        <td>{{ $participant->fencer->person->forename }} {{ $participant->fencer->person->surname }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection