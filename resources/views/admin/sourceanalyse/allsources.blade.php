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
                    <div class="panel-heading">{{ __('所有来源') }}</div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ __('引荐类型') }}</div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>来源类型</th>
                                        <th>访问</th>
                                    </tr>
                                    <tr>
                                        <td>{{ __('直接访问') }}</td>
                                        <td>{{ $directViewCount }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('搜索引擎') }}</td>
                                        <td>{{ $fromEngine }}</td>
                                    </tr>
                                    <tr >
                                        <td>{{ __('网站') }}</td>
                                        <td>{{ $fromSite }}</td>
                                    </tr>
                                </table>
                            </table>
                        </div>
                    </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ __('搜索引擎') }}</div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    @foreach ($engines as $engine=>$sessions)
                                        <tr>
                                            <td> {{ $engine }} </td>
                                            <td>{{ count($sessions) }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ __('网站') }}</div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    @foreach($sites as $site=>$sessions)
                                        <tr>
                                            <td>{{ $site }}</td>
                                            <td>{{ count($sessions) }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
