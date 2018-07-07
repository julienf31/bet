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
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>Journée</th>
                            <th>Nombre de matchs</th>
                            <th>Action</th>
                        </tr>
                        @foreach($days as $day)
                            <tr {{ ($tournament->currentDay > $day['number'])? 'class=table-success':'' }}>
                                <td>{{ $day['number'] }}</td>
                                <td {{ ($day['matches'] < $tournament->participants/2)? 'class=text-danger':'class=text-success' }}>{{ $day['matches'] }}</td>
                                <td>
                                    <a href="{{ route('tournaments.day.matches.show', [$tournament->id,$day['number']]) }}">Voir</a>
                                    <a href="{{ route('tournaments.day.matches', [$tournament->id,$day['number']]) }}">Editer</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <a href="{{ route('tournaments.details', $tournament->id) }}" class="btn btn-warning">Retour</a>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop