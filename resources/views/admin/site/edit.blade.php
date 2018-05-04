@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.setting.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ route('adminSiteIndex') }}" class="btn btn-primary">{{ __('站点列表') }}</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        添加站点
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('adminSiteUpdate', ['id'=> $site->id]) }}" method="POST" class="form" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label for="name" class="control-label">{{ __('站点名称') }}</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $site->name }}">
                            </div>
                            <div class="form-group">
                                <label for="host" class="control-label">{{ __('站点域名') }}</label>
                                <textarea name="host" id="host" class="form-control">{!! $site->host !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="query" class="control-label">{{ __('站内查询参数') }}</label>
                                <input type="text" class="form-control" name="query" id="query" value="{{ $site->query }}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">{{ __('修改站点信息') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
