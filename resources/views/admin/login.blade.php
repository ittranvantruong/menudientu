<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng nhập mevivu</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('mevivu.images.shortcut-icon')) }}" />
    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('public/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('public/sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/lib/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('public/lib/Parsley.js-2.9.2/style.css') }}" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('public/lib/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('public/lib/Parsley.js-2.9.2/parsley.min.js') }}"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row align-items-center">
                            <div class="col-lg-6 d-none d-lg-block text-center">
                                <img src="{{ asset(config('mevivu.images.logo')) }}" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập quản trị</h1>
                                    </div>

                                    <form action="{{ route('post.login') }}" class="user" method="POST" data-parsley-validate>
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-user" placeholder="Tên đăng nhập" required data-parsley-required-message="Trường này không được bỏ trống.">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" placeholder="Mật khẩu" required data-parsley-required-message="Trường này không được bỏ trống.">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Đăng nhập
                                        </button>
                                    </form>
                                    <hr>
                                    <p class="text-center">Chào mừng bạn đến với hệ thống quản trị!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    @include('admin.layouts.alert')
</body>

</html>