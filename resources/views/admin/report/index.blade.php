@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.report.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('报表面板') }}</div>
                    <div class="panel-body">
                        dasfsdfasd
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
