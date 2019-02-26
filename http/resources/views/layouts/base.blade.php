<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$seo["title"]}}</title>
    <meta name="keywords" content="{{$seo["keywords"]}}" />
    <meta name="description" content="{{$seo["description"]}}"  />
    <link href="/statics/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/statics/css/web.css" rel="stylesheet">
    @section("css")
    @show
    <script src="/statics/vue/vue.js"></script>
    <script src="/statics/js/jquery-3.1.1/jquery-3.1.1.min.js"></script>
    <script src="/statics/bootstrap/js/bootstrap.min.js"></script>
    @section("includejs")
    @show
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body  style="background:{{config("style.bg_color")}}">
<div id="app">
    @section('nav')
    @show
    @section('content')
    @show

    @section('modal')
    @show
    @section("js")
    @show
</div>
@section("footer")
    @include("common.footer")
@show
</body>
</html>