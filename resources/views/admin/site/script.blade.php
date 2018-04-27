@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.setting.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('站点跟踪代码') }}</div>
                    <div class="panel-body">
                        <pre>
{{ $site->script() }}
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
