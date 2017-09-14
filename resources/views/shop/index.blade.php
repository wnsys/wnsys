@extends('layouts.web')
@section("css")
    <link href="/statics/css/shop/show.css" rel="stylesheet" type="text/css">
@append
@section('content')
    <div class="container center-block pad5  container-blog">
        @section("content-content")
            @show
    </div>
@stop

