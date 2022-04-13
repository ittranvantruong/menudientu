@extends('admin.layouts.master')

@section('title', 'Danh sách Món ăn')
@push('css')

<link rel="stylesheet" href="{{asset('public/admin/css/style.css')}}">

@endpush
@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary mb-0">Danh sách món ăn</h6>
            <a href="{{ route('create.product') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus-circle fa-sm text-white-50"></i> Thêm món ăn</a>
        </div>
        <div class="card-body">
            <form id="formMultiple" action="{{ route('multiple.product') }}" method="post">
                @csrf
                <div class="input-group col-12 col-md-6 ml-auto mb-4">
                    <select class="form-control" name="action" required>
                        <option value="">Chọn hành động</option>
                        <option value="show">Hiện</option>
                        <option value="hidden">Ẩn</option>
                        <option value="delete">Xóa</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Áp dụng</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:30px;"><input type="checkbox" class="check-all"></th>
                                <th>Tên món ăn</th>
                                <th>Giá</th>
                                <th>SL trong món ăn</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $item)
                            <tr>
                                <td><input type="checkbox" class="check-list" name="id[]" value="{{$item->id}}">
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{!! $item->price_large ? 'M-'.number_format($item->price).config('mevivu.currency').' <span class="ml-3"> L-'.number_format($item->price_large).config('mevivu.currency').'</span>' : number_format($item->price).config('mevivu.currency') !!}</td>
                                <td>{{$item->quantity.' '.config('mevivu.unit')[$item->unit]}}</td>
                                <td>{!! status($item->status) !!}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{ route('edit.product', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn-delete btn btn-sm btn-danger"
                                            data-target="#formDeleteService"
                                            data-action="{{ route('delete.product', $item->id) }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

</div>
<form id="formDeleteService" action="" method="post">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('plugin-js')

<!-- <script src="{{asset('public/sbadmin2/vendor/datatables/jquery.dataTables.min.js')}}"></script> -->

<!-- <script src="{{asset('public/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script> -->

@endpush

@push('js')

<script>
    $(document).ready(function () {
        // customDatatable('.table', [5]);
    });
</script>

@endpush