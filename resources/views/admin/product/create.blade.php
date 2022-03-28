@extends('admin.layouts.master')

@section('title', 'Thêm món ăn')
@push('css')
<link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
@endpush
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <form id="formAdd" action="{{ route('store.product') }}" method="post" data-parsley-validate>
        @csrf
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Thêm món ăn</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 col-md-9 form-group">
                                <label for="">Tên món ăn</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nhập tên món ăn"
                                    required data-parsley-required-message="Trường này không được bỏ trống.">
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label for="">Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1">Hiện</option>
                                    <option  value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label for="">Giá:</label>
                                <input type="text" name="price" class="form-control" min="0" placeholder="Giá tiền"
                                    value="{{ old('price') }}" required data-parsley-type="number" 
                                    data-parsley-number-message="Trường này phải là số."
                                    data-parsley-required-message="Trường này không được bỏ trống.">
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="">Giá size lớn <small class="text-danger">(Nếu không có thì để
                                        trống)</small></label>
                                <input type="text" name="price_large" class="form-control" min="0"
                                    placeholder="Giá size lớn" value="{{ old('price_large') }}" data-parsley-type="number" 
                                    data-parsley-gt="input[name='price']"
                                    data-parsley-number-message="Trường này phải là số."
                                    data-parsley-lt-message="Giá size lớn phải lớn hơn giá mặc định.">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label for="">Số lượng trong 1 món:</label>
                                <input type="number" name="quantity" class="form-control" min="0" placeholder="Số lượng trong 1 món" value="{{ old('quantity') }}" required 
                                    data-parsley-number-message="Trường này phải là số." 
                                    data-parsley-required-message="Trường này không được bỏ trống.">
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="">Đơn vị</label>
                                <select name="unit" class="form-control">
                                    @foreach(config('mevivu.unit') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Mô tả món ăn:</label>
                            <textarea name="desc" class="form-control">{{ old('desc') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-block">Thêm</button>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Danh mục món ăn</h4>
                    </div>
                    <div class="card-body">
                        <div class="radio_scroll form-group">
                        @foreach($category as $value)
                        @if ($loop->first)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" checked class="form-check-input" name="category_id" value="{{ $value->id }}">{{ $value->name }}
                            </label>
                        </div>
                        @else
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="category_id" value="{{ $value->id }}">{{ $value->name }}
                            </label>
                        </div>
                        @endif
                        
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Hình đại diện</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control d-none" name="avatar"
                                value="/public/images/default-image.png">
                            <img id="avatar" class="add-image-ckfinder pointer" data-preview="#avatar"
                                data-input="input[name='avatar']" data-type=""
                                src="{{asset('/public/images/default-image.png')}}" alt="" style="width: 100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('plugin-js')

<script src="{{ asset('public/admin/plugins/ckfinder/ckfinder.js') }}"></script>

@endpush

@push('js')

<script src="{{ asset('public/lib/Parsley.js-2.9.2/comparison.js') }}"></script>


@endpush