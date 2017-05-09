@extends('layouts.leftRight1')
@section("left")
    <div class="col-md-3">
                @include("left")
    </div>

@stop
@section("right")

    <ul class="list-group">
        @foreach($bloglist as $blog)
            <li class="list-group-item">
                <a href="/blog/{{$blog["id"]}}">{{$blog["title"]}}</a>
            </li>
        @endforeach
    </ul>

@endsection
