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
                        <td><datepicker name="person-birthdate" id="person-birthdate" :bootstrap-styling="true" :language="languages.de"></datepicker></td>
                    </tr>
                    <tr>
                        <td><label for="person-sex">Geschlecht</label></td>
                        <td>
                            <input type="text" class="form-control" name="person-sex" id="person-sex">
                            <!-- TODO: Dropdown -->
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