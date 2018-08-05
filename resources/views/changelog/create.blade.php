@extends('template.theme')

@section('title')
    Ajouter un correctif
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ajouter un correctif</h3>
                </div>
                <div class="box-body">
                    <form method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="gameName" class="col-sm-2 control-label">Titre de la fonctionalité</label>
                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="title" placeholder="Titre">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="teamCity" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="description" placeholder="Description">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type" class="col-sm-2 control-label">Type </label>
                                <div class="col-sm-6 col-lg-4">
                                    <select class="form-control select2" name="type" style="width: 100%;">
                                        <option value="add">Ajout</option>
                                        <option value="fix">Correctif</option>
                                        <option value="remove">Suppression</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="version_id" class="col-sm-2 control-label">Version </label>
                                <div class="col-sm-6 col-lg-4">
                                    <select class="form-control select2" name="version_id" style="width: 100%;">
                                        @foreach($versions->sortByDesc('id') as $version)
                                            <option value="{{ $version->id }}" {{ ($version->id == $selected_version->id)? 'selected' : '' }}>{{ $version->version }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('changelog.index') }}" class="btn btn-danger btn-flat">Retour</a>
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
@stop