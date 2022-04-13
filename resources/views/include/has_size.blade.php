@foreach($product as $item1)
<div class="row item">
    <div class="col-12 mb-1">
        <div class="row align-items-center">
            <div class="col-4">
                <img src="{{asset($item1->avatar)}}" width="100%">
            </div>
            <div class="col-8">
                <h5 class="font-weight-bold">{{$item1->name}}</h5>
                <div class="unit">{{$item1->quantity}} {{$item1->unit}}</div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        M - {{number_format($item1->price)}}{{ config('mevivu.currency') }}
                    </span>
                    <span>L - {{number_format($item1->price_large)}}{{ config('mevivu.currency') }}</span></div>

            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row justify-content-between">
            <div class="col-6 desc">{{$item1->desc}}</div>
            <div class="col-6 text-right">
                <button value="button" data-route="{{ route('get.product.cart', $item1->id) }}" class="add-to-cart btn btn-sm btn-primary"><i
                        class="fas fa-plus-circle fa-sm text-white-50"></i>
                        {{ __('layout.addToCart') }}</button>
            </div>
        </div>
    </div>
</div>
@endforeach