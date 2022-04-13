@extends('layouts.master')
@push('css')

<link rel="stylesheet" href=" {{asset('public/css/index.css')}} " />

@endpush

@section('title', 'Order')
@section('content')

<div id="mySidenav" class="sidenav">
    @foreach ($categories as $item)
        <a href="#{{$item->id}}" class="closeNav">{{$item->name}}</a>    
    @endforeach
</div>

<div class="container " id="main">
    <div class="row no-gutters fixed-top header">
        <div class="col-2">
            <span style="font-size:30px;cursor:pointer;color:white;" id="openNav">&#9776;</span>
        </div>
        <div class="col-8 col-sm-8 text-center">
            <h3 class="text-white font-weight-bold mb-0">{{ auth()->user()->fullname }}</h3>
        </div>
        <div class="col-2 text-right">
            <a href="{{ route('index.cart') }}" class="text-white cart">
                <i class="fas fa-shopping-cart"></i><span data-count={{ Cart::getTotalQuantity() }}
                    class="badge badge-light">{{ Cart::getTotalQuantity() }}</span>
            </a>
        </div>
    </div>
    <div class="row no-gutters menu closeNav" >

        @foreach($categories as $item)
        <h3 class="title" id="{{$item->id}}"><span>{{ $item->name }}</span></h3>
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