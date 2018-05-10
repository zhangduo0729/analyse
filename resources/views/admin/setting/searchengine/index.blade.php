@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.setting.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('工具栏') }}</div>
                    <div class="panel-body">
                        <a class="btn btn-success" href="{{ route('adminSearchEngineCreate') }}">{{ __('添加搜索引擎') }}</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('搜索引擎管理') }}</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('名称') }}</th>
                                <th>{{ __('域名') }}</th>
                                <th>{{ __('操作') }}</th>
                            </tr>
                            @foreach($engines as $engine)
                                <tr>
                                    <td>{{ $engine->name }}</td>
                                    <td>{{ $engine->domain }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('adminSearchEngineEdit', ['id'=>$engine->id]) }}">{{ __('编辑') }}</a>
                                        <a class="btn btn-danger btn-sm" onclick="del(function () { document.getElementById('sedForm{{ $engine->id }}').submit() })">{{ __('删除') }}</a>
                                        <form action="{{ route('adminSearchEngineDestroy', ['id'=>$engine->id]) }}" id="sedForm{{ $engine->id }}" method="post" style="display:none;">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="panel-footer">
                        {{ __('这里的搜索引擎记录用于统计有关于搜索引擎的信息，例如，从搜索引擎跳转过来的访问。') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
