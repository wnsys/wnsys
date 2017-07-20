@extends('layouts.web')
@section("left-content")
    @include("web.left")
@stop
@section("right-content")
    <ul class="list-group">
        @foreach($bloglist as $blog)
            <li class="list-group-item">
                @if($blog->created_at)
                    <span class="badge"> {{$blog->created_at->toDateString()}}</span>
                @endif
                <a href="/blog/{{$blog->id}}">{{$blog->title}}</a>
                [{{$blog->cat->name}}]
                    <div class="clearfix img-list">
                    @foreach($blog->image() as $item)
                        <a href="{{$item->url}}"><img class="" src="{{$item->thumb(90,90)}}"></a>
                    @endforeach
                    </div>
            </li>
        @endforeach
    </ul>

@stop
