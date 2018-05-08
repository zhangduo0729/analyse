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
                    <div class="panel-heading">{{ __('页面标题') }}</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>{{ __('页面标题') }}</th>
                                <th>{{ __('浏览次数') }}</th>
                            </tr>
                            @foreach($titles as $title=>$logs)
                            <tr>
                                <td>{{ $title }}</td>
                                <td>{{ count($logs) }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
