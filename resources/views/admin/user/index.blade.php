@extends('admin.layouts.master')

@section('title', 'Danh sách bàn')
@push('css')

<link rel="stylesheet" href="{{asset('public/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.css')}}">

@endpush
@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary mb-0">Danh sách bàn</h6>
            <a href="{{ route('create.user') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                Thêm bàn
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã bàn</th>
                            <th>Tên bàn</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->fullname}}</td>
                            <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{ route('edit.user', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn-delete btn btn-sm btn-danger"
                                            data-target="#formDeleteUser"
                                            data-action="{{ route('delete.user', $item->id) }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
<form id="formDeleteUser" action="" method="post">
    @csrf
    @method('DELETE')
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