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
                        <td><input type="text" class="form-control" name="person-forename" value="{{ $fencer->person->forename }}" id="person-forename"></td>
                    </tr>
                    <tr>
                        <td><label for="person-surname">Nachname:</label></td>
                        <td><input type="text" class="form-control" name="person-surname" value="{{ $fencer->person->surname }}" id="person-surname"></td>
                    </tr>
                    <tr>
                        <td><label for="person-birthdate">Geburtsdatum</label></td>
                        <td><input type="text" class="form-control" name="person-birthdate" value="{{ $fencer->person->birthdate->toDateString() }}" id="person-birthdate"></td> <!-- TODO: Datepicker -->
                    </tr>
                    <tr>
                        <td><label for="person-sex">Geschlecht</label></td>
                        <td>
                            <input type="text" class="form-control" name="person-sex" value="{{ $fencer->person->sex->name }}" id="person-sex"> <!-- TODO: Dropdown -->
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