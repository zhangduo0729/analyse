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
                    <div class="panel-heading">{{ __('概览') }}</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>{{ __('直接访问') }} {{ $directViewCount }}</td>
                                <td>{{ __('来自网站') }} {{ $fromSite }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('搜索引擎') }} {{ $fromEngine }}</td>
                                <td>{{ __('不同的搜索引擎') }} {{ count($searchEngines) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('不同的网站') }} {{ count($sites) }}</td>
                                {{--<td>{{ __('不同的关键词') }}</td>--}}
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
