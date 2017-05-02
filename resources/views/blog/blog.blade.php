@extends('layouts.web')
@section("content")
    <div class="container center-block pad5 container-blog">
        @section("left")
            @include("web.left")
        @show
        <div class="col-md-9">
            @section('right')
            @show
        </div>
    </div>
@endsection

@section("css")
    <link href="/statics/css/blog/common.css" rel="stylesheet" type="text/css">
@append