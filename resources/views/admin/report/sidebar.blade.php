<ul class="list-group">
    <li class="list-group-item">
        <a href="{{ route('adminReportIndex', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">报表面板</a>
    </li>
    <li class="list-group-item">
        <a>访客分析</a>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('adminClientAnalyseIndex', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">概览</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminClientLog', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">访客日志</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminClientDevice', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">设备</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminClientSoftware', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">{{ __('软件') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminClientAddr', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">{{ __('所在地') }}</a>
            </li>
        </ul>
    </li>
    <li class="list-group-item">
        <a>{{ __('页面分析') }}</a>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalyseIndex', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">{{ __('页面') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalyseEnterPage', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">{{ __('进入页面') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalyseQuitPage', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">{{ __('退出页面') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalysePageTitle', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">{{ __('页面标题') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminPageAnalyseSearch', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">{{ __('站内搜索') }}</a>
            </li>
            {{--<li class="list-group-item">--}}
                {{--<a href="{{ route('adminPageAnalyseLeaveLink') }}">{{ __('离站链接数量') }}</a>--}}
            {{--</li>--}}
        </ul>
    </li>
    <li class="list-group-item">
        <a>{{ __('来源分析') }}</a>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('adminSourceAnalyseIndex', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">{{ __('概览') }}</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('adminSourceAnalyseAllSources', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">{{ __('所有来源') }}</a>
            </li>
            {{--<li class="list-group-item">--}}
                {{--<a href="{{ route('adminSourceAnalyseSearchEngine', ['site_id'=>request()->get('site_id'), 'start_time'=>request()->get('start_time'), 'end_time'=>request()->get('end_time')]) }}">{{ __('搜索引擎') }}</a>--}}
            {{--</li>--}}
        </ul>
    </li>
</ul>