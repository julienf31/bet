@extends('template.theme')

@section('title')
    Report list
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Liste des rapports</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-responsive">
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Utilisateur</th>
                            <th>IP</th>
                            <th>Version</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($reports as $report)
                            <tr>
                                <td>{{ $report->id }}</td>
                                <td>{{ $report->type }}</td>
                                <td>{{ $report->user->pseudo }}</td>
                                <td>{{ $report->ip }}</td>
                                <td>{{ $report->version }}</td>
                                <td>{{ str_limit($report->message, 33) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
