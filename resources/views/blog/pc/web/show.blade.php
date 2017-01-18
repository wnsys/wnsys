@extends('layouts.web')

@section("css")
    <style>img {
            max-width: 100%;
        }</style>
@stop
@section("content")
    @include("web.components.breadcrumb")
    <h1>{{$blog[title]}}</h1>
    <ul class="list-inline">
        <li>
            <span class="glyphicon glyphicon-calendar"></span>
            {{$blog["created_at"]}}
        </li>
    </ul>
    <div class="blog-content">
        {!!$blog[content]!!}
    </div>


@endsection
