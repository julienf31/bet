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
                            <th class="text-right">Domicile</th>
                            <th class="text-center">Score</th>
                            <th>Exterieur</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($matches->sortBy('date') as $match)
                            <tr>
                                <td class="text-right">{{ $match->hometeam->name }}</td>
                                <td class="text-center">{{ $match->home_score }} - {{ $match->visitor_score }}</td>
                                <td>{{ $match->visitorteam->name }}</td>
                                <td>
                                    <a href="{{ route('tournaments.matches.complete', [$tournament->id,$match->id]) }}">Marquer terminé</a>
                                    <a href="">Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <a href="{{ route('tournaments.matches', $tournament->id) }}" class="btn btn-warning">Retour</a>
                </div>
            </div>
        </div>
    </div>
@stop