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
                        <a href="{{ route('adminSiteCreate') }}" class="btn btn-primary">{{ __('添加站点') }}</a>
                    </div>
                </div>
                <div class="panel panel-default">
                <div class="panel-heading">{{ __('站点管理') }}</div>
                    <table class="table">
                        <tr>
                            <th>站点名称</th>
                            <th>操作</th>
                        </tr>
                        @foreach($sites as $site)
                        <tr>
                            <td>{{ $site->name }}</td>
                            <td>
                                <a href="{{ route('adminSiteScript', ['id'=>$site->id]) }}" class="btn btn-primary btn-sm">查看跟踪代码</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
