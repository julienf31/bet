@extends('template.theme')

@section('title')
    Demande d'approbation
@stop

@section('subtitle')
    Partie {{ $game->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-question fa-fw"></i> Demande d'approbation</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        @if(count($requests) == 0)
                            <div class="col-sm-12 text-center">Pas de demandes</div>
                        @else
                            <div class="col-sm-10 col-sm-offset-1">
                                <table class="table">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Actions</th>
                                    </tr>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td>{{ $request->user->lastname }}</td>
                                            <td>{{ $request->user->firstname }}</td>
                                            <td><span class="text-info" data-toggle="modal" data-target="#request-{{ $request->id }}">Voir la demande</span></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                        @endif
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('games.show', $game->id) }}" class="btn btn-warning">Retour</a>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    @foreach($requests as $request)
        <div class="modal fade" id="request-{{ $request->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Demande d'ajout à la partie : {{ $request->user->pseudo }}</h4>
                    </div>
                    <div class="modal-body">
                        <p>L'utilisateur {{ $request->user->firstname }} {{ $request->user->lastname }} ({{ $request->user->pseudo }}) souhaite rejoindre la partie et a laissé le massage suivant :</p>
                        <p class="text-justify">{{ $request->message }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <a href="{{ route('games.access.request.accept',$request->id) }}" class="btn btn-success">Accepter</a>
                        <a href="{{ route('games.access.request.deny',$request->id) }}"  class="btn btn-danger">Refuser</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop