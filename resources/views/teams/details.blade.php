@extends('template.theme')

@section('title')
    Detail du tournois : {{ $tournament->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
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
                                <td><img src="{{ asset('img/logos/teams/'.$team->id.'.png') }}" class="img-responsive" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span> {{ $team->name }} </td>
                                <td>{{ ucfirst($team->city) }}</td>
                            </tr>
                        @endforeach
                        </tbody></table>
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
                                <td><img src="{{ asset('img/logos/teams/'.$match->home_team_id.'.png') }}" class="img-responsive pull-right" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span></td>
                                <td>{{ $match->home_score }}</td>
                                <td>-</td>
                                <td>{{ $match->visitor_score }}</td>
                                <td><img src="{{ asset('img/logos/teams/'.$match->visitor_team_id.'.png') }}" class="img-responsive" style="display: inline-block; height: 30px;"/></td>
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