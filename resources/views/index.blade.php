@extends('layouts.master')
@push('css')

<link rel="stylesheet" href=" {{asset('public/css/index.css')}} " />

@endpush

@section('title', 'Menu')
@section('content')

<div class="container-fluid">
    <div class="row no-gutters head">
        <div class="col-10 col-sm-10" style="font-weight:bold;font-size: 120%;color: white;">Bàn 1</div>
        <div class="col-1 col-sm-1 fa5 d-flex justify-content-end" >
            <a href="{{ route('cart.customer') }}" style="color: white">
                <i class="fas fa-shopping-cart" href="{{ route('cart.customer') }}"></i>
            </a>
        </div>
    </div>
    <div class="row no-gutters search-bar d-flex justify-content-center">
        <div class="input-group">
            <span class="input-group-text" style="background-color: white;" >
                <i class="fas fa-search" ></i>
            </span>
            <input type="search" class="form-control rounded" placeholder="Tìm kiếm" aria-label="Search"
                aria-describedby="search-addon" />
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