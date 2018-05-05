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
                    <div class="panel-heading">{{ __('设备') }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ __('设备类型') }}</div>
                                    <ul class="list-group">
                                        <li class="list-group-item">{{ __('智能手机') }} {{ $count['mobileCount'] }}</li>
                                        <li class="list-group-item">{{ __('平板电脑') }} {{ $count['tabletCount'] }}</li>
                                        <li class="list-group-item">{{ __('桌面') }} {{ $count['desktopCount'] }}</li>
                                        <li class="list-group-item">{{ __('其他') }} {{ $count['otherCount'] }}</li>
                                    </ul>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ __('品牌') }}</div>
                                    <ul class="list-group">
                                        @foreach ($brands as $brand=>$logs)
                                            <li class="list-group-item">{{ $brand }} {{ count($logs) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ __('画面分辨率') }}</div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            @foreach($screens as $screen=>$log_arr)
                                                @if ($screen === '*')
                                                    <li class="list-group-item">未知 {{ count($log_arr) }}</li>
                                                @else
                                                    <li class="list-group-item">{{ $screen }} {{ count($log_arr) }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
