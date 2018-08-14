<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Application - Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">
    <link href="{{ asset('plugins/flag-icon-css-master/css/flag-icon.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url({{ asset('img/background/football.jpg') }}); background-repeat: no-repeat; -webkit-background-size: cover;background-size: cover;">
<div class="login-box" style="background-color: rgba(11,11,11,0.8);padding: 30px;">
    <div class="login-logo">
        <a href="{{ route('login') }}" style="color: whitesmoke;"><b>BTV</b>Bet</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Rentrez vos identifiants pour vous authentifier</p>
        <form action="" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="email" placeholder="Email ou pseudo" value="{{ old('email') }}" autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember" checked style="margin-right: 5px;"> Se souvenir de moi
            </div>
            <div class="row">
                <div class="col-xs-12 ">
                    <button type="submit" class="btn btn-success btn-flat pull-right">Connexion</button>
                </div>
            </div>
        </form>

        <a href="#">J'ai oublié mon mot de passe</a><br>
        <a href="{{ Route('register') }}" class="text-center">Pas inscrit ? Créer un compte</a>
    </div>
    <p class="text-center margin" style="color: whitesmoke;">Version {{ config('app.version') }}</p>
</div>

<script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('js/adminlte.min.js') }}"></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::render() !!}
</body></html>