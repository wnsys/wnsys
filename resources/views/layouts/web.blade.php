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
    @section("css")
    @show
    <script src="/js/jquery-3.1.1/jquery-3.1.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    @section("js")
    @show
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body  style="background:{{config("style.bg_color")}}">
<example></example>
@include("common.header")
<div class="container center-block pad5">
        @section('content')
        @show
</div>
@include("common.footer")
</body>
</html>