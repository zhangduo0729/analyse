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
                    <div class="panel-heading">{{ __('搜索引擎和关键词') }}</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>搜索引擎</th>
                                <th>域名</th>
                            </tr>
                            @foreach($engines as $engine)
                                <tr>
                                    <td>{{ $engine->name }}</td>
                                    <td>{{ $engine->domain }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
