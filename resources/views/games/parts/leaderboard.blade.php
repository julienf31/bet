<table class="table tab-pane">
    <tr>
        <th style="width: 20px;"></th>
        <th></th>
        <th>Pseudo</th>
        <th>Score</th>
        <th>%</th>
    </tr>
    @php
        $current_score = null;
        $current_rank = 1;
        $previous_rank = false;
    @endphp
    @foreach($rank as $i => $r)
        <tr>
            @php
                if($current_score == null){
                    $current_score = $r['score'];
                    }
                if($r['score'] != $current_score){
                    $current_rank+=1;
                }
            @endphp
            <td>
                {!! ($current_rank == 1)? '<i class="fa fa-star text-yellow"></i>':(($current_rank == 2)? '<i class="fa fa-star text-gray"></i>':(($current_rank == 3)? '<i class="fa fa-star text-brown"></i>':'')) !!}
            </td>
            @php
                if($r['score'] == $current_score){
                    if($previous_rank == false){
                        echo '<td>'.$current_rank.'</td>';
                        $current_score = $r['score'];
                        $previous_rank = true;
                    } else {
                        echo '<td> - </td>';
                    }
                }else{
                    echo '<td>'.$current_rank.'</td>';
                    $current_score = $r['score'];
                    $previous_rank = true;
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