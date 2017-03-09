<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>wnsys系统</title>
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/css/web.css" rel="stylesheet">
    @section("css")
    @show
    <script src="/js/jquery-3.1.1/jquery-3.1.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/js.cookie.js"></script>
    <script src="/js/layer/layer.js"></script>
    @section("js")
    @show
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body style="background:{{config("style.bg_color")}}">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-header">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
        </div>
        <div class="collapse navbar-collapse " id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="/" class="dropdown-toggle" data-toggle="dropdown">
                        博客
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($blog_category as $item)
                            <li><a href="/blog/cat/{{$item[id]}}">{{$item[name]}}</a></li>
                        @endforeach

                    </ul>
                </li>
                <li class="">
                    <a href="/shop" >
                        商城
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>