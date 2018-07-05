@extends('template.theme')

@section('title')
    Équipes du tournois : {{ $tournament->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Équipes</h3>
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addTeam" {{ (count($tournament->teams) < $tournament->participants)? '':'disabled' }} >Ajouter une équipe au tournois</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>Nom</th>
                            <th>Ville</th>
                            <th>Action</th>
                        </tr>
                        @foreach($tournament->teams->sortBy('name') as $team)
                            <tr>
                                <td><img src="{{ asset('img/logos/teams/'.$team->id.'.'.$team->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span> {{ $team->name }} </td>
                                <td>{{ ucfirst($team->city) }}</td>
                                <td>
                                    <a href="{{ route('teams.edit', $team->id) }}"><i class="fa fa-gears"></i></a>
                                    <a href="{{ route('teams.tournament.remove', [$tournament->id, $team->id]) }}"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <a href="{{ route('tournaments.details', $tournament->id) }} " class="btn btn-warning"> Retour</a>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="modal fade" id="addTeam" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Ajouter une équipe</h4>
                </div>
                <form method="post" action="{{ route('teams.tournament.add', [$tournament->id]) }}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Équipe:</label>
                                <select class="form-control select2" name="team" style="width: 100%;">
                                    @foreach($teams->sortBy('name') as $team)
                                        <option value="{{ $team->id }}" country="{{ $team->country->code }}" {{ (in_array($team->id,$tournament_teams))? 'disabled':'' }}>{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i> Ajouter</button>
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