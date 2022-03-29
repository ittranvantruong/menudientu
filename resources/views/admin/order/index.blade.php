@extends('admin.layouts.master')

@section('title', 'Danh sách đơn hàng '.$status)
@push('css')

<link rel="stylesheet" href="{{asset('public/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.css')}}">

@endpush
@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary mb-0">Danh sách đơn hàng {{ $status }}</h6>
            <a href="{{ route('create.order') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                Thêm đơn hàng
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên bàn</th>
                            <th>Món ăn</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $item)
                        <tr>
                            <td>{{optional($item->user)->fullname}}</td>
                            <td>
                                @foreach ($item->details as $detail)
                                <p>{{$detail->name.' x '.$detail->quantity.' - '.$detail->option}}</p>
                                @endforeach
                            </td>
                            <td>{{ number_format($item->total) }} đ</td>
                            <td>{{ config('mevivu.order.status')[$item->status] }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    @if($item->status != 2)
                                    <button type="button" data-target="#formPatchOrder" data-action="{{ route('update.order.status', [$item->id, $item->status + 1]) }}" class="btn-delete btn btn-sm btn-success">
                                        <i class="fas fa-check"></i> Duyệt
                                    </button>
                                    @endif
                                    <a href="{{ route('edit.order', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<form id="formPatchOrder" action="" method="post">
    @csrf
    @method('PATCH')
</form>
@endsection

@push('plugin-js')

<script src="{{asset('public/sbadmin2/vendor/datatables/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('public/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

@endpush

@push('js')

<script>
    $(document).ready(function () {
        customDatatable('.table', [2]);
    });
</script>

@endpush