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
                    <div class="panel-heading">{{ __('访客日志') }}</div>
                    <div class="panel-body">
                        @foreach($visitsLogs as $visitLog)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div>{{ __('访问时间') }} {{ $visitLog->created_at }}</div>
                                    <div>{{ __('IP') }} {{ long2ip($visitLog->ip) }}</div>
                                    <div>{{ __('地址') }} {{ $visitLog->addr() }}</div>
                                    <div>{{ __('来源') }} {{ $visitLog->referrer ?: '直接访问' }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{
                            $visitsLogs
                            ->appends([
                                'site_id'=> Request()->get('site_id') ? Request()->get('site_id') : '',
                                'start_time'=> Request()->get('start_time') ? Request()->get('start_time') : '',
                                'end_time'=> Request()->get('end_time') ? Request()->get('end_time') : '',
                            ])
                            ->links()
                        }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
