<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('asserts/bootstrap/css/bootstrap.min.css') }}">
    <title>忘记密码</title>
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
                        <p class="lead text-center">忘记密码?</p>
                        <form action="{{ route('password_reset.store') }}" method="post">
                            @csrf()
                            <div class="form-group">
                                <label for="">注册邮箱</label>
                                <input type="text" placeholder="请提供账户邮箱" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">找回</button>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3 text-secondary">Copyright &copy; 2020 - ShortLink. All rights reserved</p>
            </div>
        </div>
    </div>
    <div class="toast" style="position: absolute; top: 0; left: 50%; transform:translateX(-50%);" role="alert" data-delay="2000" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">创建成功</strong>
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