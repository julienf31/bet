<header class="main-header">
    <!-- Logo -->
    <a href="home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>B</b>bet</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>BTV</b>bet</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if(Auth::guest())
                    <li class=" {{ (route('login') == Request::url()) ? 'active' : '' }} ">
                        <a href="{{ Route('login') }}" class="">Connexion</a>
                    </li>
                    <li class="{{ (route('register') == Request::url()) ? 'active' : '' }}">
                        <a href="{{ Route('register') }}" class="">Inscription</a>
                    </li>
                @else
                    <li class=" {{ (route('login') == Request::url()) ? 'active' : '' }} ">
                        <a href="{{ Route('login') }}" class="">Profil</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <!-- HOME -->
            <li {{ (Request::is('home')) ? 'class=active' : '' }}>
                <a href="{{ route('home') }}">
                    <i class="fa fa-home"></i> <span>Accueil</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>