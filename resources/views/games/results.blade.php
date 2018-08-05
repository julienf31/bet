@extends('template.theme')

@section('title')
    Résultats de la partie : {{ $game->name }}
@stop

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Résultats par journées</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        @if($results_available)
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    @for($i = 1; ($game->tournament->status == 3)? $i <= $game->tournament->currentDay:$i < $game->tournament->currentDay; $i++)
                                        <li class="{{ ($i == 1)? 'active':'' }}"><a href="#tab_{{$i}}" data-toggle="tab" aria-expanded="false">Journée {{ $i }}</a></li>
                                    @endfor
                                </ul>
                                <div class="tab-content">
                                    @for($i = 1;($game->tournament->status == 3)? $i <= $game->tournament->currentDay:$i < $game->tournament->currentDay; $i++)
                                        <div class="tab-pane {{ ($i == 1)? 'active':'' }}" id="tab_{{$i}}">
                                            <table class="table table-responsive">
                                                <tr>
                                                    <th>Match</th>
                                                    @foreach($users as $participant)
                                                        <th>{{ $participant->user->pseudo }}</th>
                                                    @endforeach
                                                </tr>
                                                @foreach($matchs->where('days', $i) as $match)
                                                    <tr>
                                                        <td>{!! $match->getIcons() !!}</td>
                                                        @foreach($users as $participant)
                                                            <td class="{{ $participant->user->bets->where('match_id', $match->id)->first()->getStatusColor() }}">
                                                                {{ $participant->user->bets->where('match_id', $match->id)->first()->bet }}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th>Points</th>
                                                    @php
                                                        $matches = $matchs->where('days', $i)->toArray();
                                                    @endphp
                                                    @foreach($users as $participant)
                                                        <th>
                                                            {{ $participant->user->bets->whereIn('match_id', array_column($matches,'id'))->where('result',1)->count() }}
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