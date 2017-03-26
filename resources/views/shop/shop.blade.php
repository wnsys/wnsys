@extends('layouts.web')
@section("css")
    <link href="/statics/css/shop/show.css" rel="stylesheet" type="text/css">
@append
@section("content")
    <div class="container center-block pad5 container-shop">
        @section("left")
            @include("web.left")
        @show
        @section("right")
        @show
    </div>
@endsection
