@extends('template.theme')

@section('title')
    Edition de l'équipe : {{ $team->name }}
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
                                <label for="teamName" class="col-sm-2 control-label">Nom de l'équipe</label>

                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="teamName" placeholder="Nom de l'équipe" value="{{ $team->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input id="teamNat" name="teamNat" type="checkbox" value="true" {{ ($team->type == 'national') ? 'checked' : '' }}><i class="fa fa-globe"></i> Sélection Nationale
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="cityBlock" class="form-group {{ ($team->type == 'national') ? 'hidden' : '' }}">
                                <label for="teamCity" class="col-sm-2 control-label">Ville de l'équipe</label>

                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="teamCity" placeholder="Ville" value="{{ $team->city }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="teamCountry" class="col-sm-2 control-label">Pays </label>
                                <div class="col-sm-6 col-lg-4">
                                    <select class="form-control select2" name="teamCountry" style="width: 100%;">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" country="{{ $country->code }}" {{ ($country->id == $team->country_id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('teams.list') }}" class="btn btn-danger">Retour</a>
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

            $('#teamNat').change(function () {
                if($(this).is(':checked')){
                    $('#cityBlock').addClass('hidden');
                }else{
                    $('#cityBlock').removeClass('hidden');
                }
            })
        });
    </script>
@stop