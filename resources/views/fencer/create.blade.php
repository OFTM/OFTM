@extends('base')
@section('content')
    <br>  <!-- TODO: Make clean -->
    <div class="card fencer-show col-sm-6">
        <div class="card-header w-100">
            <i class="fa fa-user"></i>
            <span class="pull-right btn-group btn-group-sm" role="group">
                <a class="btn btn-outline-secondary" href="{{ route('fencers.index') }}"><i
                            class="fa fa-times"></i></a>
            </span>
        </div>
        <div>
            <form method="POST" action="{{ route('fencers.store') }}">
                {{ csrf_field() }}
                <table class="table w-100">
                    <tbody>
                    <tr>
                        <td><label for="person-forename">Vorname:</label></td>
                        <td><input type="text" class="form-control" name="person-forename" id="person-forename"></td>
                    </tr>
                    <tr>
                        <td><label for="person-surname">Nachname:</label></td>
                        <td><input type="text" class="form-control" name="person-surname" id="person-surname"></td>
                    </tr>
                    <tr>
                        <td><label for="person-birthdate">Geburtsdatum</label></td>
                        <td>
                            <datepicker name="person-birthdate" id="person-birthdate" :bootstrap-styling="true"
                                        :language="languages.de" :format="dateformat" :typeable="true" :placeholder="'2018-12-31'"></datepicker>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="person-sex">Geschlecht</label></td>
                        <td>
                            <select class="custom-select" id="person-sex" name="person-sex">
                                @foreach($sexes as $sex)
                                    <option>{{ $sex->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>IDs</td>
                        <td>
                            @foreach($id_types as $id)
                                <label for="{{ $id->name }}" class="sr-only">{{ $id->name }}</label>
                                <input type="text" class="form-control" name="{{ $id->name }}" id="{{ $id->name }}" placeholder="{{ $id->name }}">
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td><label for="weapons">Waffen</label></td>
                        <td>
                            @foreach($weaponclasses as $weaponclass)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="w{{ $weaponclass->id }}" name="weaponclasses[]" value="{{ $weaponclass->id }}">
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
<script>
    import Datepicker from "vuejs-datepicker/src/components/Datepicker";

    export default {
        components: {Datepicker}
    }
</script>