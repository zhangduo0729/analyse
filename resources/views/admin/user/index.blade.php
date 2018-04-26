@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.setting.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('用户列表') }}</div>
                    <div class="card-body">
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
                                        <button class="btn btn-sm">修改</button>
                                        <button class="btn btn-sm">删除</button>
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
