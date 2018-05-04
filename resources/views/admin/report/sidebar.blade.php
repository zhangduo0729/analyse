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
                <a href="">用户</a>
            </li>
        </ul>
    </li>
</ul>