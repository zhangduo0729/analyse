<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('libs/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('libs/jquery-3.3.1.min.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('libs/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->

                </div>
            </div>
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li><a class="nav-link" href="{{ route('adminReportIndex') }}">{{ __('报表面板') }}</a></li>
                            <li><a class="nav-link" href="{{ route('adminAdminIndex') }}">{{ __('所有网站') }}</a></li>
                            <li><a class="nav-link" href="{{ route('adminSettingIndex') }}">{{ __('设置') }}</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{--公用函数--}}
    <script>
        function del(callback) {
            if (confirm('确定要删除吗？删除后将不能恢复！')) {
                callback();
            }
        }
    </script>
    {{--埋点脚本--}}
	<script type="text/javascript">
    var _maq = _maq || [];
    _maq.push(["site_id", 1]);
    (function() {
        var ma = document.createElement("script"); ma.type = "text/javascript"; ma.async = true;
        ma.src = "http://iian.xyz/analyse.js";
        var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ma, s);
    })();
</script>








</body>
</html>
