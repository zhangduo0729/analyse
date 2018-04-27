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
                        <form action="{{ route('adminSiteStore') }}" method="POST" class="form" role="form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="control-label">{{ __('站点名称') }}</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="host" class="control-label">{{ __('站点域名') }}</label>
                                <textarea name="host" id="host" class="form-control"></textarea>
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
