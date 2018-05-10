@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.setting.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('工具栏') }}</div>
                    <div class="panel-body">
                        <a class="btn btn-success" href="adminSearchEngineCreate">{{ __('添加搜索引擎') }}</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('添加搜索引擎') }}</div>
                    <div class="panel-body">
                        <form action="{{ route('adminSearchEngineStore') }}" class="form" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">{{ __('名称') }}</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="domain">{{ __('域名') }}</label>
                                <input type="text" class="form-control" name="domain" id="domain">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">{{ __('添加') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
