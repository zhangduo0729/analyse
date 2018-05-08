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
                    <div class="panel-heading">{{ __('退出页面') }}</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>{{ __('退出页面') }}</th>
                                <th>{{ __('退出页') }}</th>
                                <th>{{ __('唯一页面浏览量') }}</th>
                            </tr>
                            @foreach ($quitPages as $quitPage=>$result)
                            <tr>
                                <td>{{ $quitPage }}</td>
                                <td>{{ count($result['sessions']) }}</td>
                                <td>{{ count($result['uv']) }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
