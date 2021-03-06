<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('asserts/bootstrap/css/bootstrap.min.css') }}">
    <title>登录</title>
    <style>
        .mt-10 {
            margin-top: 5em;
        }
        .alert-custom {
            width: 240px;
            position: fixed !important;
            left: 50%; 
            top: 0px;
            transform: translateX(-50%);
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col col-md-6 offset-md-3">
                <div class="card mt-10">
                    <div class="card-body">
                        <h2 class="mb-3 text-center">SHORTLINK</h2>
                        <form action="{{ route('login.store') }}" method="post">
                            @csrf()
                            <div class="form-group">
                                <label for="">邮箱</label>
                                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">密码</label>
                                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password">
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-secondary">
                                        <input type="checkbox" class="form-check-input" name="remember">记住我
                                    </label>
                                </div>
                                <a href="{{ route('password_reset.index') }}">忘记密码</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">登录</button>
                            </div>
                        </form>
                        <hr>
                        <p class="text-secondary">没有账号? <a href="{{ route('register.index') }}" class="ml-1">注册</a></p>
                    </div>
                </div>
                <p class="text-center mt-3 text-secondary">Copyright &copy; 2020 - ShortLink. All rights reserved</p>
            </div>
        </div>
    </div>
    <div class="toast" style="position: absolute; top: 0; left: 50%; transform:translateX(-50%);" role="alert" data-delay="2000" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">{{ old('success') }}</strong>
            <small>刚刚</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div style="width:240px;"></div>
    </div>

    <script src="{{ asset('asserts/jquery.min.js') }}"></script>
    <script src="{{ asset('asserts/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @if(old('success'))
    <script> $('.toast').toast('show') </script>
    @endif
</body>
</html>