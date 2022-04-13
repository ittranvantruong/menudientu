<tr class="item-{{$item->id}} bg-warning">
    <td>{{optional($item->user)->fullname}}</td>
    <td>
        @foreach ($item->details as $detail)
        <p>{{$detail->name.' x '.$detail->quantity.' - '.$detail->option}}</p>
        @endforeach
    </td>
    <td>{{ number_format($item->total) }} đ</td>
    <td>{{ config('mevivu.order.status')[$item->status] }}</td>
    <td>{{ $item->note }}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            @if($item->status != 2)
            <button type="button" data-target="#formPatchOrder"
                data-action="{{ route('update.order.status', [$item->id, $item->status + 1]) }}"
                class="btn-delete btn btn-sm btn-success">
                <i class="fas fa-check"></i> Duyệt
            </button>
            @endif
            <a href="{{ route('edit.order', $item->id) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-eye"></i> Xem
            </a>
        </div>
    </td>
</tr>