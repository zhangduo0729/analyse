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
                    <div class="panel-heading">{{ __('访客概览') }}</div>
                    <table class="table">
                        <tr>
                            <td>{{ $visitCount }} {{ __('访问次数') }}</td>
                            <td>{{ $pvCount }} {{ __('页面访问次数') }}</td>
                        </tr>
                        <tr>
                            <td>{{ $avgResidenceTime }}s {{ __('访问平均停留时间') }}</td>
                            <td>{{ $queryCount }} {{ __('站内搜索数') }}</td>
                        </tr>
                        <tr>
                            <td>{{ $bounceRate }} {{ __('跳出次数') }}</td>
                            <td>{{ $keywordsCount }} {{ __('关键词数量') }}</td>
                            {{--<td>{{ __('下载次数') }}, {{ __('唯一下载次数') }}</td>--}}
                        </tr>
                        <tr>
                            <td>{{ $uniquePageClicksCount }} {{ __('唯一页面浏览量') }}</td>
                            <td></td>
                        </tr>
                        {{--<tr>--}}
                            {{--<td>{{ __('每个访客行为数') }}</td>--}}
                            {{--<td>{{ __('离站链接数量') }}, {{ __('唯一离站链接数量') }}</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>{{ __('平均生成时间') }}</td>--}}
                            {{--<td>{{ __('单次访问的最大活动量') }}</td>--}}
                        {{--</tr>--}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
