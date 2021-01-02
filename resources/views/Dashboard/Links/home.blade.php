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
                <div class="d-flex justify-content-between align-items-center">
                    <div class="title">
                        <b>全部链接列表</b>
                        <p class="text-secondary mt-1">共计 <span class="mr-1">{{ $linkList->total() }}</span>例</p>
                    </div>
                    <div>
                        <button class="btn btn-light text-primary mr-2"><i class="fa fa-save mr-1"></i>导出</button>
                        <a class="btn btn-primary" href="{{ route('links.create') }}"><i class="fa fa-angle-right mr-1"></i>创建新连接</a>
                    </div>
                </div>
                <form action="{{ route('links.index') }}" class="form form-inline">
                    <div class="input-group mr-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="搜索 ...">
                    </div>
                    <div class="form-group mr-4">
                        <label for="status" class="mr-2">状态: </label>
                        <select name="status" id="status" style="width:160px;" class="form-control">
                            <option value="all">全部</option>
                            <option value="valid">生效</option>
                            <option value="invalid">失效</option>
                        </select>
                    </div>
                    <div class="form-group mr-4">
                        <label for="type" class="mr-2">类型: </label>
                        <select name="type" id="type" style="width:160px;" class="form-control">
                            <option value="all">全部</option>
                            <option value="longterm">长期</option>
                            <option value="shortterm">时效</option>
                        </select>
                    </div>
                    <div class="form-group mr-4">
                        <button class="btn btn-light text-primary"><i class="fa fa-search mr-1"></i>搜索一下</button>
                    </div>
                </form>
                @if(count($linkList) > 0)
                <div class="table-responsive">
                    <table class="table mt-4">
                        <thead>
                            <tr class="text-secondary">
                                <th><input type="checkbox"></th>
                                <th>关键字</th>
                                <th>目标URL</th>
                                <th>创建时间</th>
                                <th>过期时间</th>
                                <th>状态</th>
                                <th>类型</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($linkList as $link)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>{{ $link->shortkey }}</td>
                                <!-- URL过长要截取 -->
                                <td><a href="{{ $link->url }}">{{ substr($link->url,0,30).'...' }}</a></td>
                                <td>{{ $link->created_at }}</td>
                                <td>{{ $link->expiratime ?? '无' }}</td>
                                <td>
                                    <span class="badge {{ $link->status ? 'badge-success' : 'badge-danger' }} ">
                                        {{ $link->status ? '生效' : '失效' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $link->type == 'longterm' ? 'badge-success' : 'badge-warning' }}">
                                        {{ $link->type == 'longterm' ? '长期' : '短期' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('link.show',$link->shortkey) }}" target="_blank"><i class="fa fa-eye mr-2" style="cursor:pointer;"></i></a>
                                    <a href="{{ route('links.edit',$link->shortkey) }}"><i class="fa fa-cog mr-2" style="cursor:pointer;"></i></a>
                                    <form style="display:inline;" action="{{ route('links.update',$link->shortkey) }}" method="POST">
                                        @csrf()
                                        @method('delete')
                                        <i class="fa fa-trash-o text-danger activeSubmit" style="cursor:pointer;"></i>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <hr>
                <p class="lead">未找到短链接，快去创建吧</p>
                @endif
                <div class="d-flex align-items-center justify-content-between">
                    {{ $linkList->links() }}
                    <div class="form-group form-inline">
                        <span class="text-secondaryw">显示 {{ ($linkList->currentPage() -1) * 30 + 1 }} - {{ $linkList->currentPage() * 30 }}数据，共计 {{ $linkList->count() }} 条数据</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    window.onload = e => {
        $('.activeSubmit').click(function() {
            $(this).parent().submit();
        });
    }
</script>
@endsection