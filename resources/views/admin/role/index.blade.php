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
                        <a href="{{ route('adminRoleCreate') }}" class="btn btn-success">{{ __('添加角色') }}</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('角色管理') }}</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>{{ __('角色名称') }}</th>
                                <th>{{ __('操作') }}</th>
                            </tr>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if($role->id != 1)
                                        <a href="{{ route('adminRoleEditPermission', ['id'=>$role->id]) }}" class="btn btn-sm btn-primary">分配权限</a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="del(function () { document.getElementById('destroyRoleForm{{ $role->id }}').submit() })">删除</a>
                                        <form id="destroyRoleForm{{ $role->id }}" action="{{ route('adminRoleDestroy', ['id'=>$role->id]) }}" method="post" style="display: none;">
                                            <input type="hidden" name="_method" value="delete">
                                            {{ csrf_field() }}
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
