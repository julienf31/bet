@extends('template.theme')

@section('title')
    Liste des versions
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Liste des versions</h3>
                </div>
                <div class="box-body">
                    @foreach($versions->sortByDesc('id') as $version)
                        <h4>@if($version->version == config('app.version'))<i class="fa fa-star text-yellow fa-fw"></i>@endif Version {{ $version->version }} {!! $version->getType() !!} <small class="pull-right" style="margin-right: 10px;"><i class="fa fa-clock-o fa-fw"></i> {{ $version->published_at->format('d/m/Y') }}</small></h4>

                        <p><span class="text-bold">Nom :</span> {{ $version->title }}</p>
                        <p><span class="text-bold">Description :</span> {{ $version->description }}</p>
                        <hr>
                    @endforeach
                </div>
                <div class="box-footer">
                    @if(Auth::user()->hasRole('admin'))
                        <a href="{{ route('versions.create') }}" class="btn btn-success btn-flat pull-right">Ajouter une version</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
