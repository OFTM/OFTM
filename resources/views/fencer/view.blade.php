@extends('base')
@section('content')
    <br xmlns="http://www.w3.org/1999/html">  <!-- TODO: Make clean -->
    <div class="card fencer-show col-sm-6">
        <div class="card-header w-100">

                <i class="fa fa-user"></i>  {{ $fencer->person->forename }} {{ $fencer->person->surname }}
            <form method="post" action="{{ route('fencers.destroy', ['fencer' => $fencer->id]) }}" class="form-inline pull-right">
                @method('delete')
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm form" role="group">
                    <a class="btn btn-primary" href="{{ route('fencers.edit', ['fencer' => $fencer->id]) }}"><i
                                class="fa fa-edit"></i></a>
                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </div>
            </form>
        </div>
        <div>
            <table class=" table w-100">
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