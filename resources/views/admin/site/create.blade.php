@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/sites') }}" method="POST" class="form-horizontal" role="form">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="control-label">{{ __('站点名称') }}</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="host" class="control-label">{{ __('站点域名') }}</label>
                <textarea name="host" id="host" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">{{ __('添加') }}</button>
            </div>

        </form>
    </div>
@endsection
