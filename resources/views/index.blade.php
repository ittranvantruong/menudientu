@extends('layouts.master')
@push('css')

<link rel="stylesheet" href=" {{asset('public/css/index.css')}} " />

@endpush

@section('title', 'Đặt món ngay')
@section('content')

<div class="container">
    <div class="row no-gutters header">
        <div class="col-10 col-sm-10">
            <h3 class="text-white font-weight-bold mb-0">{{ auth()->user()->fullname }}</h3>
        </div>
        <div class="col-2 text-right" >
            <a href="{{ route('index.cart') }}" class="text-white cart">
                <i class="fas fa-shopping-cart"></i><span data-count={{ Cart::getTotalQuantity() }} class="badge badge-light">{{ Cart::getTotalQuantity() }}</span>
            </a>
        </div>
    </div>
    <div class="row no-gutters menu">
        @foreach($categories as $item)
            <h3 class="title"><span>{{ $item->name }}</span></h3>
            <div class="col-12 col-sm-12 items">
            
            @if($item->type == 1)
                @include('include.has_size', ['product' => $item->product])
            @else
                @include('include.no_has_size', ['product' => $item->product])

            @endif
            
            </div>    
        @endforeach
    </div>
</div>