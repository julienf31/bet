@extends('template.theme')

@section('title')
    Équipes du tournois : {{ $tournament->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Équipes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>Nom</th>
                            <th>Ville</th>
                            <th>Action</th>
                        </tr>
                        @foreach($tournament->teams as $team)
                            <tr>
                                <td><img src="{{ asset('img/logos/teams/'.$team->id.'.'.$team->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span> {{ $team->name }} </td>
                                <td>{{ ucfirst($team->city) }}</td>
                                <td>
                                    <a href="{{ route('teams.edit', $team->id) }}"><i class="fa fa-gears"></i></a>
                                    <a><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-warning"> Retour</a>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop