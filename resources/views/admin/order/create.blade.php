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
                        <div class="row">
                            <div class="col-12 col-md-9 form-group">
                                <label for="">Chọn bàn</label>
                                <select name="user_id" class="select2 form-control" required
                                    data-parsley-required-message="Trường này không được bỏ trống.">
                                    <option value="">Vui lòng chọn bàn</option>
                                    @foreach($users as $value)
                                    <option value="{{ $value->id }}">{{ $value->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label for="">Trạng thái</label>
                                <select name="status" class="form-control" required
                                    data-parsley-required-message="Trường này không được bỏ trống.">
                                    <option value="0">Chưa xử lý</option>
                                    <option value="1">Đang xử lý</option>
                                    <option value="2">Hoàn thành</option>
                                </select>
                            </div>
                        </div>

                        <table class="product-order table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Tên món ăn</th>
                                    <th scope="col" style="width:100px">Số lượng</th>
                                    <th scope="col" style="width:200px">Giá tiền</th>
                                    <th scope="col" style="width:75px">đơn vị</th>
                                    <th scope="col">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="default">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Tổng cộng</th>
                                    <th class="total-order">0{{ config('mevivu.currency') }}</th>
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
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Danh sách món ăn</h4>
                    </div>
                    <div class="card-body">
                        <input type="text" id="search" class="form-control mb-1" data-target=".product-check"
                            placeholder="Tìm kiếm món ăn...">
                        <div class="radio_scroll form-group">
                            @foreach($products as $value)
                            <div class="form-check product-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="product[]"
                                        value="{{ $value->id }}">{{ $value->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button" id="choosProduct"
                        data-target="input[name='product[]']" data-route="{{ route('get.product.order') }}"
                        data-preview="table.product-order tbody">Chọn</button>
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