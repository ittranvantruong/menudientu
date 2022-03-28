<div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
        <h3>Tài khoản phụ</h3>
        <button type="button" class="open-modal add-user-secondary btn btn-sm btn-primary"
            data-target="#customerSecondary" data-method="POST" data-action="{{ route('store.user.secondary') }}">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i>
            Thêm tài khoản phụ
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Số điện thoại</th>
                        <th>Mối quan hệ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->user_secondary as $item)
                    <tr>
                        <td>#{{$item->id}}</td>
                        <td>{{optional($item->user_info)->fullname}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{optional($item->user_info)->relationship}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="open-modal edit-user-secondary btn btn-sm btn-warning"
                                    data-target="#customerSecondary" data-method="PUT"
                                    data-url="{{ route('edit.user.secondary', $item->id) }}" 
                                    data-action="{{ route('update.user.secondary') }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="delete-user-secondary btn btn-sm btn-danger" data-target="#deleteUserSecondary" 
                                    data-action="{{ route('delete.user.secondary', $item->id) }}">
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
<form id="deleteUserSecondary" action="" method="post">
    @csrf
    @method('DELETE')
</form>
<div id="customerSecondary" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Thêm tài khoản phụ</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" data-parsley-validate>
                    @csrf
                    @method('POST')
                    <input type="hidden" name="addedby" value="{{ $user->id }}">
                    <input type="hidden" name="id" value="">
                    <input type="file" class="d-none avatar-user-secondary" data-show=".show-avatar-user-secondary" name="avatar">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-md-4">
                            <div class="devt-box-avatar devt-box-avatar-sm">
                                <img class="show-avatar-user-secondary" src="{{ asset(config('mevivu.images.avatar-user')) }}" class="img-thumbnail"
                                    alt="Avatar" width="100%">
                                <div class="devt-icon-camera">
                                    <i class="fas fa-camera" data-target=".avatar-user-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12 control-label">*Họ và tên:</label>
                        <div class="col-lg-12">
                            <input class="form-control" type="text" name="fullname" value="{{ old('fullname') }}"
                                placeholder="Họ và tên" required
                                data-parsley-required-message="Trường này không được bỏ trống.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12 control-label">*Mối quan hệ:</label>
                        <div class="col-lg-12">
                            <input class="form-control" type="text" name="relationship" value=""
                                placeholder="Mối quan hệ" required
                                data-parsley-required-message="Trường này không được bỏ trống.">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12 control-label">*Số điện thoại:</label>
                        <div class="col-md-12">
                            <input class="form-control" type="text" value="{{ old('phone') }}" name="phone"
                                placeholder="Số điện thoại" data-parsley-pattern="/((09|03|07|08|05)+([0-9]{8})\b)/g"
                                required data-parsley-required-message="Số điện thoại không được để trống."
                                data-parsley-pattern-message="Số điện thoại không hợp lệ.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label">*Mật khẩu:</label>
                        <div class="col-md-12">
                            <input id="passwordSecondary" class="form-control" type="password" value="" name="password"
                                placeholder="Mật khẩu" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12 control-label">*Xác nhận mật khẩu</label>
                        <div class="col-md-12">
                            <input class="form-control" type="password" value="" name="password2"
                                placeholder="Xác nhận mật khẩu" data-parsley-equalto="#passwordSecondary"
                                data-parsley-equalto-message="Mật khẩu không khớp."
                                >
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>