@extends('template.theme')

@section('title')
    Liste de mes parties
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Mes parties <span class="badge bg-green"> {{ count($games) }}</span></h3>

                    <div class="pull-right">
                        <a href="{{ route('games.create') }}" name="create" class="btn btn-success"><i class="fa fa-plus"> </i> Creer une partie</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        @if(count($games) == 0)
                            Pas de parties en cours
                        @else
                            @foreach($games as $game)
                                <div class="col-sm-12">
                                    <hr>
                                    <p class="pull-right"><small>{{ $game->participants->count() }}{{ (isset($game->max_participants))? '/'.$game->max_participants:'' }} <i class="fa fa-user"></i> </small></p>
                                    <div class="media-body">
                                        <img src="{{ asset('img/logos/tournaments/'.$game->tournament->logo) }}" class="img-responsive pull-left" style="display: inline-block;" width="100px">

                                        <h4 class="media-heading user_name"><small>{!! ($game->privacy)? '<i class="fa fa-lock fa-fw"></i>':'<i class="fa fa-unlock fa-fw"></i>' !!}</small> {{ $game->name }}</h4>
                                        {{ $game->description }}
                                        <p><small><a href="{{ route('games.show', $game->id) }}">Accéder</a> - <a href="{{ route('games.edit', $game->id) }}">Paramétres</a></small></p>
                                        <a href="{{ route('bet',$game->id) }}" class="btn btn-success">Parier</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop