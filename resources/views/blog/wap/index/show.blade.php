@extends('layouts.blog')
@section("css")
    <style>
        img {
            max-width: 100% ;
        }
    </style>
@stop
@section("blog")
    @include("index.components.breadcrumb")
    <div class="panel panel-default" id="show">
        <div class="panel-body">
            @if(!in_array($blog["catid"],app("config")["module"]["blog"]["hide_title"]))
                <h3>{{$blog[title]}}</h3>
            @endif

            <div class="blog-content ">
                {!!$blog[content]!!}
                <div class="banner">
                    <ul class="list-inline">
                        @foreach($blog->image() as $item)
                            <li><a href="{{$item->url}}"><img class="img-thumbnail" src="{{$item->thumb(500,500)}}"></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <ul class="list-inline text-right">
                <li>
                    <span class="glyphicon glyphicon-calendar"></span>
                    {{$blog["created_at"]}}
                </li>
            </ul>

        </div>
    </div>
@endsection
