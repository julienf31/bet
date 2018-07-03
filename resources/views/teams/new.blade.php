@extends('template.theme')

@section('title')
    Créer une équipe
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Informations de l'équipe</h3>
                </div>
                <!-- /.box-header -->
                <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="teamName" class="col-sm-2 control-label">Nom de l'équipe</label>

                            <div class="col-sm-6 col-lg-4">
                                <input type="text" class="form-control" name="teamName" placeholder="Nom de l'équipe" value="{{ old('teamName') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input id="teamNat" name="teamNat" type="checkbox" value="true" {{ ( old('teamNat')) ? 'checked' : '' }}><i class="fa fa-globe"></i> Sélection Nationale
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="cityBlock" class="form-group {{ ( old('teamNat')) ? 'hidden' : '' }}">
                            <label for="teamCity" class="col-sm-2 control-label">Ville de l'équipe</label>

                            <div class="col-sm-6 col-lg-4">
                                <input type="text" class="form-control" name="teamCity" placeholder="Ville" value="{{ old('teamCity') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="teamCountry" class="col-sm-2 control-label">Pays </label>
                            <div class="col-sm-6 col-lg-4">
                                <select class="form-control select2" name="teamCountry" style="width: 100%;">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" country="{{ $country->code }}" {{ ($country->id == old('teamCountry')) ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="teamName" class="col-sm-2 control-label">Logo</label>

                            <div class="col-sm-6 col-lg-4">
                                <input type="file" class="custom-file" name="teamLogo">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Retour</a>
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