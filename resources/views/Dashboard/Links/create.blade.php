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
                <form action="{{ route('links.store') }}" method="post" class="form form-inline">
                    @csrf()
                    <div class="form-group mr-4">
                        <label for="" class="mr-2">目标URL: </label>
                        <input type="text" class="form-control" placeholder="https://">
                    </div>
                    <div class="form-group mr-4">
                        <label for="" class="mr-2">类型: </label>
                        <select name="type" id="type" style="width:150px;" class="form-control">
                            <option value="longterm">长期</option>
                            <option value="shortterm">短期</option>
                        </select>
                    </div>
                    <div class="form-group mr-4">
                        <label for="" class="mr-2">过期时间: </label>
                        <input type="datetime-local" class="form-control" >
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">创建</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection