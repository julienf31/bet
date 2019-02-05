<footer id="footer" class="page-footer {{ Auth::user()->theme }} mt-4">
    <!-- Copyright-->
    <div class="footer-copyright py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="pull-left hidden-xs">
                        <a href="{{ route('changelog.index') }}">Changelog</a>
                    </div>
                    <div class="pull-right hidden-xs">
                        <a href="{{ route('changelog.index') }}"><b>Version</b> {{ config('app.version') }}</a>
                    </div>
                    <center>Rendered in {{ (number_format((microtime(true) - LARAVEL_START), 4, '.', '')) }} s © 2017</center>
                </div>
            </div>
        </div>
    </div>

    <!--/.Copyright -->
</footer>