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
                        <h3 class="box-title">Mes parties </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @foreach($matches as $match)
                            <div class="row margin-bottom">
                                <div class="col-md-4"><img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive pull-right" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span></div>
                                <div class="col-md-4 text-center">
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
                                <div class="col-md-4"><img class="pull-left" src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/></div>
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
                        <button>Envoyer</button>
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