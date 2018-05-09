@extends('template.theme')

@section('title')
    Edition de la partie : {{ $game->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Paramétres </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="gameName" class="col-sm-2 control-label">Nom de la partie</label>

                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="gameName" placeholder="Nom de l'équipe" value="{{ $game->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="teamCity" class="col-sm-2 control-label">Description de la partie</label>

                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="teamCity" placeholder="Ville" value="{{ $game->description }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input name="gamepriv" type="checkbox" value="true" {{ $game->privacy ? 'checked' : '' }}><i class="fa fa-lock"></i> Privée
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="teamCountry" class="col-sm-2 control-label">Participants </label>
                                <div class="col-sm-6 col-lg-4">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('games.details', $game->id) }}" class="btn btn-danger">Retour</a>
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Sauvegarder</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

@section('scripts')
@stop