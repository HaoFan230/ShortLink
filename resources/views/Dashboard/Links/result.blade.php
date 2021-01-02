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
                <p class="lead"><span style="display:inline-block;width:150px;">关键字:</span><span>{{ $linkInfo['shortkey'] }}</span></p>
                <p class="lead"><span style="display:inline-block;width:150px;">目标URL:</span><a href="">{{ $linkInfo['url'] }}</a></p>
                <p class="lead"><span style="display:inline-block;width:150px;">过期时间:</span><span>{{ $linkInfo['expiratime'] ?? '无' }}</span></p>
                <p class="lead"><span style="display:inline-block;width:150px;">类型:</span><span>{{ $linkInfo['type'] == 'longterm' ? '长期' :'短期'  }}</span></p>
                <a class="btn btn-primary" href="{{ route('links.index') }}">查看列表</a>
            </div>
        </div>
    </div>
</section>
@endsection