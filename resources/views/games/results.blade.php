@extends('template.theme')

@section('title')
    Résultats
@stop

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Résultats par journées</h3>
                    <div class="col-md-12">
                        <p>Les résultats des pronostics journées par journées</p>
                        @if($results_available)
                            <div class="nav-tabs-custom">
                                <nav class="nav nav-pills flex-wrap-reverse">
                                    @for($i = $game->tournament->currentDay; $i >= 1; $i--)
                                        <a class="flex-sm-fill text-sm-center text-default nav-link {{ ($i == $game->tournament->currentDay)? 'active':'' }}" href="#tab_{{$i}}" data-toggle="tab" aria-expanded="false">Journée {{ $i }}</a>
                                    @endfor
                                </nav>
                                <div class="tab-content">
                                    @for($i = $game->tournament->currentDay; $i >= 1; $i--)
                                        <div class="tab-pane table-responsive {{ ($i == $game->tournament->currentDay)? 'active':'' }}" id="tab_{{$i}}">
                                            <table class="table">
                                                <tr>
                                                    <th>Match</th>
                                                    @foreach($users as $participant)
                                                        <th class="text-center">{{ $participant->user->getSmallName() }}</th>
                                                    @endforeach
                                                </tr>
                                                @foreach($matchs->where('days', $i)->sortBy('date') as $match)
                                                    <tr>
                                                        <td style="min-width: 150px;" class="text-center">{!! $match->getIcons() !!}</td>
                                                        @if($match->status == NULL)
                                                            <td colspan="{{ count($users) }}" class="text-center orange lighten-5">En attente</td>
                                                        @else
                                                            @foreach($users as $participant)
                                                                @if($participant->user->bets->where('match_id', $match->id)->where('game_id', $game->id)->first() != null)
                                                                <td class="{{ $participant->user->bets->where('match_id', $match->id)->where('game_id', $game->id)->first()->getStatusColor() }} text-center">
                                                                    {{ $participant->user->bets->where('match_id', $match->id)->where('game_id', $game->id)->first()->bet }}
                                                                </td>
                                                                @else
                                                                    <td class="text-center orange lighten-5">
                                                                        Non joué
                                                                    </td>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th>Points</th>
                                                    @php
                                                        $matches = $matchs->where('days', $i)->toArray();
                                                    @endphp
                                                    @foreach($users as $participant)
                                                        <th class="text-center">
                                                            {{ $participant->user->bets->whereIn('match_id', array_column($matches,'id'))->where('game_id',$game->id)->where('result',1)->count() }}
                                                        </th>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12 text-center text-bold">
                                    Pas de résultats disponible
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('games.show', $game->id) }}" class="btn btn-flat btn-warning">Retour</a>
                </div>
            </div>
        </div>
    </div>
@stop