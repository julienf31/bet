<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>Application - @yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{ asset('theme/css/mdb.min.css') }}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">

    <?php
        $color = Auth::user()->theme;
        $background = config('app.colors');
        $background = $background[$color]['code'];
    ?>
    <style>
        body{
            background: {{ $background }} !important;
        }
        .back-color{
            background-color: white;
        }
    </style>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />

</head>

<body class="hold-transition skin-{{ (Auth::user()) ? Auth::user()->theme:'green' }} sidebar-mini fixed">
<!-- Site wrapper -->
<div class="back-color">

@include('template.parts.new_menu')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>
                    @yield('title')
                    <small>@yield('subtitle')</small>
                </h1>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container-fluid">
        @section('content')
        @show
    </div>
    <!-- /.content -->
@include('template.parts.new_footer')
</div>
<!-- /.content-wrapper -->



<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="{{ asset('theme/js/jquery-3.3.1.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('theme/js/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('theme/js/mdb.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/js/script.js') }}"></script>



<!-- jQuery 3 -->
<!-- SlimScroll -->
<script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/dist/js/select2.full.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/lib/fastclick.js') }}"></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js"></script>
<script>
    // This code dosen't works on Firefox and IE and works on other browesers.
    $(document).ready(function () {
        $('.animated-icon1,.animated-icon3,.animated-icon4').click(function () {
            $(this).toggleClass('open');
        });
    });

    // Works everywhere
    $(document).ready(function () {

        // Hide/show animation hamburger function
        $('.navbar-toggler').on('click', function () {

            // Take this line to first hamburger animations
            $('.animated-icon1').toggleClass('open');

            // Take this line to second hamburger animation
            $('.animated-icon3').toggleClass('open');

            // Take this line to third hamburger animation
            $('.animated-icon4').toggleClass('open');
        });

    });
    if ('serviceWorker' in navigator) {
        alert('ok')

    };


    navigator.geolocation.getCurrentPosition(function (location) {
        alert(location)
    });


    //This is the "Offline copy of pages" service worker
    //Add this below content to your HTML page, or add the js file to your page at the very top to register service worker
    if (navigator.serviceWorker) {
        console.log('[PWA Builder] active service worker found, no need to register')
    } else {
        //Register the ServiceWorker
        navigator.serviceWorker.register('{{ asset('theme/js/doWork.js') }}', {
            scope: './'
        }).then(function(reg) {
            alert('Service worker has been registered for scope:'+ reg.scope);
        });
    }
</script>
@section('scripts')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@show

{!! Toastr::render() !!}
</body>
</html>
