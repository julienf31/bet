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
                                <td>{{ $day['matches'] }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop