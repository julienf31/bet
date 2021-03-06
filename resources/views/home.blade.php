@extends('template.theme')

@section('title')
    Accueil
@stop

@section('content')
    @if(!isset(Auth::user()->favorite_team))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i>Équipe favorite</h4>
            <p>Vous n'avez pas encore définis d'équipe favorite, rendez vous dans votre profil pour en selectionner une.</p>
        </div>
    @endif
    <div class="row mb-5">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Mes parties</h4>
                    <div class="row">
                        @if(count($games) == 0)
                            <div class="col-xs-12 text-center text-bold">
                                <p>Pas de parties en cours</p>
                                <p><a href="{{ route('games.search') }}">Rechercher une partie</a></p>
                            </div>
                        @else
                            @foreach($games as $game)
                                <div class="col-sm-12">
                                    <hr>
                                    <p class="pull-right"><small>{{ $game->participants->count() }} <i class="fa fa-user"></i> </small></p>
                                    <div class="media-body">
                                        <img src="{{ asset('img/logos/tournaments/'.$game->tournament->logo) }}" class="img-responsive pull-left" style="display: inline-block;" width="100px">

                                        <h4 class="media-heading user_name"><small>{!! ($game->privacy)? '<i class="fa fa-lock fa-fw"></i>':'<i class="fa fa-unlock fa-fw"></i>' !!}</small> {{ $game->name }}</h4>
                                        <p>
                                            {{ $game->description }}
                                        </p>
                                        <a href="{{ route('games.show',$game->id) }}" class="btn btn-primary btn-flat">Accéder</a>
                                        <a href="{{ route('bet',$game->id) }}" class="btn btn-success btn-flat">Parier</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pronostics</h4>
                    <div class="row">
                        <div class="col-md-6">
                            Meilleur utilisateur
                            <ul class="list-group list-group-flush">
                                @php
                                    $number = 0;
                                @endphp
                                @foreach($best as $player)
                                    @php
                                        $number++;
                                    @endphp
                                    @if($number == 1)
                                        <li class="list-group-item"><span class="text-green">1<sup>er</sup></span> - &nbsp; {{ $player['pseudo'] }}<span class="pull-right text-navy">score : {{ $player['score'] }}</span></li>
                                    @elseif($number == 2)
                                        <li class="list-group-item"><span class="text-orange">2<sup>éme</sup></span> - &nbsp; {{ $player['pseudo'] }}<span class="pull-right text-navy">score : {{ $player['score'] }} </span></li>
                                    @elseif($number == 3)
                                        <li class="list-group-item"><span class="text-red">3<sup>éme</sup></span> - &nbsp; {{ $player['pseudo'] }}<span class="pull-right text-navy">score : {{ $player['score'] }} </span></li>
                                    @else
                                        <li class="list-group-item"><span class="">{{$number}}<sup>éme</sup></span> - &nbsp; {{ $player['pseudo'] }}<span class="pull-right text-navy">score : {{ $player['score'] }} </span></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <canvas id="betsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script type="text/javascript">
        var ctx = $("#betsChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Réussis", "Échoué","En attente"],
                datasets: [{
                    label: 'Pronostics',
                    data: [
                        {{ $bets_win }},
                        {{ $bets_lost }},
                        {{ $bets_wait }}
                    ],
                    backgroundColor: [
                        'rgba(50, 255, 132,0.2)',
                        'rgba(255, 50, 132, 0.2)',
                        'rgba(250, 162, 100, 0.2)',
                    ],
                    borderWidth:0,
                }]
            },
        });
    </script>
@stop