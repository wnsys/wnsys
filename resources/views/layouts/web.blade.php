@extends("layouts.base")
@section("nav")
    @include("common.nav")
@stop
@section('content')
    <div class="container center-block pad10  container-blog">
        @section("left")
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
        @section('right')
            <div class="col-md-9">
                @section("right-content")
                @show
            </div>
        @show
    </div>
@stop
