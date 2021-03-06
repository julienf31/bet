<nav class="mb-1 navbar navbar-expand-lg navbar-dark {{ Auth::user()->theme }}">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('img/icons/ball.png') }}" height="30" alt="mdb logo"> BTV Bet
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3" aria-controls="navbarSupportedContent-3" aria-expanded="false" aria-label="Toggle navigation">
        <div class="navbar-toggler animated-icon1"><span></span><span></span><span></span></div>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-3">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link waves-effect waves-light" href="{{ route('home') }}">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="{{ route('games.index') }}">Parties</a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="{{ route('profile.index') }}">Utilisateurs</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administration
                </a>
                <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
                    <a class="dropdown-item waves-effect waves-light" href="#">Action</a>
                    <a class="dropdown-item waves-effect waves-light" href="#">Another action</a>
                    <a class="dropdown-item waves-effect waves-light" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning">{{ $notif }}</span>
                </a>
                <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
                    <a class="dropdown-item waves-effect waves-light" href="#">Show repports</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-user"></i> {!! Auth::user()->pseudo !!} {!! (isset(Auth::user()->favorite_team))? Auth::user()->favoriteTeam->img():'' !!}
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item waves-effect waves-light" href="{{ route('profile') }}">Profil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item waves-effect waves-light" href="{{ route('logout') }}">Déconexion</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!--
<header class="main-header">
    <a href="{{ route('home') }}" class="logo">
        <span class="logo-mini"><b>B</b>bet</span>
        <span class="logo-lg"><img src="{{ asset('img/icons/ball.png') }}" class="img-responsive" style="display: inline;" width="24px"> <b>BTV</b>bet</span>
    </a>
    <nav class="navbar navbar-static-top">
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
                    @if(Auth::user()->hasRole('admin'))
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">{{ $notif }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have {{ $notif }} notification(s)</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="{{ route('report.index') }}">
                                                <i class="fa fa-warning text-yellow"></i> Voir les rapports
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="">
                        <a href="">{!! Auth::user()->pseudo !!} {!! (isset(Auth::user()->favorite_team))? Auth::user()->favoriteTeam->img():'' !!}</a>
                    </li>
                    <li class=" {{ (route('profile') == Request::url()) ? 'active' : '' }} ">
                        <a href="{{ Route('profile') }}" class="">Profil</a>
                    </li>
                    <li class=" {{ (route('logout') == Request::url()) ? 'active' : '' }} ">
                        <a href="{{ Route('logout') }}" class="">Déconexion</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
-->
<?php /* ?>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            @if(Auth::user())
                <li class="header">MENU</li>
                <!-- HOME -->
                <li {{ (Request::is('home')) ? 'class=active' : '' }}>
                    <a href="{{ route('home') }}">
                        <i class="fa fa-home"></i> <span>Accueil</span>
                    </a>
                </li>
                @if(Auth::user()->hasRole('admin'))
                    <!-- TOURNAMENTS -->
                    <li class=" {{ (Request::is('tournaments')) ? 'active menu-open' : '' }} treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Tournois</span>
                            <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu">
                            <li {{ (Request::is('tournaments')) ? 'class=active' : '' }}><a href="{{ route('tournaments.list') }}"><i class="fa fa-circle-o"></i> Liste des tournois</a></li>
                        </ul>
                    </li>
                    <!-- TEAMS -->
                    <li class=" {{ (Request::is('teams')) ? 'active menu-open' : '' }} treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Équipes</span>
                            <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu">
                            <li {{ (Request::is('teams')) ? 'class=active' : '' }}><a href="{{ route('teams.list') }}"><i class="fa fa-circle-o"></i> Liste des équipes</a></li>
                            <li><a href=""><i class="fa fa-circle-o"></i> Mes tournois</a></li>
                        </ul>
                    </li>
                @endif
                <!-- GAMES -->
                <li class=" {{ (Request::is('games')) ? 'active menu-open' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-gamepad"></i> <span>Parties</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {{ (Request::is('games')) ? 'class=active' : '' }}><a href="{{ route('games.index') }}"><i class="fa fa-circle-o"></i>Mes parties</a></li>
                        <li {{ (Request::is('games.search')) ? 'class=active' : '' }}><a href="{{ route('games.search') }}"><i class="fa fa-circle-o"></i>Rechercher une partie</a></li>
                    </ul>
                </li>
                <!-- USERS -->
                <li class=" {{ (Request::is('profiles')) ? 'active menu-open' : '' }} treeview">
                    <a href="#">
                        <i class="fa fa-user"></i> <span>Utilisateurs</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {{ (Request::is('profiles')) ? 'class=active' : '' }}><a href="{{ route('profile.index') }}"><i class="fa fa-circle-o"></i>Liste des utilisateurs</a></li>
                    </ul>
                </li>
                @if(Auth::user()->hasRole('admin'))
                    <!-- BUGS -->
                    <li class=" {{ (Request::is('report') || Request::is('reports')) ? 'active menu-open' : '' }} treeview">
                        <a href="#">
                            <i class="fa fa-life-bouy"></i> <span>Bug manager</span>
                            <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li {{ (Request::is('report')) ? 'class=active' : '' }}><a href="{{ route('report') }}"><i class="fa fa-circle-o"></i>Signaler un bug</a></li>
                            <li {{ (Request::is('reports')) ? 'class=active' : '' }}><a href="{{ route('report.index') }}"><i class="fa fa-circle-o"></i>Liste des bugs</a></li>
                        </ul>
                    </li>
                    <!-- VERSIONS -->
                    <li class=" {{ (Request::is('changelogs') || Request::is('versions')) ? 'active menu-open' : '' }} treeview">
                        <a href="#">
                            <i class="fa fa-clipboard"></i> <span>Versions manager</span>
                            <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li {{ (Request::is('versions')) ? 'class=active' : '' }}><a href="{{ route('versions.index') }}"><i class="fa fa-circle-o"></i>Versions</a></li>
                            <li {{ (Request::is('changelogs')) ? 'class=active' : '' }}><a href="{{ route('changelog.index') }}"><i class="fa fa-circle-o"></i>Changelog</a></li>
                        </ul>
                    </li>
                    <!-- LOGS -->
                    <li class=" {{ (Request::is('logs')) ? 'active' : '' }}">
                        <a href="{{ route('logs.index') }}">
                            <i class="fa fa-history"></i> <span>Logs</span>
                        </a>
                    </li>
                @else
                    <!-- BUGS -->
                    <li {{ (Request::is('report')) ? 'class=active' : '' }}>
                        <a href="{{ route('report') }}">
                            <i class="fa fa-life-bouy"></i> <span>Signaler un bug</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>
    </section>
</aside>
<?php ?>