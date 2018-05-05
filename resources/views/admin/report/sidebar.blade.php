<ul class="list-group">
    <li class="list-group-item">
        <a href="{{ route('adminReportIndex') }}">报表面板</a>
    </li>
    <li class="list-group-item">
        <a>访客分析</a>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('adminClientAnalyseIndex') }}">概览</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminClientLog') }}">访客日志</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminClientDevice') }}">设备</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminClientSoftware') }}">{{ __('软件') }}</a>
            </li>
        </ul>
    </li>
    <li class="list-group-item">
        <a>{{ __('页面分析') }}</a>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalyseIndex') }}">{{ __('页面') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalyseEnterPage') }}">{{ __('进入页面') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalyseQuitPage') }}">{{ __('退出页面') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalysePageTitle') }}">{{ __('页面标题') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalyseSearch') }}">{{ __('站内搜索') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalyseLeaveLink') }}">{{ __('离站链接数量') }}</a>
            </li>
        </ul>
    </li>
    <li class="list-group-item">
        <a>{{ __('来源分析') }}</a>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('adminSourceAnalyseIndex') }}">{{ __('概览') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminSourceAnalyseAllSources') }}">{{ __('所有来源') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminSourceAnalyseSearchEngine') }}">{{ __('搜索引擎和关键词') }}</a>
            </li>
        </ul>
    </li>
</ul>