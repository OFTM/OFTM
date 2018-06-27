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
                @if($tournament->ruleset->name == "Schweizermodus" and isset($tournament->round_now))
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
            @if($tournament->ruleset->name == "Schweizermodus" and isset($tournament->round_now))
                <form action="{{ route('tournament.end_round', ['tournament' => $tournament]) }}" method="post">
                    <i class="fa fa-table"></i> Gefechte
                    <input type="hidden" name="round-now" value="{{ $tournament->round_now }}">
                    {{ csrf_field() }}
                    <div class="pull-right form">
                        <div class="btn-group btn-group-sm form">
                            <button class="btn btn-danger"><i class="fa fa-exclamation-triangle"></i> Runde beenden!
                            </button>
                        </div>
                        <a class="btn btn-primary btn-sm"
                           href="{{ route('tournament.combats_create', ['tournament' => $tournament->id]) }}"><i
                                    class="fa fa-plus"></i></a>

                    </div>
                </form>
            @else
                <i class="fa fa-table"></i> Gefechte
                <div class="pull-right btn-group btn-group-sm form" role="group">
                    <a class="btn btn-primary"
                       href="{{ route('tournament.combats_create', ['tournament' => $tournament->id]) }}"><i
                                class="fa fa-plus"></i></a>
                </div>
            @endif
        </div>
        @if($tournament->ruleset->name == "Schweizermodus" and isset($tournament->round_now))
            @for($i = 1; $i <= $tournament->round_now; $i++)
                <div>
                    <h4 class="text-center">Runde {{ $i }}</h4>
                    <table class="table w-100">
                        <tr>
                            <th>Fechter 1</th>
                            <th class="text-center">Treffer</th>
                            <th class="text-center">vs.</th>
                            <th class="text-center">Treffer</th>
                            <th class="text-right">Fechter 2</th>
                        </tr>
                        @foreach($tournament->combats as $combat)
                            @if($combat->round == $i)
                                <tr>
                                    @if($combat->hits1 > $combat->hits2)
                                        <td class="table-success">{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</td>
                                        <td class="text-center table-success">{{ $combat->hits1 }}</td>
                                    @elseif ($combat->hits1 == $combat->hits2)
                                        <td class="table-primary">{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</td>
                                        <td class="text-center table-primary">{{ $combat->hits1 }}</td>
                                    @else
                                        <td>{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</td>
                                        <td class="text-center">{{ $combat->hits1 }}</td>
                                    @endif

                                    <td class="text-center">vs.</td>

                                    @if($combat->hits1 < $combat->hits2)
                                        <td class="text-center table-success">{{ $combat->hits2 }}</td>
                                        <td class="table-success text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</td>
                                    @elseif ($combat->hits1 == $combat->hits2)
                                        <td class="text-center table-primary">{{ $combat->hits2 }}</td>
                                        <td class="table-primary text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</td>
                                    @else
                                        <td class="text-center">{{ $combat->hits2 }}</td>
                                        <td class="text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            @endfor
        @else
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
        @endif
    </div>
    <div class="card tournament-show col-sm-6">
        <div class="card-header w-100">
            <i class="fa fa-group"></i> Teilnehmer
            <div class="btn-group btn-group-sm form pull-right" role="group">
                <a class="btn btn-primary"
                   href="{{ route('tournament.participants_edit', ['tournament' => $tournament->id]) }}"><i
                            class="fa fa-edit"></i></a>
            </div>
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