@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.report.partials.condition')
            <div class="col-md-3">
                @include('admin.report.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('进入页面') }}</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>页面地址</th>
                                <th>进入</th>
                                <th>跳出次数</th>
                                <th>跳出率</th>
                            </tr>
                            @foreach($enterPages as $enterPage=>$result)
                            <tr>
                                <td>{{ $enterPage }}</td>
                                <td title="{{ __('从此页面进入的次数') }}">{{ count($result['sessions']) }}</td>
                                <td title="{{ __('从此页面开始并结束的访问次数') }}">{{ count($result['only']) }}</td>
                                <td>{{ round(count($result['only']) / count($result['sessions']) * 100) . '%' }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
