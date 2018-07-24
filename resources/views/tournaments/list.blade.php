@extends('template.theme')

@section('title')
    Liste des tournois
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tournois <span class="badge bg-green"> {{ count($tournaments) }}</span></h3>
                    @if(Auth::user()->group_id == 1)
                        <div class="pull-right">
                            <a href="{{ route('tournaments.new') }}" name="create" class="btn btn-success"><i class="fa fa-plus"> </i> Ajouter un tournois</a>
                        </div>
                    @endif
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>Pays</th>
                            <th>Nom</th>
                            <th>Année / Saison</th>
                            <th>Status</th>
                            <th>Journée</th>
                            <th>Description</th>
                            @if(Auth::user()->group_id == 1)
                                <th>Gestion</th>
                            @endif
                        </tr>
                        @foreach($tournaments as $tournament)
                            <tr>
                                <td><span class="flag-icon flag-icon-{{ strtolower($tournament->country->code) }}"></span> {{ $tournament->country->name }}</td>
                                <td><a href="{{ route('tournaments.details', $tournament->id) }}"> {{ $tournament->name }} </a></td>
                                <td>{{ $tournament->year }}</td>
                                <td>{!! $tournament->status() !!}</td>
                                <td>{{ $tournament->currentDay.' / '.$tournament->days }}</td>
                                <td>{{ $tournament->description }}</td>
                                @if(Auth::user()->group_id == 1)
                                    <td>
                                        <a href="{{ route('tournaments.details',$tournament->id) }}"><i class="fa fa-play text-blue"></i></a>&nbsp;
                                        <a href="{{ route('tournaments.edit',$tournament->id) }}"><i class="fa fa-gear text-warning"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody></table>
                </div>
            </div>
        </div>
    </div>
@stop