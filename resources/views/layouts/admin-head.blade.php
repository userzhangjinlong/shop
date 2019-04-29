<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LAN商城') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'LAN商城管理后台') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    {{--<ul class="nav navbar-nav">--}}
                        {{--&nbsp;--}}
                    {{--</ul>--}}

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if(session()->get('adminId'))
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ session()->get('userName') }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar-left" style="width: 16%;float: left">
            {{--<div class="row">--}}
            <div class="col-md-2" style="width: 100%;">
                <ul id="main-nav" class="main-nav nav nav-tabs nav-stacked" style="">
                    {{--<li>--}}
                    {{--<a href="#">--}}
                    {{--<i class="glyphicon glyphicon-th-large"></i>--}}
                    {{--首页--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="#systemSetting" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-cog"></i>
                            系统管理

                            <span class="pull-right glyphicon glyphicon-plus"></span>
                        </a>
                        <ul id="systemSetting" class="nav nav-list secondmenu collapse" style="height: 0px;">
                            <li><a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;用户管理</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-th-list"></i>&nbsp;菜单管理</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-asterisk"></i>&nbsp;角色管理</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-edit"></i>&nbsp;修改密码</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;日志查看</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#configSetting" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-credit-card"></i>
                            配置管理
                            <span class="pull-right glyphicon  glyphicon-chevron-toggle"></span>
                        </a>
                        <ul id="configSetting" class="nav nav-list secondmenu collapse in">
                            <li class="active"><a href="#"><i class="glyphicon glyphicon-globe"></i>&nbsp;全局缺省配置</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-star-empty"></i>&nbsp;未开通用户配置</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-star"></i>&nbsp;退订用户配置</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-text-width"></i>&nbsp;试用用户配置</a></li>
                            <li><a href="#"><i class="glyphicon glyphicon-ok-circle"></i>&nbsp;开通用户配置</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#disSetting" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-globe"></i>
                            分发配置
                            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
                        </a>
                        <ul id="disSetting" class="nav nav-list secondmenu collapse">
                            <li><a href="#"><i class="glyphicon glyphicon-th-list"></i>&nbsp;分发包配置</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#dicSetting" class="nav-header collapsed" data-toggle="collapse">
                            <i class="glyphicon glyphicon-bold"></i>
                            字典配置
                            <span class="pull-right glyphicon glyphicon-chevron-toggle"></span>
                        </a>
                        <ul id="dicSetting" class="nav nav-list secondmenu collapse">
                            <li><a href="#"><i class="glyphicon glyphicon-text-width"></i>&nbsp;关键字配置</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-fire"></i>
                            关于系统
                            <span class="badge pull-right">1</span>
                        </a>
                    </li>

                </ul>
            </div>
            {{--</div>--}}
        </nav>


        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
