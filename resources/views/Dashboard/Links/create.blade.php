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
                <h4 class="mb-4">创建短链接</h4>
                <form action="{{ route('links.store') }}" method="post" class="form">
                    @csrf()
                    <div class="form-group mr-4">
                        <label for="" class="mr-2">目标URL: </label>
                        <input 
                            type="text" 
                            class="form-control {{ $errors->has('target') ? 'is-invalid' : '' }}" 
                            name="target" 
                            value="{{ old('target') }}" 
                            placeholder="https://"
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('target') }}
                        </div>
                    </div>
                    <div class="form-group mr-4">
                        <label for="" class="mr-2">类型: </label>
                        <select name="type" id="type" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                            <option value="longterm" {{ old('type') == "longterm" ? 'selected' : '' }}>长期</option>
                            <option value="shortterm" {{ old('type') == "shortterm" ? 'selected' : '' }}>短期</option>
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </div>
                    </div>
                    <div class="form-group mr-4">
                        <label for="" class="mr-2">过期时间: </label>
                        <!-- Input datetime-local 控件的Value格式为YYYY-MM-DDThh:ii -->
                        <input 
                            type="datetime-local" 
                            name="expiratime" 
                            min="{{ Date('Y-m-d\TH:i') }}" 
                            value="{{ Date('Y-m-d\TH:i') }}" 
                            class="form-control {{ $errors->has('expiratime') ? 'is-invalid' : '' }}"
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('expiratime') }}
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