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
    <script src="/js/vue.js"></script>
    <script src="/js/jquery-3.1.1/jquery-3.1.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/layer/layer.js"></script>

    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body style="background:{{config("style.bg_color")}}">
<div id="app">
    @include("common.nav")
    <div class="container center-block pad5 <?php echo app()["module"] ? "container-" . app()["module"] : "";?>">
        @section('content')
        @show
    </div>
    @section("footer")
        @include("common.footer")
    @show

    @section('modal')
    @show
    @section("js")
    @show
</div>
</body>
</html>