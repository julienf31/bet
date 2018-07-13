@extends('template.theme')

@section('title')
    Accueil
@stop


@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-dashboard fa-fw"></i> Dashboard</h3>
                </div>
                <div class="box-body">
                    <h3>Mes parties : </h3>
                    <div class="row">
                        @if(count($games) == 0)
                            Pas de parties en cours
                        @else
                            @foreach($games as $game)
                                {{ $game->name }}
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
@stop