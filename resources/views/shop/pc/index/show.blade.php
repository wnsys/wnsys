@extends('layouts.web')

@section("css")
    <style>
        img {
            max-width: 100%;
        }
    </style>
@stop

@section("content")
    @include("index.components.breadcrumb")
    @if(!in_array($blog["catid"],app("config")["module"]["blog"]["hide_title"]))
        <h3>{{$blog[title]}}</h3>
    @endif

    <ul class="list-inline">
        <li>
            <span class="glyphicon glyphicon-calendar"></span>
            {{$blog["created_at"]}}
        </li>
    </ul>
    <div class="blog-content ">
            {!!$blog[content]!!}
            <ul class="list-inline">
                @foreach($blog->image() as $item)
                    <li><a href="{{$item->url}}"><img class="img-thumbnail" src="{{$item->url}}"></a></li>
                @endforeach
            </ul>
    </div>
@endsection
