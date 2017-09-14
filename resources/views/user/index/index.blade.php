@extends('user.index')

@section("right-content")

    <ul class="list-group">
        @foreach($bloglist as $blog)
            <li class="list-group-item">
                <a href="/blog/{{$blog["id"]}}">{{$blog["title"]}}</a>
            </li>
        @endforeach
    </ul>

@endsection
