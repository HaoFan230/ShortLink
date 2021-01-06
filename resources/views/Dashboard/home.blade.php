@extends('layout.app')

@section('style')
<style>
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
</style>
@endsection

@section('content')
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
                        <p class="text-right"><i class="fa fa-info fa-2x mt-5"></i></p>
                    </div>
                </div>
            </div>
            <div class="col col-md-8">
                <div class="card h-150">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h4><i class="fa fa-angle-right mr-1"></i>新短链接</h4>
                            <p>迅速创建，快速使用新短链接</p>
                        </div>
                        <a class="btn btn-primary" href="{{ route('links.create') }}">创建</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8">
                <div class="row">
                    <div class="col col-md-12">
                        <div class="card h-150 mb-3">
                            <div class="card-body">
                                <h4><i class="fa fa-cog mr-1"></i>设置</h4>
                                <p>情况不对劲? 快重新设置选项</p>
                                <a class="btn btn-primary" href="{{ route('people.edit',Auth::user()->name) }}">前往设置</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-6">
                        <div class="card h-150">
                            <div class="card-body">
                                <h4><i class="fa fa-external-link mr-1"></i>链接数</h4>
                                <p class="lead mt-3 font-weight-bold text-primary">{{ $linkCount }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="card h-150">
                            <div class="card-body">
                                <h4><i class="fa fa-code mr-1"></i>外部调用</h4>
                                <p class="lead mt-3 font-weight-bold text-primary">3,000,000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="card h-full">
                    <div class="card-body">
                        <h4><i class="fa fa-user mr-1"></i>个人情况</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection