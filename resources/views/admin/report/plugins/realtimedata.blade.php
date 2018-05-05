<div class="panel panel-default">
    <div class="panel-heading">{{ __('实时访客') }}</div>
    <ul class="list-group">
        @foreach($logs as $log)
        <li class="list-group-item">
            <div>访问时间： {{ $log->created_at }}</div>
            <div>访问地点： {{ $log->addr() }}</div>
            <div>ip: {{ long2ip($log->ip) }}</div>
            <div>来源： {{ $log->referrer ?: '直接访问' }}</div>
            <div>{{ __('访问地址') }}: {{ $log->href }}</div>
            <div>{{ __('页面标题') }}: {{ $log->title }}</div>
        </li>
        @endforeach
    </ul>
</div>