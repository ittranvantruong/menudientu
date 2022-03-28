@extends('admin.layouts.master')

@section('title', 'Thêm đơn hàng')
@push('css')
<link rel="stylesheet" href="{{ asset('public/lib/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
@endpush
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <form id="formAdd" action="{{ route('store.order') }}" method="post" data-parsley-validate>
        @csrf
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Thêm đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Chọn bàn</label>
                            <select name="user_id" class="select2 form-control" required
                                data-parsley-required-message="Trường này không được bỏ trống.">
                                <option value="">Vui lòng chọn bàn</option>
                                @foreach($users as $value)
                                <option value="{{ $value->id }}">{{ $value->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row form-group">
                            <div class="col-10">
                                <select name="product[]" data-route="{{ route('get.product.order') }}" data-preview="table.product-order tbody" class="form-control select2" data-placeholder="---Chọn món ăn---"
                                    multiple required data-parsley-required-message="Trường này không được bỏ trống.">
                                    <option value="">---Chọn món ăn---</option>
                                    @foreach($products as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 text-right">
                                <button class="btn btn-primary" type="button" id="choosProduct" data-target="select[name='product[]']">Chọn</button>
                            </div>
                        </div>

                        <table class="product-order table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Tên món ăn</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Giá tiền</th>
                                    <th scope="col">đơn vị</th>
                                    <th scope="col">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">Tổng cộng</th>
                                    <th class="total-order">0đ</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-block">Thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('plugin-js')

<script src="{{ asset('public/lib/select2/dist/js/select2.min.js') }}"></script>


@endpush

@push('js')

<script src="{{ asset('public/admin/js/order.js') }}"></script>

@endpush