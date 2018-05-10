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
                    <div class="panel-heading">{{ __('所在地') }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ __('大洲') }}</div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>{{ __('大洲') }}</th>
                                                <th>{{ __('访问量') }}</th>
                                            </tr>
                                            @foreach($continents as $continent=>$logs)
                                                <tr>
                                                    <td>{{ $continent }}</td>
                                                    <td>{{ count($logs) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ __('国家') }}</div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>{{ __('国家') }}</th>
                                                <th>{{ __('访问量') }}</th>
                                            </tr>
                                            @foreach($countries as $country=>$logs)
                                                <tr>
                                                    <td>{{ $country }}</td>
                                                    <td>{{ count($logs) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ __('地区') }}</div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>{{ __('地区') }}</th>
                                                <th>{{ __('访问量') }}</th>
                                            </tr>
                                            @foreach($provinces as $province=>$logs)
                                                <tr>
                                                    <td>{{ $province }}</td>
                                                    <td>{{ count($logs) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{ __('城市') }}</div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>{{ __('城市') }}</th>
                                                <th>{{ __('访问量') }}</th>
                                            </tr>
                                            @foreach($cities as $city=>$logs)
                                                <tr>
                                                    <td>{{ $city }}</td>
                                                    <td>{{ count($logs) }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
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
