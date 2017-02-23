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
<body style="background:{{config("style.bg_color")}}">
@include("common.header")
<div class="container center-block pad5">
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
<div>
@include("common.footer")
</body>
</html>