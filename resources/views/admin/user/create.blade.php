@extends('admin.layouts.master')

@section('title', 'Thêm bàn')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Thêm bàn</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('store.user') }}" method="post" data-parsley-validate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="col-md-12 control-label">Mã bàn:</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" value="{{ old('name') }}" name="name" placeholder="Mã bàn" required 
                                            data-parsley-required-message="Trường này không được bỏ trống.">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="col-lg-12 control-label">Tên bàn:</label>
                                    <div class="col-lg-12">
                                        <input class="form-control" type="text" name="fullname"
                                            value="{{ old('fullname') }}" placeholder="Tên bàn" required
                                            data-parsley-required-message="Trường này không được bỏ trống.">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 control-label"></label>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Thêm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection