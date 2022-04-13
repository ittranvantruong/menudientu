@if($type == 'category' && isset($item))
<tr class="item-{{$item->id}}">
    <td>@if($item->id != 1)<input type="checkbox" class="check-list" name="id[]" value="{{$item->id}}">@endif
    </td>
    <td>{{$item->name}}</td>
    <td>{!! status($item->status) !!}</td>
    <td>{{$item->sort}}</td>
    <td>{{$item->type ? 'Có' : 'Không' }}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="open-modal edit-load btn btn-sm btn-warning" data-modal="#modalCategory"
                data-url="{{ route('edit.category', $item->id) }}">
                <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="delete btn btn-sm btn-danger"
                data-action="{{ route('delete.category', $item->id) }}">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </td>
</tr>
@endif
@if($type == 'addProductOrder'  && isset($item))
<tr>
    <td><i class="remove-product-order pointer fas fa-times-circle"></i></td>
    <td>
        {{ $item->name }}
        <input type="hidden" name="product_id[]" value="{{ $item->id }}">
    </td>
    <td>
        <input type="number" class="form-control" min="1" name="quantity[]" value="1" >
    </td>
    <td>
        <select name="price[]" class="form-control">
            <option value="{{ $item->price }}">M - {{ number_format($item->price).config('mevivu.currency') }}</option>
            @if($item->price_large != null && $item->price_large != '')
                <option value="{{ $item->price_large }}">L - {{ number_format($item->price_large).config('mevivu.currency') }}</option>
            @endif
        </select>
    </td>
    <td>{{ $item->quantity.' '.config('mevivu.unit')[$item->unit] }}</td>
    <td>{{ number_format($item->price).config('mevivu.currency') }}</td>
</tr>
@endif