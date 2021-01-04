@extends('layout.app')


@section('style')
<style>
    .table th {
        border-top-width: 0px;   
    }
</style>
@endsection

@section('content')
<section class="row mt-4">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">设置</h4>
                <form action="{{ route('links.store') }}" method="post" class="form">
                    @csrf()
                    <div class="form-group mr-4">
                        <label for="" class="mr-2">修改用户名: </label>
                        <input 
                            type="text" 
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                            name="name" 
                            value="{{ Auth::user()->name }}" 
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('target') }}
                        </div>
                    </div>
                    <div class="form-group mr-4">
                        <label for="" class="mr-2">更新AccessToken: </label>
                        <input 
                            type="text" 
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                            name="name" 
                            value="{{ Auth::user()->accessToken }}" 
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('target') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary mt-3">点击创建</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection