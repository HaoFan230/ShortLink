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
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col col-md-6 offset-md-3">
                <div class="card mt-10">
                    <div class="card-body">
                        <h2 class="mb-3 text-center">SHORTLINK</h2>
                        <form action="{{ route('register.store') }}" method="post">
                            @csrf()
                            <div class="form-group">
                                <label for="">邮箱</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="">密码</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label for="">确认密码</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                            <div class="form-group">
                                <p class="text-secondary">已有账号? <a href="{{ route('login.index') }}" class="ml-1">登录</a></p>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block">注册</button>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3 text-secondary">Copyright &copy; 2020 - ShortLink. All rights reserved</p>
            </div>
        </div>
    </div>
</body>
</html>