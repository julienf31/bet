@extends('template.theme')

@section('title')
    Ajouter une version
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ajouter une version</h3>
                </div>
                <div class="box-body">
                    <form method="post" class="form-horizontal" action="{{ route('versions.store') }}">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="version" class="col-sm-2 control-label">Numéro de la version</label>
                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="version" placeholder="Version">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="version" class="col-sm-2 control-label">Titre de la version</label>
                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="title" placeholder="Titre">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="description" placeholder="Description">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type" class="col-sm-2 control-label">Type </label>
                                <div class="col-sm-6 col-lg-4">
                                    <select class="form-control select2" name="type" style="width: 100%;">
                                        <option value="dev">Développement</option>
                                        <option value="fix">Correctif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date" class="col-sm-2 control-label">Date : </label>
                                <div class="col-sm-6 col-lg-4">
                                    <input name="date" type="text" class="form-control pull-right date">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('versions.index') }}" class="btn btn-danger btn-flat">Retour</a>
                            <button type="submit" class="btn btn-success pull-right btn-flat"><i class="fa fa-save"></i> Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    @parent
    <script>
        $(function () {
            $('.select2').select2()
        });
    </script>

    <script src="{{ asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>

    <script>
        $(function () {
            //Date range picker with time picker
            $('.date').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
            });

            $('.time').timepicker({
                showMeridian: false,
            })
        })

    </script>
@stop