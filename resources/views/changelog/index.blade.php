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
                        <h4>Version {{ $version->version }} <small class="pull-right" style="margin-right: 10px;"><i class="fa fa-clock-o fa-fw"></i> {{ $version->published_at->format('d/m/Y') }}</small></h4><hr>
                        @if(!$version->changelogs->where('type', 'add')->isEmpty())
                            <h4>Ajouts :</h4>
                            @foreach($version->changelogs->where('type', 'add') as $changelog)
                                <p><i class="fa fa-plus text-success fa-fw"></i> {{ $changelog->title }}</p>
                            @endforeach
                        @endif
                        @if(!$version->changelogs->where('type', 'fix')->isEmpty())
                            <h4>Correctifs :</h4>
                            @foreach($version->changelogs->where('type', 'fix') as $changelog)
                                <p><i class="fa fa-minus text-warning fa-fw"></i> {{ $changelog->title }}</p>
                            @endforeach
                        @endif
                        @if(!$version->changelogs->where('type', 'remove')->isEmpty())
                            <h4>Suppressions :</h4>
                            @foreach($version->changelogs->where('type', 'remove') as $changelog)
                                <p><i class="fa fa-times text-danger fa-fw"></i> {{ $changelog->title }}</p>
                            @endforeach
                        @endif
                        @if(Auth::user()->hasRole('admin'))
                            <a href="{{ route('changelog.create',$version->id) }}" class="pull-right btn btn-facebook btn-flat">Ajouter</a>
                            <br><br>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
