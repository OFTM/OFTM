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
                        <td>Geschlechter</td>
                        <td>
                            @foreach($sexes as $sex)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="s{{ $sex->id }}"
                                           name="sexes[]" value="{{ $sex->id }}">
                                    <label class="custom-control-label"
                                           for="s{{ $sex->id }}">{{ $sex->name }}</label>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Altersklassen</td>
                        <td>
                            @foreach($ageclasses as $ageclass)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="a{{ $ageclass->id }}"
                                           name="ageclasses[]" value="{{ $ageclass->id }}">
                                    <label class="custom-control-label"
                                           for="a{{ $ageclass->id }}">{{ $ageclass->name }}</label>
                                </div>
                            @endforeach
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