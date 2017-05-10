@extends('blog.index')
@section("right-content")
    @include("blog.index.components.breadcrumb")
    <div class="panel panel-default">
        <div class="panel-body">
            @if(!in_array($blog["catid"],app("config")["module"]["blog"]["hide_title"]))
                <h3 class="text-center">{{$blog[title]}}</h3>
            @endif
            <div class="blog-content ">
                {!!$blog[content]!!}
                <ul class="list-inline">
                    @foreach($blog->image() as $item)
                        <li><a href="{{$item->url}}"><img class="" src="{{$item->url}}"></a></li>
                    @endforeach
                </ul>
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
@section("css")
    <style>
        img {
            max-width: 100%;
        }
    </style>
@stop