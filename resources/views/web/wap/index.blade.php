@extends('layouts.wap.web')

@section("content")

    <ul class="list-group">
        @foreach($bloglist as $blog)
            <li class="list-group-item list-group-item-1">
                @if($blog->created_at)
                    <span class="badge"> {{$blog->created_at->toDateString()}}</span>
                @endif
                <a href="/blog/{{$blog->id}}">{{$blog->title}}</a>
                [{{$blog->cat->name}}]
            </li>
        @endforeach
    </ul>

  {{--  {{$bloglist->links()}}--}}

@endsection
