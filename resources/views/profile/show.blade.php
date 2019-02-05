@extends('template.theme')

@section('title')
    Profil de : {{ $user->pseudo }}
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="card-title">Profil</h4>
                    <div class="col">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <b>Nom</b> <a class="pull-right"> {{ $user->getFullName() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Équipe favorite</b> <a class="pull-right"> {!! (isset($user->favoriteTeam))?$user->favoriteTeam->name.' '.$user->favoriteTeam->img():"Pas d'équipe favorite" !!}</a>
                            </li>
                            <li class="list-group-item">
                                @php
                                    Carbon::setLocale('fr');
                                @endphp
                                <b>Inscription</b> <a class="pull-right"> il y a {{ $user->created_at->diffForHumans(now(),true) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Pseudo</b> <a class="pull-right"> {{ $user->pseudo }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Derniére connexion</b> <a class="pull-right"> {{ ($user->last_login == null)? 'Aucune connexion':'il y a '.$user->last_login->diffForHumans(now(),true) }}</a>
                            </li>
                            @if(Auth::user()->hasRole('admin'))
                                <li class="list-group-item">
                                    <b>Derniére IP</b> <a class="pull-right"> {{ ($user->last_login_ip == null)? 'Aucune ip':$user->last_login_ip }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @if(Auth::user() == $user || Auth::user()->hasRole('admin'))
                        <a href="{{ route('profile.edit', ((Auth::user()->hasRole('admin'))? $user->id:null)) }}" class="btn btn-warning pull-right">Editer le profil</a>
                    @endif
                </div>
            </div>

        </div>
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="card-title">Stats</h4>
                    <div class="row">
                        <div class="col">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <b>Parties</b> <a class="pull-right"> {{ $user->parties()->count() }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Pronostics</b> <a class="pull-right">{{ $user->bets()->count() }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Score</b> <a class="pull-right">{{ $user->bets()->where('result',true)->count() }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
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
    <script>
        var ctx = $("#betsChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Réussis", "Échoué","En attente"],
                datasets: [{
                    label: 'Pronostics',
                    data: [
                        {{ $user->bets()->where('result',true)->count() }},
                        {{ $user->bets()->where('result',false)->count() }},
                        {{ $user->bets()->where('result',null)->count() }}],
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