@extends('admin.layouts.master')

@section('title', 'Sửa bàn')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Sửa bàn</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('update.user') }}" method="post" data-parsley-validate>
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="col-md-12 control-label">Mã bàn:</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" value="{{ $user->name }}" name="name" placeholder="Mã bàn" required 
                                            data-parsley-required-message="Trường này không được bỏ trống.">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="col-lg-12 control-label">Tên bàn:</label>
                                    <div class="col-lg-12">
                                        <input class="form-control" type="text" name="fullname"
                                            value="{{ $user->fullname }}" placeholder="Tên bàn" required
                                            data-parsley-required-message="Trường này không được bỏ trống.">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 control-label"></label>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning">Sửa
                                </button>
                                <button type="button" class="submit-form btn btn-danger" data-target="#formDelete">Xóa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="formDelete" action="{{route('delete.user', $user->id)}}" method="post">
    @csrf
    @method('DELETE')
</form>
@endsection