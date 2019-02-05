@extends('template.theme')

@section('title')
    {{ $game->name }}
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
        <!-- Informations -->
        <div class="col-sm-12 col-md-6">
            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="card-title">Informations</h4>
                    <p>Nom de la partie : {{ $game->name }}</p>
                    <p>Description de la partie : {{ $game->description }}</p>
                    <p><h4>Participants :</h4></p>
                    @foreach($game->participants->sortBy('user.firstname') as $participant)
                        <a href="{{ route('profile',$participant->user->id) }}" class="">{{ $participant->user->firstname.' '.$participant->user->lastname.' (@'.$participant->user->pseudo.')' }}</a><br>
                    @endforeach
                    <div class="row">
                        <div class="col">
                            @if(Auth::user()->hasRole('admin') || Auth::user()->games->contains($game->id))
                                <p><a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning btn-md"> Paramétres</a></p>
                            @endif
                            <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#exitModal">Quitter la partie</button>
                        </div>
                        <div class="modal fade" id="exitModal" tabindex="-1" role="dialog" aria-labelledby="exitModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Confirmation requise</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger">
                                            <h4>Attention</h4>
                                            <p>Êtes vous sur de vouloir quitter cette partie ? cette action est irrévocable et vous pedrez votre progression au sein de la partie</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('games.exit', $game->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-danger btn-flat">Confirmer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Leaderboard -->
        <div class="col-sm-12 col-md-6">
            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="card-title">Classement</h4>
                    <div id="leaderboard">
                        <div class="text-center" style="min-height: 100px; vertical-align: center;">
                            <i class="fa fa-pulse fa-spinner mt-3 fa-3x" style="line-height: 100px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Next matches -->
        <div class="col-sm-12 col-md-6">
            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="card-title">Prochains Matchs</h4>
                    <a href="{{ route('bet',$game->id) }}" class="btn btn-success btn-flat pull-right"> Parier </a>
                    @if(!isset($nextmatchs) || count($nextmatchs) == 0)
                        <div class="col-sm-12 text-center">
                            <span class="text-bold">Pas de matchs à venir</span>
                        </div>
                    @else
                        <table class="table">
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
                                        <span class="{{ ($match->status == 1 && in_array($match->id, array_column($bets,'match_id')))? (($bets[array_search($match->id, array_column($bets,'match_id'))]['bet'] == $match->winner)? 'text-success':'text-danger'):'text-warning' }}" style="display: inline-block;"> {{ (in_array($match->id, array_column($bets,'match_id'))? '('.$bets[array_search($match->id, array_column($bets,'match_id'))]['bet'].')':'-') }}</span>
                                        <img class="" src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px; margin-left: 10px;"/>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody></table>
                    @endif
                </div>
            </div>
        </div>
        <!-- Previous matches -->
        <div class="col-sm-12 col-md-6">
            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="card-title">Derniers Matchs</h4>
                    <a href="{{ route('games.results',$game) }}" class="btn btn-info btn-flat pull-right"> Voir les résultats </a>
                    @if(count($lastmatchs) == 0)
                        <span class="text-center">Pas de matchs</span>
                    @else
                        Journée : {{ ($tournament->status == 3)? $tournament['currentDay']:$tournament['currentDay']-1 }}
                        <table class="table">
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
                console.log(data)
                $('#leaderboard').replaceWith(data);

            });
        })
    </script>
@stop