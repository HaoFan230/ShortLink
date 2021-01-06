@extends('layout.app')


@section('style')
<style>
    .table th {
        border-top-width: 0px;   
    }
    .hide { display:none; }
</style>
@endsection

@section('content')
<section class="row mt-4">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="info-tab" data-toggle="pill" href="#info" role="tab">个人信息</a>
                            <a class="nav-link" id="developer-tab" data-toggle="pill" href="#developer" role="tab">开发者设置</a>
                            <a class="nav-link" id="other-tab" data-toggle="pill" href="#other" role="tab">其他设置</a>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="form-group">
                                    <label for="">登录邮箱</label>
                                    <p class="lead">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">用户名</label>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <span class="lead" style="width:100px;">{{ Auth::user()->name }}</span>
                                        <button  class="btn btn-primary btn-sm ml-4" data-target="#update-name-modal" data-toggle="modal">修改用户名</button>
                                    </div>
                                    @if($errors->has('name'))
                                    <span class="mt-3 text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">密码</label>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <span class="lead" style="width:100px;">********</span>
                                        <button  class="btn btn-primary btn-sm ml-4" data-target="#update-password-modal" data-toggle="modal">修改密码</button>
                                    </div>
                                    @if($errors->has('password'))
                                    <span class="mt-3 text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">加入时间</label>
                                    <p class="lead">{{ Auth::user()->created_at }}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="developer" role="tabpanel">
                                <form action="{{ route('people.update',Auth::user()->name) }}" method="POST">
                                    @csrf()
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="">AccessToken</label>
                                        <input type="text" readonly name="access_token" class="form-control" value="{{ Auth::user()->access_token }}">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">更新AccessToken</button>
                                    </div>
                                    @if($errors->has('access_token'))
                                    <span class="mt-3 text-danger">{{ $errors->first('access_token') }}</span>
                                    @endif
                                </form>
                            </div>
                            <div class="tab-pane fade" id="other" role="tabpanel">
                                <div class="form-group">
                                    <p class="lead">暂未开通,请到别处看看吧</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 模态框 -->
<div class="modal fade" id='update-name-modal'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('people.update',Auth::user()->name) }}" method="POST">
                    @csrf()
                    @method('PATCH')
                    <div class="form-group">
                        <label for="" class="lead">修改用户名</label>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="请输入新的用户名">
                    </div>
                    <div class="form-group">
                       <button class="btn btn-primary">修改</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id='update-password-modal'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('people.update',Auth::user()->name) }}" method="POST">
                    @csrf()
                    @method('PATCH')
                    <p class="lead">修改密码</p>
                    <div class="form-group">
                        <label for="">新密码</label>
                        <input type="password" class="form-control" name="password" placeholder="请输入新的密码">
                    </div>
                    <div class="form-group">
                        <label for="">再次确认</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="再次输入">
                    </div>
                    <div class="form-group">
                       <button class="btn btn-primary">修改</button>
                    </div>
                </form>
            </div>
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

@endsection

@section('script')

@if(old('success'))
<script>window.onload = e => { $('.toast').toast('show') } </script>
@endif

@endsection