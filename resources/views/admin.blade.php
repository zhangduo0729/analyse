@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('站点列表') }}</div>
                <div class="panel-body">
                    <div><a href="{{ route('adminSiteCreate') }}">{{ __('添加一个新站点') }}</a></div>
                    <table class="table table-hover">
                        <tr>
                            <th>{{ __('名称') }}</th>
                            <th>{{ __('浏览量') }}</th>
                            <th>{{ __('访问量') }}</th>
                        </tr>
                        @foreach($sites as $site)
                            <tr>
                                <td>{{ $site->name }}</td>
                                <td>{{ $site->access_count() }}</td>
                                <td>{{ $site->access_client_count() }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">{{ $sites->links() }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
