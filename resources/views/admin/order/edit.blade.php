@extends('admin.layouts.master')

@section('title', 'Xem đơn hàng')
@push('css')
<link rel="stylesheet" href="{{ asset('public/lib/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
@endpush
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <form id="formEdit" action="{{ route('update.order') }}" method="post" data-parsley-validate>
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $order->id }}">
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Xem đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-9 form-group">
                                <label for="">Chọn bàn</label>
                                <select name="user_id" class="select2 form-control" required
                                    data-parsley-required-message="Trường này không được bỏ trống.">
                                    <option value="">Vui lòng chọn bàn</option>
                                    @foreach($users as $value)
                                    <option {{ selected( $value->id, $order->user_id) }} value="{{ $value->id }}">{{ $value->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label for="">Trạng thái</label>
                                <select name="status" class="form-control" required
                                    data-parsley-required-message="Trường này không được bỏ trống.">
                                    <option value="0">Chưa xử lý</option>
                                    <option {{ selected( 1, $order->status) }} value="1">Đang xử lý</option>
                                    <option {{ selected( 2, $order->status) }} value="2">Hoàn thành</option>
                                </select>
                            </div>
                        </div>

                        <table class="product-order table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Tên món ăn</th>
                                    <th scope="col" style="width:100px">Số lượng</th>
                                    <th scope="col" style="width:200px">Giá tiền</th>
                                    <th scope="col" style="width:75px">đơn vị</th>
                                    <th scope="col">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="default">
                                    @foreach($order->details as $item)
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->option.' - '.number_format($item->price).config('mevivu.currency') }}</td>
                                    <td>{{ $item->quantity_item.' '.config('mevivu.unit')[$item->unit] }}</td>
                                    <td>{{ number_format($item->price * $item->quantity).config('mevivu.currency') }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">Tổng cộng</th>
                                    <th class="total-order">{{ number_format($order->total).config('mevivu.currency') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="form-group">
                            <textarea name="note" class="form-control" id="exampleFormControlTextarea1" rows="3" >{{ $order->note }}</textarea>
                          </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <button type="submit" class="btn btn-warning">Sửa</button>
                        <button type="button" data-target="#formDelete" class="submit-form btn btn-danger">Xóa</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
<form id="formDelete" action="{{route('delete.order', $order->id)}}" method="post">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('plugin-js')

<script src="{{ asset('public/lib/select2/dist/js/select2.min.js') }}"></script>


@endpush

@push('js')

<script src="{{ asset('public/admin/js/order.js') }}"></script>

@endpush