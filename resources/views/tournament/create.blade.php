@extends('base')
@section('content')
    <br xmlns="http://www.w3.org/1999/html">  <!-- TODO: Make clean -->
    <div class="card tournament-show col-sm-6">
        <div class="card-header w-100">

            <i class="fa fa-trophy"></i>
        </div>
        <div>
            <form method="POST" action="{{ route('tournament.store') }}">
                {{ csrf_field() }}
                <table class=" table w-100">
                    <tbody>
                    <tr>
                        <td><label for="name">Name:</label></td>
                        <td><input type="text" class="form-control" name="name" id="name"></td>
                    </tr>
                    <tr>
                        <td><label for="ruleset">Regelsatz</label></td>
                        <td>
                            <select class="custom-select" id="ruleset" name="ruleset">
                                @foreach($rulesets as $ruleset)
                                    <option>{{ $ruleset->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="sex">Geschlecht</label></td>
                        <td>
                            <select class="custom-select" id="sex" name="sex">
                                @foreach($sexes as $sex)
                                    <option>{{ $sex->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="ageclass">Altersklasse</label></td>
                        <td>
                            <select class="custom-select" id="ageclass" name="ageclass">
                                @foreach($ageclasses as $ageclass)
                                    <option>{{ $ageclass->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="weaponclass">Waffengattung</label></td>
                        <td>
                            <select class="custom-select" id="weaponclass" name="weaponclass">
                                @foreach($weaponclasses as $weaponclass)
                                    <option>{{ $weaponclass->name }}</option>
                                @endforeach
                            </select>
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