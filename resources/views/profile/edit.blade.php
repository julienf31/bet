@extends('template.theme')

@section('title')
    Profil de : {{ $user->pseudo }}
@stop

@section('content')
    <form method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title">Compte</h4>
                        <div class="row">
                            <div class="col">
                                <div class="md-form input-group mb-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon fa fa-user"></span>
                                    </div>
                                    <input name="firstname" placeholder="Prénom" type="text" id="firstname" class="form-control {{ $errors->has('firstname') ? ' is-invalid' : '' }}" value="{{ $user->firstname }}">
                                    <label for="firstname">Prénom</label>
                                    @if ($errors->has('firstname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('firstname') }}
                                        </div>
                                    </span>
                                    @endif
                                </div>
                                <div class="md-form input-group mb-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon fa fa-user"></span>
                                    </div>
                                    <input name="lastname" placeholder="Prénom" type="text" id="lastname" class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{ $user->lastname }}">
                                    <label for="lastname">Nom</label>
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="md-form input-group mb-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon fa fa-user"></span>
                                    </div>
                                    <input name="pseudo" placeholder="Pseudo" type="text" id="pseudo" class="form-control {{ $errors->has('pseudo') ? ' is-invalid' : '' }}" value="{{ $user->pseudo }}">
                                    <label for="pseudo">Pseudo</label>
                                    @if ($errors->has('pseudo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('pseudo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="md-form input-group mb-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon fa fa-envelope"></span>
                                    </div>
                                    <input name="email" placeholder="Email" type="text" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $user->email }}">
                                    <label for="email">Mail</label>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                @if(Auth::user()->hasRole('admin'))
                                    <div class="form-group">
                                        <label for="team" class="">Role</label>
                                        <select class="browser-default custom-select" name="role" style="width: 100%;">
                                            <option value="" disabled selected>Choose your option</option>
                                            <option value="user" {{ ($user->role == 'user') ? 'selected' : '' }}>Utilisateur</option>
                                            <option value="admin" {{ ($user->role == 'admin') ? 'selected' : '' }}>Administrateur</option>
                                        </select>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title">Mot de passe</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-info" role="alert">
                                    Pour changer votre mot de passe, saisissez le mot de passe actuel, puis le nouveau
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form input-group mb-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon fa fa-lock"></span>
                                    </div>
                                    <input name="oldPassword" placeholder="Ancien mot de passe" type="password" id="oldPassword" class="form-control {{ $errors->has('oldPassword') ? ' is-invalid' : '' }}">
                                    <label for="oldPassword">Ancien mot de passe</label>
                                    @if ($errors->has('oldPassword'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('oldPassword') }}
                                        </div>
                                        </span>
                                    @endif
                                </div>
                                <div class="md-form input-group mb-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon fa fa-lock"></span>
                                    </div>
                                    <input name="newPassword" placeholder="Nouveau mot de passe" type="password" id="newPassword" class="form-control {{ $errors->has('newPassword') ? ' is-invalid' : '' }}">
                                    <label for="newPassword">Nouveau mot de passe</label>
                                    @if ($errors->has('newPassword'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('newPassword') }}
                                        </div>
                                        </span>
                                    @endif
                                </div>
                                <div class="md-form input-group mb-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon fa fa-lock"></span>
                                    </div>
                                    <input name="newPasswordConfirm" placeholder="Confirmation du nouveau mot de passe" type="password" id="newPasswordConfirm" class="form-control {{ $errors->has('newPasswordConfirm') ? ' is-invalid' : '' }}">
                                    <label for="newPasswordConfirm">Confirmation du nouveau mot de passe</label>
                                    @if ($errors->has('newPasswordConfirm'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('newPasswordConfirm') }}
                                        </div>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title">Informations</h4>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="team" class="">Emails de rappels</label>
                                    <div class="custom-control custom-checkbox">
                                        <input id="mails" name="send_mail" type="checkbox" class="custom-control-input" {{ ($user->send_mail)? 'checked':'' }}>
                                        <label class="custom-control-label" for="mails">Recevoir des emails de rappels</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="team" class="">Équipe favorite</label>
                                    <select class="browser-default custom-select" name="team" style="width: 100%;">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="" country="" {{ (null == $user->favorite_team) ? 'selected' : '' }}>Pas d'équipe favorite</option>
                                    @foreach($teams->sortBy('name') as $team)
                                            <option value="{{ $team->id }}" country="{{ $team->country->code }}" {{ ($team->id == $user->favorite_team) ? 'selected' : '' }}>{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="theme" class="">Thème</label>
                                    <select class="browser-default custom-select" name="theme" style="width: 100%;">
                                        <option value="" disabled selected>Choose your option</option>
                                        @foreach(config('app.colors') as $key => $color)
                                            <option value="{{ $key }}" {{ ($key == $user->theme) ? 'selected' : '' }}>{{ $color['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <button class="btn btn-success pull-right" type="submit">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('scripts')
    <script>

    </script>
@stop