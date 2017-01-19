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
        <ul class="list-inline">
            @foreach($blog->image() as $item)
                <li><img class="img-thumbnail" src="{{$item->thumb(120,120)}}"></li>
            @endforeach
        </ul>
    </div>




@endsection
