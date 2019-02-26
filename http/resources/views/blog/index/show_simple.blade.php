@extends('blog.index')
@section("right-content")
    @include("blog.index.components.breadcrumb")
    <div class="panel panel-default">
        <div class="panel-body">
simple
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