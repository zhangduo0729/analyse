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
                    <div class="panel-heading">{{ __('报表面板') }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                @include('admin.report.plugins.overview')
                            </div>
                            <div class="col-md-6">
                                @include('admin.report.plugins.realtimedata')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
