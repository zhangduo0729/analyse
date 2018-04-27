<div class="panel panel-default">
    <div class="panel-heading">{{ __('访客概览') }}</div>
    <ul class="list-group">
        <li class="list-group-item">{{ $clicksCount }} {{ __('浏览量') }}，{{ $uniqueVisitorsCount }} {{ __('独立访客') }}</li>
        <li class="list-group-item">{{ $uniquePageClicksCount }} {{ __('唯一页面浏览量') }}</li>
        <li class="list-group-item">{{ $visitCount }} {{ __('访问次数') }}</li>
        <li class="list-group-item">{{ $bounceRate }} {{ __('页面跳出率') }}</li>
    </ul>
</div>