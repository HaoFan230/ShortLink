<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('asserts/bootstrap/css/bootstrap.min.css') }}">
    <title>仪表盘</title>
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

        .rank-number {
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            background: #f3f6f9;
            font-size: 1.2em;
            font-weight: bold;
            border-radius: 4px;
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
</head>
<body>
    <header>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark border-bottom-light py-3">
            <div class="container">
                <a class="navbar-brand" href="#">SHORTLINK</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">仪表盘</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">短链接</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">设置</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <a class="text-light">你好, {{ Auth::user()->name }}</a>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <section class="row text-white">
            <div class="col col-md-12">
                <h1>仪表盘</h1>
                <p class="lead">迅速浏览各项接口情况</p>
            </div>
        </section>
        <section class="row mt-4">
            <div class="col-12 col-sm-12 col-lg-5">
                <div id="statistics" class="card">
                    <div class="card-body">
                        <div class="d-flex align-item-center justify-content-between">
                            <div class="title">
                                <b>全部接口请求数</b>
                                <p class="text-secondary mt-1"><span class="mr-1">135,125</span>例</p>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    切换
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">全部统计</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="">月统计</a>
                                    <a class="dropdown-item" href="">周统计</a>
                                    <a class="dropdown-item" href="">日统计</a>
                                </div>
                            </div>
                        </div>
                        <div style="height:150px;">
                            <!-- 这里放图表 -->
                        </div>
                        <div id="ranking-list">
                            <div class="d-flex mb-4 justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="rank-number">1</span>
                                    <div class="ml-3">
                                        <b>百度</b>
                                        <a href=""><p class="mb-0">https://www.baidu.com</p></a>                                    
                                    </div>
                                </div>
                                <button class="btn bg-light text-muted">+<b>100000</b></button>
                            </div>
                            <div class="d-flex mb-4 justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="rank-number">2</span>
                                    <div class="ml-3">
                                        <b>微博</b>
                                        <a href=""><p class="mb-0">https://www.weibo.com</p></a>                                    
                                    </div>
                                </div>
                                <button class="btn bg-light text-muted">+<b>10000</b></button>
                            </div>
                            <div class="d-flex mb-4 justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="rank-number">3</span>
                                    <div class="ml-3">
                                        <b>Bilibili</b>
                                        <a href=""><p class="mb-0">https://www.bilibili.com</p></a>                                    
                                    </div>
                                </div>
                                <button class="btn bg-light text-muted">+<b>1000</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-7 d-flex flex-column justify-content-between">
                <div class="row">
                    <div class="col col-md-4">
                        <div class="card h-150">
                            <div class="card-body">
                                <h4>其他属性</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-8">
                        <div class="card h-150">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h4>新短链接</h4>
                                    <p>迅速创建，快速使用新短链接</p>
                                </div>
                                <button class="btn btn-info">创建</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-6">
                        <div class="row">
                            <div class="col col-md-12">
                                <div class="card h-150 mb-3">
                                    <div class="card-body">
                                        <h4>修改设置</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <div class="card h-150">
                                    <div class="card-body">
                                        <h4>链接数</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="card h-150">
                                    <div class="card-body">
                                        <h4>API调用</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="card h-full">
                            <div class="card-body">
                                <h4>个人情况</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <footer>
        <div class="container py-3">
            <p class="mb-0">Copyright &copy; 2020 - ShortLink. All rights reserved</p>
        </div>
    </footer>
    <script src="{{ asset('asserts/jquery.min.js') }}"></script>
    <script src="{{ asset('asserts/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>