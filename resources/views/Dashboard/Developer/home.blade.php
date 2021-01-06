@extends('layout.app')

@section('content')
<section class="row mt-4">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-create-api-tab" data-toggle="tab" href="#nav-create-api" role="tab">创建短链接</a>
                        <a class="nav-item nav-link" id="nav-select-api-tab" data-toggle="tab" href="#nav-select-api" role="tab">查询短链接</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-create-api" role="tabpanel">暂未开通</div>
                    <div class="tab-pane fade" id="nav-select-api" role="tabpanel">暂未开通</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection