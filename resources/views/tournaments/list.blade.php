@extends('template.theme')

@section('title')
    Liste des tournois
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ count($tournaments) }}</h3>

                    <p>Tournois disponible</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-football"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $countries }}</h3>

                    <p>Pays représentés</p>
                </div>
                <div class="icon">
                    <i class="ion ion-flag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $teams }}</h3>

                    <p>Equipes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>65</h3>

                    <p>Matchs par semaines</p>
                </div>
                <div class="icon">
                    <i class="ion ion-play"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
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
                <!-- /.box-header -->
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
                                <td><span class="label label-{{ ($tournament->status == 1) ? 'warning' : (($tournament->status == 2) ? 'danger' : 'success') }}">{{ ($tournament->status == 1) ? 'En cours' : (($tournament->status == 2) ? 'A venir' : 'Terminé') }}</span></td>
                                <td>{{ $tournament->currentDay.' / '.$tournament->days }}</td>
                                <td>{{ $tournament->description }}</td>
                                @if(Auth::user()->group_id == 1)
                                    <td>
                                        <a href="{{ route('tournaments.edit',$tournament->id) }}"><i class="fa fa-gear text-warning"></i></a>
                                    </td>
                                @endif
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