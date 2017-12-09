@extends('template.theme')

@section('title')
    Edition du tournois : {{ $tournament->name }}
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
                                <label for="tournamentName" class="col-sm-2 control-label">Nom du tournois</label>

                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="tournamentName" placeholder="Nom du tournois" value="{{ $tournament->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tournamentDesc" class="col-sm-2 control-label">Description du tournois</label>

                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="tournamentDesc" placeholder="Description du tournois" value="{{ $tournament->description }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tournamentCountry" class="col-sm-2 control-label">Pays </label>
                                <div class="col-sm-6 col-lg-4">
                                    <select class="form-control select2" name="tournamentCountry" style="width: 100%;">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" country="{{ $country->code }}" {{ ($country->id == $tournament->country_id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
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
                </div>
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