@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('操作') }}</div>
                <div class="panel-body">
                    <a href="{{ route('adminSiteCreate') }}" class="btn btn-success">{{ __('添加一个新站点')  }}</a>
                    {{--<input type="date">--}}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('站点列表') }}</div>
                <table class="table table-hover">
                    <tr>
                        <th>{{ __('名称') }}</th>
                        <th>{{ __('访问量') }}</th>
                        <th>{{ __('浏览量') }}</th>
                        <th>{{ __('访客数') }}</th>
                    </tr>
                    @foreach($sites as $site)
                        <tr onclick="window.location.href='{{ route('adminReportIndex', ['site_id' => $site->id]) }}'" style="cursor:pointer;">
                            <td>{{ $site->name }}</td>
                            <td>{{ $site->pvCount() }}</td>
                            <td>{{ $site->access_count() }}</td>
                            <td>{{ $site->access_client_count() }}</td>
                        </tr>
                    @endforeach
                    @if($sites->links())
                    <tr>
                        <td colspan="4">{{ $sites->links() }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
