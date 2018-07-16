@extends('template.theme')

@section('title')
    Detail de la partie : {{ $game->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Informations</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <p>Nom de la partie : {{ $game->name }}</p>
                    <p>Description de la partie : {{ $game->description }}</p>
                    <p><h4>Participants :</h4></p>
                    @foreach($game->participants as $participant)
                        {{ $participant->user->firstname.' '.$participant->user->lastname.' (@'.$participant->user->pseudo.')' }}<br>
                    @endforeach

                    <p><a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning"> Paramétres</a></p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Classement</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="tab-pane">
                        <thead>
                        <th>nom</th>
                        <th>score</th>
                        </thead>
                        <tbody>
                        @foreach($rank as $r)
                            <tr>
                                <td>{{ $r['name'] }}</td>
                                <td>{{ $r['score'] }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Prochains Matchs </h3><a href="{{ route('bet',$game->id) }}" class="btn btn-success pull-right"> PARIER !</a>
                </div>
                <div class="box-body">
                    @if(count($nextmatchs) == 0)
                        Pas de matchs
                    @else
                    Journée : {{ $tournament['currentDay'] }}
                    <table class="table table-hover">
                        <tbody>
                        @foreach($nextmatchs->sortBy('date') as $match)
                            <tr>
                                <td><img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive pull-right" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span></td>
                                <td width="20px">{{ (in_array($match->id, array_column($bets,'match_id'))? '('.$bets[array_search($match->id, array_column($bets,'match_id'))]['bet'].')':'-') }}</td>
                                <td><img class="pull-left" src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/></td>
                            </tr>
                        @endforeach
                        </tbody></table>
                    @endif
                </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Derniers Matchs </h3>
                </div>
                <div class="box-body">
                    @if(count($lastmatchs) == 0)
                        Pas de matchs
                    @else
                    Journée : {{ $tournament['currentDay']-1 }}
                    <table class="table table-hover">
                        <tbody>
                        @foreach($lastmatchs as $match)
                            <tr>
                                <td><img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive pull-right" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span></td>
                                <td>{{ $match->home_score }}</td>
                                <td>-</td>
                                <td>{{ $match->visitor_score }}</td>
                                <td><img class="pull-left" src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/></td>
                            </tr>
                        @endforeach
                        </tbody></table>
                    @endif
                </div>
            </div>

        </div>
    </div>
@stop