@extends('template.theme')

@section('title')

@stop

@section('subtitle')
    {{ $game->name }} - {{ $tournament->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <form method="post" action="{{ route("bet.save", $game->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="game" value="{{ $game->id }}">

                <div class="card">
                    <div class="box-header">
                            {!! $multiple? '<a href="'.route('bet.copy', $game->id).'" class="btn btn-flat btn-md btn-success pull-right" type="button">Dupliquer</a>':'' !!}
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="card-body">
                        @foreach($matches->sortBy('date') as $match)
                            @php
                                Carbon::setLocale('fr_FR');
                                setlocale(LC_TIME,'fr_FR');
                                $currDay = $match->days;
                                $currDate = $match->date;

                                if(!isset($date)){
                                    $display = true;
                                    $date = $currDate;
                                } else {
                                    if(!$date->isSameDay($currDate)){
                                        $display = true;
                                    } else {
                                        $display = false;
                                    }
                                    $date = $currDate;
                                }

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
                            <div class="row margin-bottom align-items-center">
                                @if($display_day)
                                    <div class="col-12" style="margin-bottom: 0px">
                                        <h5 class="d-block">Journée {{ $day }} <small class="pull-right" style="margin-right: 10px;"><i class="fa fa-clock-o fa-fw"></i> dans {{ Carbon::now()->diffForHumans($match->date,TRUE) }}</small></h5>
                                        <hr class="text-blue border-info" style="margin: 0px;">
                                    </div>
                                @endif
                                @if($display)
                                    <div class="col-sm-12 text-center" style="margin-bottom: 0px;">
                                        <h5>{{ $match->date->formatLocalized('%A %d %B %Y') }}</h5></div>
                                @endif
                                <div class="col-12 text-center">
                                    <div class="row row-eq-height">
                                        <div class="col" style="line-height: 64px"><img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive pull-right" style="display: inline-block; height: 64px; padding: 10px"/><span class="pull-right align-middle d-none d-lg-block">{{ $match->hometeam->name }}</span></div>
                                        <div class="col text-center">
                                            <span class="text-bold"
                                                  style="margin-bottom: 10px;">{{ $match->date->format('H:i') }}</span><br>
                                            <div class="btn-group match btn-group-sm" id="{{$match->id}}">
                                                {{ $betFind = false }}
                                                @foreach($bets as $bet)
                                                    @if($bet['match_id'] == $match->id)
                                                        @php($betFind = true)
                                                        <button name="1" type="button"
                                                                class="btn {{ ($bet['bet'] == 1) ? 'btn-success':'btn-grey' }}">
                                                            1
                                                        </button>
                                                        <button name="N" type="button"
                                                                class="btn {{ ($bet['bet'] == 'N') ? 'btn-success':'btn-grey' }}">
                                                            N
                                                        </button>
                                                        <button name="2" type="button"
                                                                class="btn {{ ($bet['bet'] == 2) ? 'btn-success':'btn-grey' }}">
                                                            2
                                                        </button>
                                                    @endif
                                                @endforeach
                                                @if(!$betFind)
                                                    <button name="1" type="button" class="btn">1</button>
                                                    <button name="N" type="button" class="btn">N</button>
                                                    <button name="2" type="button" class="btn">2</button>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col text-left" style="line-height: 64px"><img src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 64px; padding: 10px"/><span class=" align-middle d-none d-lg-inline-block">{{ $match->visitorteam->name }}</span></div>
                                    </div>
                                </div>
                            </div>
                            <select name="match[{{$match->id}}]" id="select-match-{{$match->id}}" class="d-none">
                                <option value="" selected></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="N">N</option>
                            </select>
                        @endforeach
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('games.show', $game->id) }}" class="btn btn-warning btn-flat">Retour</a>
                        <button type="submit" class="btn btn-success btn-flat pull-right">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        console.log('before')
        $('.match > button').click( function(){
        console.log('inside')
            var match = $(this).closest('.match');
        console.log(match)
            var id = match.attr('id');
            var selection = $(this).attr('name');
            match.children('button').each(function(){
                $(this).removeClass('btn-success');
                if(!$(this).hasClass('btn-grey')){
                    $(this).addClass('btn-grey');
                }
            });
            $(this).removeClass('btn-grey');
            $(this).addClass('btn-success');

            // save to select
            var select = $("#select-match-" + id);
            select.val(selection)
        });
    </script>
@stop
