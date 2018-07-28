<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> {{ config('app.version') }}
    </div>
    <center>Rendered in {{ (number_format((microtime(true) - LARAVEL_START), 4, '.', '')) }} s © 2017</center>

</footer>