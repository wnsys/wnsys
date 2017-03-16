@extends('blog')
@section("css")
    <style>
        img {
            max-width: 100% ;
        }
    </style>
@stop
@section("right")
    @include("index.components.breadcrumb")
    <div class="panel panel-default" id="show">
        <div class="panel-body">

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
        </div>
    </div>
    <ul class="list-inline text-right" style="color:#ccc">
        <li>
            <span class="glyphicon glyphicon-calendar"></span>
            {{$blog["created_at"]}}
        </li>
    </ul>
@endsection
