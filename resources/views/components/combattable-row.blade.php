@if ($combat->hits1 == null AND $combat->hits2 == null)
    <form method="post">
        @endif
        <tr>
            @if ($combat->hits1 == null AND $combat->hits2 == null)
                <td>{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</td>
                <td class="text-center"><input type="number" style="width: 4em"></td>
                <td class="text-center">vs.</td>
                <td class="text-center"><input type="number" style="width: 4em"></td>
                <td class="text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</td>
                <td><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button></td>
            @else
                @if($combat->hits1 > $combat->hits2)
                    <td class="table-success">{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</td>
                    <td class="text-center table-success">{{ $combat->hits1 }}</td>
                @elseif ($combat->hits1 == $combat->hits2 AND ($combat->hits1 != null AND $combat->hits2 != null))
                    <td class="table-primary">{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</td>
                    <td class="text-center table-primary">{{ $combat->hits1 }}</td>
                @else
                    <td>{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</td>
                    <td class="text-center">{{ $combat->hits1 }}</td>
                @endif

                <td class="text-center">vs.</td>

                @if($combat->hits1 < $combat->hits2)
                    <td class="text-center table-success">{{ $combat->hits2 }}</td>
                    <td class="table-success text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</td>
                @elseif ($combat->hits1 == $combat->hits2 AND ($combat->hits1 != null AND $combat->hits2 != null))
                    <td class="text-center table-primary">{{ $combat->hits2 }}</td>
                    <td class="table-primary text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</td>
                @else
                    <td class="text-center">{{ $combat->hits2 }}</td>
                    <td class="text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</td>
                @endif
            @endif
        </tr>
        @if ($combat->hits1 == null AND $combat->hits2 == null)
    </form>
@endif