@extends('template.theme')

@section('title')
    Detail de la partie : {{ $game->name }}
@stop

@section('subtitle')
    {{ $game->tournament->name }}
@stop

@section('content')
    @if(((Auth::user()->hasRole('admin') && Auth::user()->inGame($game->id)) || Auth::user()->games->contains($game->id)) && $game->users_request()->count() > 0)
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i>Demandes d'approbation en attente :  {{ $game->users_request()->count() }}</h4>
            <p>Il y a des demandes d'adésions en attente : <a href="{{ route('games.access.request.list', $game->id) }}">cliquez ici pour les approuver</a></p>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Informations</h3>
                </div>
                <div class="box-body">
                    <p>Nom de la partie : {{ $game->name }}</p>
                    <p>Description de la partie : {{ $game->description }}</p>
                    <p><h4>Participants :</h4></p>
                    @foreach($game->participants->sortBy('user.firstname') as $participant)
                        <a href="{{ route('profile',$participant->user->id) }}" class="">{{ $participant->user->firstname.' '.$participant->user->lastname.' (@'.$participant->user->pseudo.')' }}</a><br>
                    @endforeach
                    @if(Auth::user()->hasRole('admin') || Auth::user()->games->contains($game->id))
                        <p><a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning btn-flat"> Paramétres</a></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Classement</h3>
                </div>
                <div class="box-body">
                    <div id="leaderboard">
                        <div class="text-center" style="min-height: 100px; vertical-align: center;">
                            <i class="fa fa-pulse fa-spinner mt-3 fa-3x" style="line-height: 100px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Prochains Matchs </h3><a href="{{ route('bet',$game->id) }}" class="btn btn-success btn-flat pull-right"> Parier </a>
                </div>
                <div class="box-body">
                    @if(!isset($nextmatchs) || count($nextmatchs) == 0)
                        <div class="col-sm-12 text-center">
                            <span class="text-bold">Pas de matchs à venir</span>
                        </div>
                    @else
                    <table class="table table-hover table-responsive">
                        <tbody>
                        @foreach($nextmatchs->sortBy('date') as $match)
                            @php
                                Carbon::setLocale('fr');
                                setlocale(LC_TIME,'fr_FR');
                                    $currDay = $match->days;

                                    if(!isset($day)){
                                        $display_day = true;
                                        $day = $match->days;
                                    } else {
                                        if($day != $currDay){
                                                $display_day = true;
                                            } else {
                                                $display_day = false;
                                            }
                                            $day = $currDay;
                                    }

                            @endphp
                            @if($display_day)
                                <tr>
                                    <td colspan="">Journée : {{ $day }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive " style="display: inline-block; height: 30px;margin-right: 10px;"/>
                                    <span class="{{ ($match->status == 1)? (($bets[array_search($match->id, array_column($bets,'match_id'))]['bet'] == $match->winner)? 'text-success':'text-danger'):'text-warning' }}" style="display: inline-block;"> {{ (in_array($match->id, array_column($bets,'match_id'))? '('.$bets[array_search($match->id, array_column($bets,'match_id'))]['bet'].')':'-') }}</span>
                                    <img class="" src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px; margin-left: 10px;"/>
                                </td>
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
                    <h3 class="box-title">Derniers Matchs </h3><a href="{{ route('games.results',$game) }}" class="btn btn-info btn-flat pull-right"> Voir les résultats </a>
                </div>
                <div class="box-body">
                    @if(count($lastmatchs) == 0)
                        <span class="text-center">Pas de matchs</span>
                    @else
                    Journée : {{ ($tournament->status == 3)? $tournament['currentDay']:$tournament['currentDay']-1 }}
                    <table class="table table-hover">
                        <tbody>
                        @foreach($lastmatchs as $match)
                            <tr class="text-center">
                                <td>
                                    <img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px; margin-right: 10px;"/>
                                    <span style="display: inline-block;"> {{ $match->home_score }} - {{ $match->visitor_score }}</span>
                                    <img class="img-responsive" src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" style="display: inline-block; height: 30px; margin-left: 10px"/>
                                </td>
                            </tr>
                        @endforeach
                        </tbody></table>
                    @endif
                </div>
            </div>

        </div>
    </div>
@stop

@section('scripts')
    @parent

    <script>
        $(document).ready(function () {
            $.ajax({
                method: 'get',
                url: '{{ route('games.getRank', $game->id) }}',
                dataType: "text",
                success: function (data) {
                    $('#leaderboard').html(data);
                    //$('#leaderboard .pseudo').popover('show');
                }
            }).fail(function (data) {
                alert('error')
                console.log(data)
                $('#leaderboard').replaceWith(data);

            });
        })
    </script>
@stop