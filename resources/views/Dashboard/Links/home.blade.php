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
                        <p class="text-secondary mt-1">共计 <span class="mr-1">135</span>例</p>
                    </div>
                    <div>
                        <button class="btn btn-light text-primary mr-2"><i class="fa fa-save mr-1"></i>导出</button>
                        <a class="btn btn-primary" href="{{ route('links.create') }}"><i class="fa fa-angle-right mr-1"></i>创建新连接</a>
                    </div>
                </div>
                <form action="{{ route('links.index') }}" class="form-inline">
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
                <table class="table mt-4">
                    <thead>
                        <tr class="text-secondary">
                            <th><input type="checkbox"></th>
                            <th>ID</th>
                            <th>目标URL</th>
                            <th>创建时间</th>
                            <th>过期时间</th>
                            <th>状态</th>
                            <th>类型</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>61SDW7TV</td>
                            <td><a href="">https://www.baidu.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-success">生效</span></td>
                            <td><span class="badge badge-success">长期</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>VNL2KLSJD</td>
                            <td><a href="">https://www.weibo.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-success">生效</span></td>
                            <td><span class="badge badge-primary">长期</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>SJFLK1NZ1</td>
                            <td><a href="">https://www.juejin.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-danger">失效</span></td>
                            <td><span class="badge badge-secondary">时效</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>61SDW7TV</td>
                            <td><a href="">https://www.baidu.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-success">生效</span></td>
                            <td><span class="badge badge-success">长期</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>VNL2KLSJD</td>
                            <td><a href="">https://www.weibo.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-success">生效</span></td>
                            <td><span class="badge badge-primary">长期</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>SJFLK1NZ1</td>
                            <td><a href="">https://www.juejin.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-danger">失效</span></td>
                            <td><span class="badge badge-secondary">时效</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>61SDW7TV</td>
                            <td><a href="">https://www.baidu.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-success">生效</span></td>
                            <td><span class="badge badge-success">长期</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>VNL2KLSJD</td>
                            <td><a href="">https://www.weibo.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-success">生效</span></td>
                            <td><span class="badge badge-primary">长期</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>SJFLK1NZ1</td>
                            <td><a href="">https://www.juejin.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-danger">失效</span></td>
                            <td><span class="badge badge-secondary">时效</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>61SDW7TV</td>
                            <td><a href="">https://www.baidu.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-success">生效</span></td>
                            <td><span class="badge badge-success">长期</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>VNL2KLSJD</td>
                            <td><a href="">https://www.weibo.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-success">生效</span></td>
                            <td><span class="badge badge-primary">长期</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>SJFLK1NZ1</td>
                            <td><a href="">https://www.juejin.com</a></td>
                            <td>2020-12-31 14:00:00</td>
                            <td>2020-12-31 15:00:00</td>
                            <td><span class="badge badge-danger">失效</span></td>
                            <td><span class="badge badge-secondary">时效</span></td>
                            <td>
                                <i class="fa fa-cog mr-2" style="cursor:pointer;"></i>
                                <i class="fa fa-trash-o" style="cursor:pointer;"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex align-items-center justify-content-between">
                    <ul class="pagination">
                        <li class="page-item"><a href="" class="page-link"><i class="fa fa-angle-double-left"></i></a></li>
                        <li class="page-item"><a href="" class="page-link"><i class="fa fa-angle-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item active"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a href="" class="page-link"><i class="fa fa-angle-right"></i></a></li>
                        <li class="page-item"><a href="" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                    <div class="form-group form-inline">
                        <select name="page-number" class="form-control mr-3" style="width:80px;">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30" selected>30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="text-secondaryw">显示 1 - 30数据，共计 1000 条数据</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection