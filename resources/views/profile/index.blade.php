@extends('template.theme')

@section('title')
    Liste des utilisateurs
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Liste des utilisateurs</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Pseudo</th>
                                <th>Pays</th>
                                <th class="text-center">Équipe</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users->sortBy('lastname') as $user)
                                <tr>
                                    <td>{{ ucfirst(mb_strtolower($user->firstname)) }}</td>
                                    <td class="text-uppercase">{{ $user->lastname }}</td>
                                    <td class="text-bold">{{ '@'.$user->pseudo }}</td>
                                    <td><span class="flag-icon flag-icon-{{ strtolower($user->country) }}"></span></td>
                                    <td class="text-center">{!! ($user->favoriteTeam)? $user->favoriteTeam->img():'' !!}</td>
                                    <td><a href="{{ route('profile', $user->id) }}">Voir le profil</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
