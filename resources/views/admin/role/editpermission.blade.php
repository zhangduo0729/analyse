@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.setting.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a class="btn btn-success" href="{{ route('adminUserIndex') }}">{{ __('角色列表') }}</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('分配权限') }}</div>
                    <div class="panel-body">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            @foreach($permissions as $permission)
                            <input type="checkbox" name="permission_id[]" value="{{ $permission->id }}"> {{ $permission->remark }}
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
