<table class="table tab-pane">
    <tr>
        <th style="width: 20px;"></th>
        <th></th>
        <th>Pseudo</th>
        <th>Score</th>
        <th>%</th>
    </tr>
    @php
        $current_score = 0;
        $current_rank = 1;
        $previous_rank = true;
    @endphp
    @foreach($rank as $i => $r)
        <tr>
            <td>
                {!! ($i == 0)? '<i class="fa fa-star text-yellow"></i>':(($i == 1)? '<i class="fa fa-star text-gray"></i>':(($i == 2)? '<i class="fa fa-star text-brown"></i>':'')) !!}
            </td>
            @php
                if($r['score'] > $current_score){
                    $current_score == $r['score'];
                }

                if($r['score'] == $current_score){
                    if($previous_rank == false){
                        echo '<td>'.$current_rank.'</td>';
                        $previous_rank == true;
                    } else {
                        echo '<td> - </td>';
                    }
                }else{
                    echo '<td>'.$current_rank.'</td>';
                    $current_rank++;
                    $current_score = $r['score'];
                    $previous_rank == true;
                }
            @endphp
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