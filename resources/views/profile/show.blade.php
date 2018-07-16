@extends('template.theme')

@section('title')
    Profil de : {{ $user->pseudo }}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Informations</h3>
                    @if(Auth::user() == $user)
                        <a href="{{ route('profile.edit',null) }}" class="btn btn-warning pull-right">Editer le profil</a>
                    @endif
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <ul class="list-group list-group-unbordered">
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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Stats</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Parties</b> <a class="pull-right"> {{ $user->games()->count() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Pronostics</b> <a class="pull-right">{{ $user->bets()->count() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Score</b> <a class="pull-right">{{ $user->bets()->where('result',true)->count() }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <canvas id="betsChart"></canvas>
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