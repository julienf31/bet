@extends('template.theme')

@section('title')
    Pronostiquer
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Mes parties </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                        @foreach($matches as $match)
                            <div class="row margin-bottom">
                                <div class="col-md-4"><img src="{{ asset('img/logos/teams/'.$match->hometeam->id.'.'.$match->hometeam->logo) }}" class="img-responsive pull-right" style="display: inline-block; height: 30px;"/><span class="flag-icon flag-icon-"></span></div>
                                <div class="col-md-4 text-center">
                                    <div class="btn-group match" id="match-{{$match->id}}">
                                        <button name="{{ $match->id }}-1" type="button" class="btn btn-default">1</button>
                                        <button name="{{ $match->id }}-N" type="button" class="btn btn-default">N</button>
                                        <button name="{{ $match->id }}-2" type="button" class="btn btn-default">2</button>
                                    </div>
                                </div>
                                <div class="col-md-4"><img class="pull-left" src="{{ asset('img/logos/teams/'.$match->visitorteam->id.'.'.$match->visitorteam->logo) }}" class="img-responsive" style="display: inline-block; height: 30px;"/></div>
                            </div>
                        @endforeach
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('.match > button').click( function(){
            var match = $(this).attr('name');
            if($(this).hasClass("active")){
                $(this).removeClass('active');
                $(this).val(false);
            }else{
                $(this).addClass('active');
                $(this).val(true);
            }
            $(this).parent(function(){
                alert($(this));
                $(this).closest('.btn').each(function(){
                    $(this).removeClass('active');
                });
            });

            //alert('click on' + match);
        });
    </script>
@stop