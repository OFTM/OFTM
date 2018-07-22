@extends('base')
@section('content')
    <br xmlns="http://www.w3.org/1999/html">  <!-- TODO: Make clean -->
    <div class="card tournament-show col-sm-6">
        <div class="card-header w-100">
            <i class="fa fa-trophy"></i> {{ $tournament->name }}
            <span class="pull-right btn-group btn-group-sm" role="group">
                <a class="btn btn-outline-secondary"
                   href="{{ route('tournament.show', ['tournament' => $tournament->id]) }}"><i
                            class="fa fa-times"></i></a>
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
                    <td>Altersklassen</td>
                    <td>
                        <ul>
                            @foreach($tournament->ageclasses as $ageclass)
                                <li>{{ $ageclass->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Geschlechter</td>
                    <td>
                        <ul>
                            @foreach($tournament->sexes as $sex)
                                <li>
                                    @switch($sex->name)
                                        @case("male")
                                        <i class="fa fa-15x fa-male"></i>
                                        @break
                                        @case("female")
                                        <i class="fa fa-15x fa-female"></i>
                                        @break
                                        @default
                                        {{ $sex->name }}
                                        @break
                                    @endswitch
                                </li>
                            @endforeach
                        </ul>
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
            <i class="fa fa-group"></i> Teilnehmer
        </div>
        <div>
            <form method="POST" action="{{ route('tournament.participants_store', ['tournament' => $tournament]) }}">
                {{ csrf_field() }}
                @method('PUT')
                <table class="table w-100">
                    <tr>
                        <th>Name</th>
                        <th>Bezahlt</th>
                        <th>Gemeldet</th>
                    </tr>
                    @foreach($canidates as $canidate)
                        <tr>
                            <td>{{ $canidate->person->forename }} {{ $canidate->person->surname }}</td>
                            @if(count($tournament->participants->where('fencer_id', $canidate->id)) > 0)
                                @if($tournament->participants->where('fencer_id', $canidate->id)->first()->paid)
                                    <td>
                                        <input type="checkbox" class="custom-control custom-checkbox" id="paid"
                                               name="paid[]"
                                               value="{{ $canidate->id }}" disabled checked>
                                    </td>
                                @else
                                    <td>
                                        <input type="checkbox" class="custom-control custom-checkbox" id="paid"
                                               name="paid[]"
                                               value="{{ $canidate->id }}" disabled>
                                    </td>
                                @endif
                                <td>
                                    <input type="checkbox" class="custom-control custom-checkbox" id="reg" name="reg[]"
                                           value="{{ $canidate->id }}" checked>
                                </td>
                            @else
                                <td>
                                    <input type="checkbox" class="custom-control custom-checkbox" id="paid"
                                           name="paid[]"
                                           value="{{ $canidate->id }}" disabled>
                                </td>
                                <td>
                                    <input type="checkbox" class="custom-control custom-checkbox" id="reg" name="reg[]"
                                           value="{{ $canidate->id }}">
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">
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