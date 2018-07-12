<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        function timedRefresh(timeoutPeriod) {
            setTimeout("location.reload(true);",timeoutPeriod);
        }

        window.onload = timedRefresh(10000);
    </script>
</head>
<body>
<div id="app">
    <div class="row m-0 mt-3">
        <div class="col-6">
            <h1 class="text-center">Runde {{ $tournament->round_now }}</h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>Fechter</td>
                    <td class="text-center">Punkte</td>
                    <td></td>
                    <td class="text-center">Punkte</td>
                    <td class="text-right">Fechter</td>
                </tr>
                </thead>
                <tbody>
                @foreach($tournament->combats as $combat)
                    @if($combat->round == $tournament->round_now)
                        <tr>
                            <td>{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</td>
                            <td class="text-center">{{ $combat->hits1 }}</td>
                            <td class="text-center">
                                @if($combat->hits1 > $combat->hits2)
                                    <i class="fa fa-arrow-left"></i>
                                @elseif($combat->hits1 < $combat->hits2)
                                    <i class="fa fa-arrow-right"></i>
                                @elseif($combat->hits1 == $combat->hits2 and $combat->hits1 != null and $combat->hits2 != null)
                                    <i class="fa fa-arrow-left"></i><i class="fa fa-arrow-right"></i>
                                @else
                                    <i class="fa fa-asterisk"></i>
                                @endif
                            </td>
                            <td class="text-center">{{ $combat->hits2 }}</td>
                            <td class="text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <h1 class="text-center">Rangliste</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="w-10 text-center">Platz</td>
                        <td class="text-center">Fechter</td>
                        <td class="w-10 text-center">Siege</td>
                        <td class="w-10 text-center">Index</td>
                        <td class="w-10 text-center">Geg. Treffer</td>
                        <td class="w-10 text-center">Erh. Treffer</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ranking as $index =>$rank)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $rank['participant']->fencer->person->forename }} {{ $rank['participant']->fencer->person->surname }}</td>
                            <td class="text-center">{{ $rank['wins'] }}</td>
                            <td class="text-center">{{ $rank['index'] }}</td>
                            <td class="text-center">{{ $rank['given_hits'] }}</td>
                            <td class="text-center">{{ $rank['recv_hits'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="/js/app.js"></script>
</body>
</html>