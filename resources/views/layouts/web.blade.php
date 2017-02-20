<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>韦宁的博客</title>
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/css/web.css" rel="stylesheet">
    @yield("css")
    <script src="/js/jquery-3.1.1/jquery-3.1.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    @yield("js")
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
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
<div class="container center-block blog-container">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                @section("left")
                    @include("web.left")
                @show
            </div>
        </div>
    </div>
    <div class="col-md-9">
        @section('content')
        @show
    </div>

</div>
<nav class="navbar navbar-default  text-center footer">
    <div class="container">
        坚持梦想,仗剑天涯<br>
        写最干净的代码，做最简单的系统<br>
        github：
        <a href="https://github.com/178441367/wnsys" target="_blank">https://github.com/178441367/wnsys</a>

    </div>
</nav>
</body>
</html>