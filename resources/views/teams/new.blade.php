@extends('template.theme')

@section('title')
    Créer une nouvelle partie
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Informations de la partie</h3>
                </div>
                <!-- /.box-header -->
                <form method="post" action="" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="gamename" class="col-sm-2 control-label">Nom de la partie</label>

                            <div class="col-sm-6 col-lg-4">
                                <input type="text" class="form-control" name="gamename" placeholder="Nom de la partie">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gamedesc" class="col-sm-2 control-label">Description de la partie</label>

                            <div class="col-sm-6 col-lg-4">
                                <input type="text" class="form-control" name="gamedesc" placeholder="Description de la partie">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gametournament" class="col-sm-2 control-label">Compétition </label>
                            <div class="col-sm-6 col-lg-4">
                                <select class="form-control select2" name="gametournament" style="width: 100%;">
                                    @foreach($tournaments as $tournament)
                                        <option value="{{ $tournament->id }}" country="{{ $tournament->country->code }}">{{ $tournament->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input name="gameprivacy" type="checkbox" value="true"><i class="fa fa-lock"></i> Rendre privé
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="reset" class="btn btn-warning">Vider</button>
                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Créer</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

@section('scripts')
<script>
    function formatState (state) {
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span><span class="flag-icon flag-icon-'+state.element.getAttribute('country').toLowerCase()+'"></span> &nbsp;&nbsp;'+state.text+'</span>'
        );
        return $state;
    };

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({
            templateResult: formatState
        })
    });
</script>
@stop