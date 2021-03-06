@extends('template.theme')

@section('title')
    Logs
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <div class="row">
                <div class="col-md-12">
                    <button id="filter" class="btn btn-info btn-flat"><i class="fa fa-filter"></i> Filtre</button>
                </div>
            </div>
        </div>
        <div id="filter-box" class="box-body hidden">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form action="">
                        <h4>Filtrer les logs</h4>
                        <div class="form-group">
                            <select type="text" name="user" class="form-control select2">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ (request()->input('user') == $user->id)? 'selected':'' }}>{{ $user->pseudo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="path" class="form-control" placeholder="Path" value="{{ request()->input('path') }}">
                        </div>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-search"></i> Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Utilisateur</th>
                    <th>Methode</th>
                    <th>Path</th>
                    <th>Ip</th>
                    <th style="min-width: 200px;">Date</th>
                    <th >Input</th>
                </tr>
                @foreach($logs as $log)
                    <tr>
                        <td>{!! $log->id !!}</td>
                        <td>{!! (isset($log->user_id))? $log->user->linkToProfile('pseudo'):'guest' !!}</td>
                        <td>{!! $log->getMethod() !!}</td>
                        <td><span class="label label-info">{!! $log->path !!}</span></td>
                        <td><span class="label label-primary">{!! $log->ip !!}</span></td>
                        <td>{!! $log->created_at !!}</td>
                        <td><code>{!! nl2br($log->input) !!}</code></td>
                    </tr>
                @endforeach
            </table>
            {{ $logs->appends(request()->input())->links() }}
        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script type="text/javascript">
        $("#filter").on('click', function () {
            $("#filter-box").toggleClass('hidden');
        })
    </script>
@stop