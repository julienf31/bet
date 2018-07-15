@extends('template.theme')

@section('title')
    Profil de : {{ $user->pseudo }}
@stop

@section('content')
    <div class="row">
        <form method="post">
            {{ csrf_field() }}
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Informations de connexion</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pseudo</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $user->pseudo }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mail</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Informations</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="team" class="">Équipe favorite</label>
                                <div class="">
                                    <select class="form-control select2" name="team" style="width: 100%;">
                                        <option value="" country="" {{ (null == $user->favorite_team) ? 'selected' : '' }}>Pas d'équipe favorite</option>
                                        @foreach($teams->sortBy('name') as $team)
                                            <option value="{{ $team->id }}" country="{{ $team->country->code }}" {{ ($team->id == $user->favorite_team) ? 'selected' : '' }}>{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="team" class="">Thème</label>
                                <div class="">
                                    <select class="form-control select2Theme" name="theme" style="width: 100%;">
                                        <optgroup label="Foncés">
                                            <option value="green" {{ ('green' == $user->theme) ? 'selected' : '' }}>Vert</option>
                                            <option value="red" {{ ('red' == $user->theme) ? 'selected' : '' }}>Rouge</option>
                                            <option value="blue" {{ ('blue' == $user->theme) ? 'selected' : '' }}>Bleu</option>
                                            <option value="yellow" {{ ('yellow' == $user->theme) ? 'selected' : '' }}>Jaune</option>
                                            <option value="purple" {{ ('purple' == $user->theme) ? 'selected' : '' }}>Violet</option>
                                            <option value="black" {{ ('black' == $user->theme) ? 'selected' : '' }}>Noir</option>
                                        </optgroup>
                                        <optgroup label="Clairs">
                                            <option value="green-light" {{ ('green-light' == $user->theme) ? 'selected' : '' }}>Vert clair</option>
                                            <option value="red-light" {{ ('red-light' == $user->theme) ? 'selected' : '' }}>Rouge clair</option>
                                            <option value="blue-light" {{ ('blue-light' == $user->theme) ? 'selected' : '' }}>Bleu clair</option>
                                            <option value="yellow-light" {{ ('yellow-light' == $user->theme) ? 'selected' : '' }}>Jaune clair</option>
                                            <option value="purple-light" {{ ('purple-light' == $user->theme) ? 'selected' : '' }}>Violet clair</option>
                                            <option value="black-light" {{ ('black-light' == $user->theme) ? 'selected' : '' }}>Noir clair</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-success pull-right" type="submit">Enregistrer</button>
                    </div>
                </div>
            </div>
        </form>
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
            });

            $('.select2Theme').select2({})
        });
    </script>
@stop