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
                    <div class="panel-heading">{{ __('站内搜索') }}</div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ __('站内搜索关键词') }}</div>
                            <div class="panel-body">
                                <table class="table">
                                    <tr>
                                        <th>关键词</th>
                                        <th>搜索次数</th>
                                    </tr>
                                    @foreach($keywords as $keyword=>$logs)
                                        @if ($keyword)
                                        <tr>
                                            <td>{{ $keyword }}</td>
                                            <td>{{ count($logs) }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
