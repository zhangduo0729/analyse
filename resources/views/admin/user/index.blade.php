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
                        <a class="btn btn-success" href="{{ route('adminUserCreate') }}">{{ __('添加用户') }}</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('用户列表') }}</div>
                    <table class="table">
                        <tr>
                            <th>{{ __('名称') }}</th>
                            <th>{{ __('邮箱') }}</th>
                            <th>{{ __('操作') }}</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">修改</button>
                                    <a href="{{ route('adminUserEditRole', ['id'=>$user->id]) }}" class="btn btn-sm btn-primary">分配角色</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="document.getElementById('destroyUserForm{{ $user->id }}').submit()">删除</a>
                                    <form id="destroyUserForm{{ $user->id }}" action="{{ route('adminUserDestroy', ['id'=>$user->id]) }}" method="post" style="display: none;">
                                        <input type="hidden" name="_method" value="delete">
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
