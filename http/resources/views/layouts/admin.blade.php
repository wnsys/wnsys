@extends('layouts.base')
@section("css")
    <link href="/statics/js/artDialog4.1.7/skins/default.css" rel="stylesheet">
@append
@section("includejs")
    <script src="/statics/js/artDialog4.1.7/artDialog.js"></script>
@append
@section("nav")
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container" style="width:90%">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">切换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="/admin/blog">博客管理</a></li>
                    <li><a href="/admin/user">会员管理</a></li>
                    <li><a href="/admin/shop/order">商城</a></li>
                    <li><a href="/admin/setting">系统管理</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        {{--<li><a href="{{ url('/login') }}">登录</a></li>
                        <li><a href="{{ url('/register') }}">注册</a></li>--}}
                    @else
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                <span class="glyphicon glyphicon-user"></span>{{ Auth::user()->user_name }} <span
                                        class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
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
@stop
@section("content")

@section('left')
    <div class="col-md-2">
        @section('left-content')
        @show
    </div>
@show
@section('right')
    <div class="col-md-10">
        @section('right-content')
        @show
    </div>
@show
@stop
