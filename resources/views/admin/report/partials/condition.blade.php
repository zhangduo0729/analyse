<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">{{ __('工具栏') }}</div>
        <div class="panel-body">
            站点：
            <select id="site_id">
                <option value="0">{{ __('全部') }}</option>
                @foreach($sites as $site)
                    <option value="{{ $site->id }}" @if($site->id == $site_id) selected="selected" @endif>{{ $site->name }}</option>
                @endforeach
            </select>
            开始时间：
            <input type="date" id="start_time" value="{{ $start_time }}"/>
            结束时间：
            <input type="date" id="end_time" value="{{ $end_time }}"/>
            <button class="btn btn-default btn-sm" onclick="refresh()">查询</button>
            <script>
                /**
                 * @param site_id
                 */
                function refresh() {
                    var url = document.location.protocol + '//' + document.location.host + document.location.pathname + '?';
                    var site_id = document.getElementById('site_id').value;
                    if (site_id) {
                        url += '&site_id=' + site_id;
                    }
                    var start_time = document.getElementById('start_time').value;
                    if (start_time) {
                        url += '&start_time=' + start_time;
                    }
                    var end_time = document.getElementById('end_time').value;
                    if (end_time) {
                        url += '&end_time=' + end_time;
                    }
                    window.location = url
                }
            </script>
        </div>
    </div>
</div>