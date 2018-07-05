@extends('template.theme')

@section('title')
    Matchs du tournois : {{ $tournament->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Matchs</h3>
                </div>
                <form method="post" action="">
                    {{ csrf_field() }}
                    <div class="box-body">
                        @for($i = 1; $i <= $tournament->participants/2; $i++)
                            <div class="com-xs-12">Match #{{ $i }}</div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Équipe domicile :</label>
                                    <select class="form-control select2" name="match[{{$i}}][home]" style="width: 100%;">
                                        @foreach($tournament->teams->sortBy('name') as $team)
                                            <option value="{{ $team->id }}" country="{{ $team->country->code }}" {{ (isset($matches[$i-1]) && $matches[$i-1]['home_team_id'] == $team->id)? 'selected':'' }}>{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Équipe visiteuse :</label>
                                    <select class="form-control select2" name="match[{{$i}}][visitor]" style="width: 100%;">
                                        @foreach($tournament->teams->sortBy('name') as $team)
                                            <option value="{{ $team->id }}" country="{{ $team->country->code }}" {{ (isset($matches[$i-1]) && $matches[$i-1]['visitor_team_id'] == $team->id)? 'selected':'' }}>{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('tournaments.matches', $tournament->id) }}" class="btn btn-warning">Retour</a>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        function formatState (state) {
            if (!state.id) {
                return state.text;
            }
            var $state = $(
                '<span><span class="flag-icon flag-icon-'+state.element.getAttribute('country').toLowerCase()+'"></span> &nbsp;&nbsp;'+state.text+'</span>'
            );
            return $state;
        };

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                templateResult: formatState
            })
            $('.select2Type').select2()
        });
    </script>
@stop