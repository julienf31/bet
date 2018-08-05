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
                <div class="box-body">
                    <form method="post" action="" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="gameName" class="col-sm-2 control-label">Nom de la partie</label>
                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="name" placeholder="Nom de l'équipe" value="{{ $game->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="teamCity" class="col-sm-2 control-label">Description de la partie</label>
                                <div class="col-sm-6 col-lg-4">
                                    <input type="text" class="form-control" name="description" placeholder="Ville" value="{{ $game->description }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input name="privacy" type="checkbox" value="true" {{ $game->privacy ? 'checked' : '' }}><i class="fa fa-lock"></i> Privée
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="participants[]" class="col-sm-2 control-label">Participants </label>
                                <div class="col-sm-6 col-lg-4">
                                    <select class="form-control select2" name="participants[]" style="width: 100%;" multiple>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" country="{{ $user->country }}" {{ (in_array( $user->id,$participants))? 'selected':'' }}>{{ $user->pseudo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="days" class="col-sm-2 control-label">Nombre de journées d'avances</label>
                                <div class="col-sm-6 col-lg-4">
                                    <input type="number" class="form-control" name="daysAhead" placeholder="Nombre de journées d'avance" value="{{ $game->daysAhead }}" step="1" min="1" max="10">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{ url()->previous() }}" class="btn btn-danger btn-flat">Retour</a>
                            <button type="submit" class="btn btn-success pull-right btn-flat"><i class="fa fa-save"></i> Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
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