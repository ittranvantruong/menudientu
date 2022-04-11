@extends('layouts.master')
@push('css')

<link rel="stylesheet" href=" {{asset('public/css/cart.css')}} " />

@endpush

@section('title', 'Cart')
@section('content')
<div class="head shadow d-flex">
    <div class="container">
        <div class="row no-gutters pl-3 pr-3">
            <div class="col-12 backward-button">
                <h4 class="mb-0"><a href="{{ route('home') }}" class="color-orange"><i class="fas fa-angle-left"></i>
                        <span>Back to menu</span></a></h4>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 80px;">

    @forelse($cartItems as $item)
    <div class="item-cart d-flex align-items-center shadow-sm mb-3 pt-2 pb-2" data-id="{{ $item->id }}">
        <div class="col-3">
            <img src="{{ asset($item->attributes->avatar) }}" alt="" width="100%">
        </div>
        <div class="d-flex flex-column col-8">
            <h5 class="font-weight-bold">{{ $item->name }}</h5>
            <div class="d-flex">
                <div class="col-4 item-quantity">
                    <input type="number" class="form-control" name="item_quantity" placeholder="Số lượng" min="1"
                        value="{{ $item->quantity }}">
                </div>
                <div class="col-8 pr-0 item-size">
                    <select name="item_size" class="form-control">
                        <option value="M">M - {{ number_format($item->attributes->price) }} $</option>
                        @if($item->attributes->price_large != null)
                        <option {{ selected($item->attributes->size, 'L') }} value="L">L - {{ number_format($item->attributes->price_large) }} $</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="col-1 pl-0 text-right">
            <button class="delete-item-cart btn btn-sm btn-outline-danger" data-route="{{ route('delete.cart', $item->id) }}"><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-warning">
            <h5 class="text-center">Nothing in cart</h5>
        </div>
    </div>
    @endforelse
    @if(count($cartItems) > 0)
    <div class="row">
        <div class="col">
            <form id="formOrder" action="{{ route('store.order.user') }}" method="post">
                @csrf
                <div class="form-group">
                    <textarea name="note" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Note ..."></textarea>
                  </div>
                <button type="submit" class="btn btn-block btn-success">Order</button>
            </form>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col">
        <a class="btn btn-block btn-success">Order</a>
        </div>
    </div>
    @endif
</div>
<form id="formUpdateCart" action="{{ route('update.cart') }}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="id">
    <input type="hidden" name="quantity">
    <input type="hidden" name="size">
</form>
<form id="formDeleteItemCart" action="" method="post">
    @csrf
    @method('DELETE')
</form>
@endsection