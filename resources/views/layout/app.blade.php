<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('asserts/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asserts/font-awesome/css/font-awesome.min.css') }}">
    <title>{{ $pageInfo['title'] }}</title> 
    <style>
        header::before {
            content: '';
            position: absolute;
            z-index: -1;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 330px;
            background: #007bff;
        }
        
        .border-bottom-light {
            border-bottom: 1px solid #ffffff66;
        }

        .h-150 {
            height: 150px;
        }

        .h-full {
            height: 100%;
        }

        body {
            background: #eef0f8;
        }

        button > b {
            display: inline-block;
            vertical-align: top;
        }

        footer {
            background: white;
            position: absolute;
            left: 0px;
            bottom: 0px;
            width: 100%;
        }
    </style>

    <!-- 这里引入各个组件里的style部分 -->
    @yield('style')

</head>
<body>
    <header>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark border-bottom-light py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home.index') }}">SHORTLINK</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home.index') }}">仪表盘</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('links.index') }}">短链接</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">开发者工具</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                你好，{{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('people.edit',Auth::user()->name) }}">个人设置</a>
                                <form action="{{ route('logout.store') }}" method="post">
                                    @csrf()
                                    <button class="dropdown-item">账户登出</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main class="container mt-5">
        <section class="row text-white align-items-center">
            <div class="col-8">
                <h1>{{ $pageInfo['title'] }}</h1>
                <p class="lead">{{ $pageInfo['description'] }}</p>
            </div>
            @if($showBackButton)
            <div class="col-4 d-flex justify-content-end">
                <a class="btn bg-white text-primary font-weight-bold" href="{{ url()->previous() }}">返回上一页</a>
            </div>
            @endif
        </section>

        <!-- 这里引入各个组件里的content部分 -->
        @yield('content')
    </main>
    
    <footer class="mt-5" id='footer'>
        <div class="container py-3">
            <p class="mb-0">Copyright &copy; 2020 - ShortLink. All rights reserved</p>
        </div>
    </footer>

    @yield('script')

    <script>
        //判断当前页面，并添加active类至导航菜单 
        (function() {
            const links = document.querySelectorAll('.nav-link');
            const key = '<?= $pageInfo['title'] ?>';
            [...links].find(el=>el.textContent == key)?.classList.add('active');
        })();

        //判断footer的position是啥属性 
        (function() {
            const flag = document.body.offsetHeight > window.screen.availHeight;
            const footer = document.querySelector('#footer');
            flag && (footer.style.position = "relative");
        })();
    </script>

    <script src="{{ asset('asserts/jquery.min.js') }}"></script>
    <script src="{{ asset('asserts/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>