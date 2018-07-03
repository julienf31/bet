@extends('template.theme')

@section('title')
    Detail du tournois : {{ $tournament->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Informations</h3>
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item">Nom :  <span class="badge">{{ $tournament->name }}</span></li>
                        <li class="list-group-item">Pays :  <span class="badge">{{ $tournament->country->name }}</span></li>
                        <li class="list-group-item">Type :  <span class="badge">{{ $tournament->type }}</span></li>
                        <li class="list-group-item">Nombre d'équipes : <span class="badge">{{ $tournament->participants }}</span></li>
                        <li class="list-group-item">Dates :  <span class="badge">{{ $tournament->year }}</span></li>
                    </ul>
                    <a href="{{ route('tournaments.edit', $tournament->id) }}" class="btn btn-warning">Editer</a>
                    <a href="{{ route('tournaments.teams', $tournament->id) }}" class="btn btn-success">Gestion des équipes</a>
                    <a href="{{ route('tournaments.matches', $tournament->id) }}" class="btn btn-success">Gestion des matches</a>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Equipes <span class="badge bg-green"> {{ count($teams) }}</span></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>Nom</th>
                            <th>Ville</th>
                        </tr>
                        @foreach($teams as $team)
                            <tr>
                                <td><img src="{{ asset('img/logos/teams/'.$team->id.'.'.$team->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span> {{ $team->name }} </td>
                                <td>{{ ucfirst($team->city) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Derniers matches</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <h5 class="box-title">Journee : {{ $tournament->currentDay }}</h5>
                </div>
                <div class="box-body table-responsive no-padding">

                    <table class="table table-hover">
                        <tbody>
                        @foreach($lastmatchs as $match)
                            <tr>
                                <td><img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive pull-right" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span></td>
                                <td>{{ $match->home_score }}</td>
                                <td>-</td>
                                <td>{{ $match->visitor_score }}</td>
                                <td><img src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/></td>
                            </tr>
                        @endforeach
                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop