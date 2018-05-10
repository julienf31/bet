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
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Compétition</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Création</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($games as $game)
                        <tr>
                            <td>{{ $game->id }}</td>
                            <td>{{ $game->name }}</td>
                            <td><span class="flag-icon flag-icon-{{ strtolower($game->tournament->country->code) }}"></span> {{ $game->tournament->name }}</td>
                            <td><span class="label label-danger">Denied</span></td>
                            <td>{{ $game->description }}</td>
                            <td>{{ $game->created_at }}</td>
                            <td>
                                <a href="{{ route('games.show', $game->id) }}"> <i class="fa fa-info"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop