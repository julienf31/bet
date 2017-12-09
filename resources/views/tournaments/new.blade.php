@extends('template.theme')

@section('title')
    Créer un nouveau tournois
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Informations du tournois</h3>
                </div>
                <!-- /.box-header -->
                <form method="post" action="" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="tournamentName" class="col-sm-2 control-label">Nom du tournois</label>

                            <div class="col-sm-6 col-lg-4">
                                <input type="text" class="form-control" name="tournamentName" placeholder="Nom du tournois" value="{{ old('tournamentName') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tournamentDesc" class="col-sm-2 control-label">Description du tournois</label>

                            <div class="col-sm-6 col-lg-4">
                                <input type="text" class="form-control" name="tournamentDesc" placeholder="Description du tournois" value="{{ old('tournamentDesc') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tournamentCountry" class="col-sm-2 control-label">Pays </label>
                            <div class="col-sm-6 col-lg-4">
                                <select class="form-control select2" name="tournamentCountry" style="width: 100%;">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" country="{{ $country->code }}" {{ ($country->id == old('tournamentCountry')) ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tournamentType" class="col-sm-2 control-label">Type </label>
                            <div class="col-sm-6 col-lg-4">
                                <select class="form-control select2Type" name="tournamentType" style="width: 100%;">
                                    <option value="league">Championat</option>
                                    <option value="tournament">Tournois</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tournamentYear" class="col-sm-2 control-label">Année / Saison </label>
                            <div class="col-sm-6 col-lg-4">
                                <select class="form-control select2Type" name="tournamentYear" style="width: 100%;">
                                    @for($i=2017; $i<2030;$i++)
                                        <option value="{{ $i }}" {{ ($i == 2017) ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="reset" class="btn btn-warning">Vider</button>
                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Sauvegarder</button>
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
        $('.select2Type').select2()
    });
</script>
@stop