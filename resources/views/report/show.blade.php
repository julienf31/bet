@extends('template.theme')

@section('title')
    Report bug
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Détail du signalement #{{ $report->id }}</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <ul class="list-group list-unstyled">
                                <li><span class="text-bold">Utilisateur</span><span class="pull-right text-light">{{ $report->user->pseudo }}</span></li>
                                <li><span class="text-bold">Date</span><span class="pull-right text-light">{{ $report->created_at }}</span></li>
                                <li><span class="text-bold">Adresse IP</span><span class="pull-right text-light">{{ $report->ip }}</span></li>
                            </ul>                        </div>
                        <div class="col-xs-6">
                            <ul class="list-group list-unstyled">
                                <li><span class="text-bold">Version du site</span><span class="pull-right text-light">{{ $report->version }} (actuelle : {{ config('app.version') }})</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="text-bold">Message :</h4>
                            <p>{!! $report->message !!}</p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('report.index') }}" class="btn btn-warning btn-flat">Retour</a>
                    <a href="{{ route('report.complete', $report) }}" class="btn btn-success btn-flat pull-right">Marquer {{ ($report->status)? 'non':'' }} résolu</a>
                    <a href="{{ route('report.destroy', $report) }}" class="btn btn-danger btn-flat pull-right margin-r-5">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
@stop
