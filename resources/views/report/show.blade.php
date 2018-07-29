@extends('template.theme')

@section('title')
    Report bug
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Nous contacter</h3>
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

                </div>
            </div>
        </div>
    </div>
@stop
