@extends('template.theme')

@section('title')
    Pronostiquer
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form method="post" action="{{ route("bet.save", $game->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="game" value="{{ $game->id }}">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @foreach($matches->sortBy('date') as $match)
                            @php
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
                            @endphp
                            <div class="row margin-bottom align-items-center">
                                @if($display)
                                    <div class="col-sm-12 text-center" style="margin-bottom: 20px;"><h3>{{ $match->date->formatLocalized('%A %d %B %Y') }}</h3></div>
                                @endif
                                <div class="col-md-4"><img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive pull-right" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span><span class="pull-right align-middle">{{ $match->hometeam->name }}</span></div>
                                <div class="col-md-4 text-center">
                                    {{ $match->date->format('H:i') }}<br>
                                    <div class="btn-group match" id="{{$match->id}}">
                                        {{ $betFind = false }}
                                        @foreach($bets as $bet)
                                            @if($bet['match_id'] == $match->id)
                                                @php($betFind = true)
                                                <button name="1" type="button" class="btn btn-default {{ ($bet['bet'] == 1) ? 'active':'' }}">1</button>
                                                <button name="N" type="button" class="btn btn-default {{ ($bet['bet'] == 'N') ? 'active':'' }}">N</button>
                                                <button name="2" type="button" class="btn btn-default {{ ($bet['bet'] == 2) ? 'active':'' }}">2</button>
                                            @endif
                                        @endforeach
                                        @if(!$betFind)
                                            <button name="1" type="button" class="btn btn-default">1</button>
                                            <button name="N" type="button" class="btn btn-default">N</button>
                                            <button name="2" type="button" class="btn btn-default">2</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4"><img class="" src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/><span class="align-middle">{{ $match->visitorteam->name }}</span></div>
                            </div>
                            <select name="match[{{$match->id}}]" id="select-match-{{$match->id}}" class="hidden">
                                <option value="" selected></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="N">N</option>
                            </select>
                        @endforeach
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Envoyer</button>
                    </div>
                    <!-- /.box-body -->
            </div>
            </form>
            <!-- /.box -->
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('.match > button').click( function(){
            var $match = $(this).closest('.match');
            var id = $match.attr('id');
            var selection = $(this).attr('name');
            $match.children('button').each(function(){
                $(this).removeClass('active');
            });
            $(this).addClass('active');

            // save to select
            var $select = $("#select-match-" + id);
            $select.val(selection)
        });
    </script>
@stop
