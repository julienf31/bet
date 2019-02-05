@extends('template.theme')

@section('title')
    Liste de mes parties
@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Mes parties</h4>
                    <a href="{{ route('games.create') }}" name="create" class="btn btn-success btn-flat"><i class="fa fa-plus"> </i> Creer une partie</a>
                    <div class="row">
                        @if(count($games) == 0)
                            Pas de parties en cours
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
@stop