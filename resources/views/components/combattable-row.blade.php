<span class="row border-top">
    @if ($combat->hits1 == null AND $combat->hits2 == null)
        <form method="post" class="form-inline w-100"
              action="{{ route('tournament.combats_update', ['tournament' => $combat->tournament_id, 'combat' => $combat->id]) }}">
            @method('PUT')
            {{ csrf_field() }}
            <input type="hidden" name="participant1-id" value="{{ $combat->participant1->id }}"/>
            <input type="hidden" name="participant2-id" value="{{ $combat->participant2->id }}"/>
            <span class="col-4">{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</span>
            <span class="col-1 text-center"><input class="form-control form-control-sm" style="width: 4em;"  pattern="\d{1,4}" maxlength="4" required></span>
            <span class="col-1 text-center">vs.</span>
            <span class="col-1 text-center"><input class="form-control form-control-sm" style="width: 4em;" pattern="\d{1,4}" maxlength="4" required></span>
            <span class="col-4 text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</span>
            <span class="col-1">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
            </span>
        </form>
    @else
        @if($combat->hits1 > $combat->hits2)
            <span class="col-4 table-success">{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</span>
            <span class="col-1 text-center table-success">{{ $combat->hits1 }}</span>
        @elseif ($combat->hits1 == $combat->hits2 AND ($combat->hits1 != null AND $combat->hits2 != null))
            <span class="col-4 table-primary">{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</span>
            <span class="col-1 text-center table-primary">{{ $combat->hits1 }}</span>
        @else
            <span class="col-4">{{ $combat->participant1->fencer->person->forename }} {{ $combat->participant1->fencer->person->surname }}</span>
            <span class="col-1 text-center">{{ $combat->hits1 }}</span>
        @endif

        <span class="col-1 text-center">vs.</span>

        @if($combat->hits1 < $combat->hits2)
            <span class="col-1 text-center table-success">{{ $combat->hits2 }}</span>
            <span class="col-4 table-success text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</span>
        @elseif ($combat->hits1 == $combat->hits2 AND ($combat->hits1 != null AND $combat->hits2 != null))
            <span class="col-1 text-center table-primary">{{ $combat->hits2 }}</span>
            <span class="col-4 table-primary text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</span>
        @else
            <span class="col-1 text-center">{{ $combat->hits2 }}</span>
            <span class="col-4 text-right">{{ $combat->participant2->fencer->person->forename }} {{ $combat->participant2->fencer->person->surname }}</span>
        @endif
        <span class="col-1"></span>
    @endif
        </span>
