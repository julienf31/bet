<table class="table tab-pane">
    <tr>
        <th style="width: 20px;"></th>
        <th>Pseudo</th>
        <th>Score</th>
        <th>%</th>
    </tr>
    @foreach($rank as $i => $r)
        <tr>
            <td>
                {!! ($i == 0)? '<i class="fa fa-star text-yellow"></i>':(($i == 1)? '<i class="fa fa-star text-gray"></i>':(($i == 2)? '<i class="fa fa-star text-brown"></i>':'')) !!}
            </td>
            <td>
                <a href="{{ route('profile', $r['id']) }}" class="pseudo" data-toggle="tooltip" title="{{ $r['pseudo'] }}">
                    {{ $r['name'] }} {{ strtoupper(substr($r['lastname'],0,1)) }}.
                </a>
            </td>
            <td>{{ $r['score'] }}</td>
            <td>{{ round($r['percents']) }} %</td>
        </tr>
    @endforeach
</table>