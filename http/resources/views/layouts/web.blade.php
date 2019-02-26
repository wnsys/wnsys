@extends("layouts.base")
@section("nav")
    @include("common.nav")
@stop
@section("css")

    <link rel="stylesheet" href="/statics/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css">
    @append
@section("includejs")

    <script type="text/javascript" src="/statics/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
    <script type="text/javascript">
        SyntaxHighlighter.all();
    </script>

@append
@section('content')
    <div class="container center-block pad0  container-blog">
        @section("left")
            <div class="col-md-9">
                @section("right-content")
                @show
            </div>

        @show
        @section('right')
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @section("left-content")
                                @include("web.left")
                            @show
                        </div>
                    </div>
                </div>

        @show
    </div>
@stop
