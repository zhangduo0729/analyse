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
                        <a class="btn btn-success" href="{{ route('adminUserIndex') }}">{{ __('角色列表') }}</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('分配权限') }}</div>
                    <div class="panel-body">
                        <form action="{{ route('adminRoleUpdatePermission', ['id'=>$id]) }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                @foreach($permissions as $permission)
                                    <input type="checkbox" name="permission_id[]" value="{{ $permission->id }}" @if($permission->checked) checked @endif> {{ $permission->remark }}
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">{{ __('提交') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
