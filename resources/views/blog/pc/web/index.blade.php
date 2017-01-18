@extends('layouts.web')

@section("content")
@include("web.components.breadcrumb")
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
