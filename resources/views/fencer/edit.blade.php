@extends('base')
@section('content')
    <br>  <!-- TODO: Make clean -->
    <div class="card fencer-show col-sm-6">
        <div class="card-header w-100">
            <i class="fa fa-user"></i> {{ $fencer->person->forename }} {{ $fencer->person->surname }}
            <span class="pull-right btn-group btn-group-sm" role="group">
                <a class="btn btn-outline-secondary" href="{{ route('fencers.show', ['fencer' => $fencer->id]) }}"><i
                            class="fa fa-times"></i></a>
            </span>
        </div>
        <div>
            <form method="POST" action="{{ route('fencers.update', ['fencer' => $fencer->id]) }}">
                @method('PUT')
                {{ csrf_field() }}
                <table class="table w-100">
                    <tbody>
                    <tr>
                        <td><label for="person-forename">Vorname:</label></td>
                        <td><input type="text" class="form-control" name="person-forename"
                                   value="{{ $fencer->person->forename }}" id="person-forename"></td>
                    </tr>
                    <tr>
                        <td><label for="person-surname">Nachname:</label></td>
                        <td><input type="text" class="form-control" name="person-surname"
                                   value="{{ $fencer->person->surname }}" id="person-surname"></td>
                    </tr>
                    <tr>
                        <td><label for="person-birthdate">Geburtsdatum</label></td>
                        <td>
                            <datepicker name="person-birthdate" id="person-birthdate" :bootstrap-styling="true"
                                        :language="languages.de"
                                        :value="{{ $fencer->person->birthdate->toDateString() }}"></datepicker>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="person-sex">Geschlecht</label></td>
                        <td>
                            <select class="custom-select" id="person-sex" name="person-sex">
                                @foreach($sexes as $sex)
                                    @if($sex->id === $fencer->person->sex->id)
                                        <option selected>{{ $sex->name }}</option>
                                    @else
                                        <option>{{ $sex->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="weapons">Waffen</label></td>
                        <td>
                            @foreach($weaponclasses as $weaponclass)
                                <div class="custom-control custom-checkbox">
                                    @if(count($fencer->weapons) > 0)
                                        @if(count($fencer->weapons()->whereHas('weaponclass', function ($querry) use ($weaponclass) {$querry->where('id', $weaponclass->id);})->get()) > 0)
                                            <input type="checkbox" class="custom-control-input"
                                                   id="w{{ $weaponclass->id }}" name="weaponclasses[]"
                                                   value="{{ $weaponclass->id }}" checked>
                                        @else
                                            <input type="checkbox" class="custom-control-input"
                                                   id="w{{ $weaponclass->id }}" name="weaponclasses[]"
                                                   value="{{ $weaponclass->id }}">
                                        @endif
                                    @else
                                        <input type="checkbox" class="custom-control-input" id="w{{ $weaponclass->id }}"
                                               name="weaponclasses[]" value="{{ $weaponclass->id }}">
                                    @endif
                                    <label class="custom-control-label"
                                           for="w{{ $weaponclass->id }}">{{ $weaponclass->name }}</label>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-primary">Speichern</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection