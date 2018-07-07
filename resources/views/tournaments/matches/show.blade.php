@extends('template.theme')

@section('title')
    Matchs du tournois : {{ $tournament->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Matchs</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                        @foreach($matches->sortBy('date') as $match)
                                <div class="row margin-bottom">
                                    <div class="col-md-4"><img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive pull-right" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span></div>
                                    <div class="col-md-4 text-center">
                                        {{ $match->date->formatLocalized('%A %d %B %Y %H:%M') }}
                                    </div>
                                    <div class="col-md-4"><img class="pull-left" src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/></div>
                                </div>
                        @endforeach
                </div>
                <div class="box-footer">
                    <a href="{{ route('tournaments.matches', $tournament->id) }}" class="btn btn-warning">Retour</a>
                </div>
            </div>
        </div>
    </div>
@stop