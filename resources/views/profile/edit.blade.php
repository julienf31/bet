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
                        <h3 class="box-title">Compte</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label>Prénom</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input name="firstname" type="text" class="form-control" value="{{ $user->firstname }}">
                                </div>
                                @if ($errors->has('firstame'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstame') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label>Nom</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input name="lastname" type="text" class="form-control" value="{{ $user->lastname }}">
                                </div>
                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('pseudo') ? ' has-error' : '' }}">
                                <label>Pseudo</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input name="pseudo" type="text" class="form-control" value="{{ $user->pseudo }}">
                                </div>
                                @if ($errors->has('pseudo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pseudo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>Mail</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if(Auth::user()->hasRole('admin'))
                                <div class="form-group">
                                    <label for="team" class="">Role</label>
                                    <div class="">
                                        <select class="form-control select2Theme" name="role" style="width: 100%;">
                                            <option value="user" {{ ($user->role == 'user') ? 'selected' : '' }}>Utilisateur</option>
                                            <option value="admin" {{ ($user->role == 'admin') ? 'selected' : '' }}>Administrateur</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Mot de passe</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                <label>Ancien mot de passe</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input name="oldPassword" type="password" class="form-control">
                                </div>
                                @if ($errors->has('oldPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('newPassword') ? ' has-error' : '' }}">
                                <label>Nouveau mot de passe</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input name="newPassword" type="password" class="form-control">
                                </div>
                                @if ($errors->has('newPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('newPasswordConfirm') ? ' has-error' : '' }}">
                                <label>Confirmation du nouveau mot de passe</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input name="newPasswordConfirm" type="password" class="form-control">
                                </div>
                                @if ($errors->has('newPasswordConfirm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newPasswordConfirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>Pour changer votre mot de passe actuel, veuillez le confirmer puis saisir le nouveau</p>
                        </div>
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
                                <label for="team" class="">Emails de rappels</label>
                                <div class="checkbox">
                                    <label>
                                        <input name="send_mail" type="checkbox" {{ ($user->send_mail)? 'checked':'' }}> Recevoir des emails de rappels
                                    </label>
                                </div>
                            </div>
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
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var $state = $(
                '<span><span class="flag-icon flag-icon-' + state.element.getAttribute('country').toLowerCase() + '"></span> &nbsp;&nbsp;' + state.text + '</span>'
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