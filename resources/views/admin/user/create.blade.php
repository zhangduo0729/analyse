@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.setting.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('添加用户') }}</div>
                    <div class="panel-body">
                        <div>
                            <a href="{{ route('adminUserIndex') }}">{{ __('用户列表') }}</a>
                        </div>
                        <div>
                            <form action="{{ route('adminUserStore') }}" class="form" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name" class="control-label">{{ __('姓名') }}</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">{{ __('邮箱') }}</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">{{ __('密码') }}</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="control-label">{{ __('确认密码') }}</label>
                                    <input type="password_confirmation" name="password_confirmation" id="password_confirmation" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">{{ __('添加用户') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
