@extends('template.theme')

@section('title')
    Matchs du tournois : {{ $tournament->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <div class="box-header">
                        <h3 class="box-title">Matchs</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <div class="row margin-bottom">
                            <div class="col-md-4"><img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive pull-right" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span></div>
                            <div class="col-md-4 text-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="home_score" id="">
                                            @for($i = 0; $i <= 15; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4"> -</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" name="visitor_score" id="">
                                            @for($i = 0; $i <= 15; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"><img class="pull-left" src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/></div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop