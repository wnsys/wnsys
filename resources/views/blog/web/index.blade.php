@extends('layouts.web')
@section("left")
    韦宁的博客
@stop
@section("content")
    <ol class="breadcrumb">
        @foreach($breadcrumb as $item)
            <li class="{{$item['class']}}">
                @if($item["url"])
                    <a  href="{{$item[url]}}">{{$item[name]}}</a>
                @else
                    {{$item[name]}}
                @endif

            </li>
        @endforeach
    </ol>
    <ul class="list-group">
        @foreach($bloglist as $blog)
            <li class="list-group-item">
                <span class="badge"> {{$blog->created_at->toDateString()}}</span>
                <a href="/blog/{{$blog->id}}">{{$blog->title}}</a>
                [{{$blog->cat->name}}]


            </li>
        @endforeach
    </ul>
    {{$bloglist->links()}}
@endsection
