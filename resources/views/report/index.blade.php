@extends('template.theme')

@section('title')
    Report list
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Liste des rapports non traités</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-responsive">
                        <tr>
                            <th>#</th>
                            <th><i class="fa fa-eye"></i></th>
                            <th>Type</th>
                            <th>Utilisateur</th>
                            <th>IP</th>
                            <th>Version</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($reports->where('status',0)->sortBy('id')->sortBy('seen') as $report)
                            <tr class="{{ $report->color() }}">
                                <td>{{ $report->id }}</td>
                                <td class="text-info"><a href="{{ route('report.seen',$report->id) }}">{!! ($report->seen)? '<i class="fa fa-circle-o"></i>':'<i class="fa fa-circle"></i>' !!}</a></td>
                                <td>{{ $report->type() }}</td>
                                <td><a href="{{ route('profile',$report->user->id) }}">{{ $report->user->pseudo }}</a></td>
                                <td>{{ $report->ip }}</td>
                                <td>{{ $report->version }}</td>
                                <td>{!! strip_tags(str_limit($report->message, 33)) !!}</td>
                                <td>
                                    <a href="{{ route('report.show',$report->id) }}"><i class="fa fa-eye"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Liste des rapports traités</h3>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table table-responsive">
                                <tr>
                                    <th>#</th>
                                    <th><i class="fa fa-eye"></i></th>
                                    <th>Type</th>
                                    <th>Utilisateur</th>
                                    <th>IP</th>
                                    <th>Version</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($reports->where('status',1)->sortBy('id')->sortBy('seen') as $report)
                                    <tr class="{{ $report->color() }}">
                                        <td>{{ $report->id }}</td>
                                        <td class="text-info"><a href="{{ route('report.seen',$report->id) }}">{!! ($report->seen)? '<i class="fa fa-circle-o"></i>':'<i class="fa fa-circle"></i>' !!}</a></td>
                                        <td>{{ $report->type() }}</td>
                                        <td><a href="{{ route('profile',$report->user->id) }}">{{ $report->user->pseudo }}</a></td>
                                        <td>{{ $report->ip }}</td>
                                        <td>{{ $report->version }}</td>
                                        <td>{{ str_limit($report->message, 33) }}</td>
                                        <td>
                                            <a href="{{ route('report.show',$report->id) }}"><i class="fa fa-eye"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
