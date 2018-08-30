@extends('template.theme')

@section('title')
    Report bug
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Nous contacter</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <p class="text-justify">L'application étant toujours en cours de dévellopement, vous pouvez nous faire remonter les bugs, ou proposer des fonctionalités / améliorations via le formulaire ci dessous.</p>
                        </div>
                        <div class="col-xs-6">
                            <ul class="list-group list-unstyled">
                                <li><span class="text-bold">Version du site</span><span class="pull-right text-light">{{ config('app.version') }}</span></li>
                                <li><span class="text-bold">Date</span><span class="pull-right text-light">{{ now() }}</span></li>
                                <li><span class="text-bold">Adresse IP</span><span class="pull-right text-light">{{ Request::ip() }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <form method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="user">Utilisateur</label>
                            <input class="form-control" type="text" value="{{ Auth::user()->pseudo }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="user">Objet</label>
                            <select class="form-control" name="type">
                                <option value="1">Signaler un bug</option>
                                <option value="2">Proposition de fonctionalitée</option>
                                <option value="0">Autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" class="form-control" rows="10" style="resize: none"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
