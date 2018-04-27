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
                        <a href="{{ route('adminRoleIndex') }}" class="btn btn-primary">{{ __('角色列表') }}</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('添加角色') }}</div>
                    <div class="panel-body">
                        <form action="{{ route('adminRoleStore') }}" class="form" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="custom-control-label">{{ __('角色名称') }}</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">添加</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
