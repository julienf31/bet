@extends('template.theme')

@section('title')
    Liste des équipes
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Équipes <span class="badge bg-green"> {{ count($teams) }}</span></h3>
                    @if(Auth::user() && Auth::user()->group_id == 1)
                        <div class="pull-right">
                            <a href="{{ route('teams.new') }}" name="create" class="btn btn-success"><i class="fa fa-plus"> </i> Ajouter une équipe</a>
                        </div>
                    @endif
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>Nom</th>
                            <th>Ville</th>
                            <th>Pays</th>
                            @if(Auth::user() &&  Auth::user()->group_id == 1)
                                <th>Gestion</th>
                            @endif
                        </tr>
                        @foreach($teams as $team)
                            <tr>
                                <td><img src="{{ asset('img/logos/teams/'.$team->id.'.'.$team->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/> <span class="flag-icon flag-icon-"></span><a href="{{ route('teams.details', $team->id) }}"> {{ $team->name }} </a></td>
                                <td>{{ $team->city }}</td>
                                <td><span class="flag-icon flag-icon-{{ strtolower($team->country->code) }}"></span> {{ $team->country->name }}</td>
                                @if(Auth::user() && Auth::user()->group_id == 1)
                                    <td>
                                        <a href="{{ route('teams.edit',$team->id) }}"><i class="fa fa-gear text-warning"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop