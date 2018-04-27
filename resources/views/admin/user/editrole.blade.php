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
                        <a class="btn btn-success" href="{{ route('adminUserIndex') }}">{{ __('用户列表') }}</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">{{ __('分配角色') }}</div>
                    <div class="panel-body">
                        <form action="{{ route('adminUserUpdateRole', ['id'=>$user_id]) }}" class="form" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                @foreach($roles as $role)
                                    {{--{{ dd($role) }}--}}
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                @if($role->checked) checked @endif> {{ $role->name }}
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button class="btn">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
