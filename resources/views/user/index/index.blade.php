@extends('layouts.web')
@section("left")
    韦宁的博客
@stop
@section("content")

    <ul class="list-group">
        @foreach($bloglist as $blog)
            <li class="list-group-item">
                <a href="/blog/{{$blog["id"]}}">{{$blog["title"]}}</a>
            </li>
        @endforeach
    </ul>

@endsection
