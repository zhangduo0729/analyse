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
                    <div class="panel-heading">{{ __('软件') }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">操作系统</div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            @foreach($oses as $os=>$logs)
                                            <li class="list-group-item">{{ $os }} {{ count($logs) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ __('浏览器') }}</div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            @foreach($browsers as $browser=>$logs)
                                            <li class="list-group-item">{{ $browser }} {{ count($logs) }}</li>
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
