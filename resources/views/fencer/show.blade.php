@extends('base')
@section('content')
    <br>  <!-- TODO: Make clean -->
    <div class="card fencer-show col-sm-6">
        <div class="card-header w-100">
            <i class="fa fa-user"></i> {{ $fencer->person->forename }} {{ $fencer->person->surname }}
        </div>
        <div>
            <table class="table w-100">
                <tbody>
                <tr>
                    <td>Vorname:</td>
                    <td>{{ $fencer->person->forename }}</td>
                </tr>
                <tr>
                    <td>Nachname:</td>
                    <td>{{ $fencer->person->surname }}</td>
                </tr>
                <tr>
                    <td>Geburtsdatum</td>
                    <td>{{ $fencer->person->birthdate }}</td>
                </tr>
                <tr>
                    <td>Geschlecht</td>
                    <td>
                        {{ $fencer->person->sex->name }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection