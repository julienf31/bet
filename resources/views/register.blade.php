@extends('template.theme')

@section('title')
    Inscription
@stop

@section('content')
    <div class="register-box">

        <div class="register-box-body">
            <p class="login-box-msg">Créer un compte</p>
            <form action="" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('firstname') ? 'has-error' : ''}}">
                    <input type="text" class="form-control" name="firstname" placeholder="Prénom" value="{{ old('firstname') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if($errors->has('firstname')) <span class="help-block">{{ $errors->first('firstname') }}</span> @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('lastname') ? 'has-error' : ''}}">
                    <input type="text" class="form-control" name="lastname" placeholder="Nom" value="{{ old('lastname') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if($errors->has('lastname')) <span class="help-block">{{ $errors->first('lastname') }}</span> @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('pseudo') ? 'has-error' : ''}}">
                    <input type="text" class="form-control" name="pseudo" placeholder="@Pseudo" value="{{ old('pseudo') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if($errors->has('pseudo')) <span class="help-block">{{ $errors->first('pseudo') }}</span> @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : ''}}">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span> @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : ''}}">
                    <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span> @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmez le mot de passe">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if($errors->has('password_confirmation')) <span class="help-block">{{ $errors->first('password_confirmation') }}</span> @endif
                </div>
                <div class="row">
                    <div class="col-xs-4 pull-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Valider</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                    Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                    Google+</a>
            </div>

            <a href="{{ Route('login') }}" class="text-center">J'ai déja un compte</a>
        </div>
        <!-- /.form-box -->
    </div>
@stop