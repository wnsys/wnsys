@extends('layouts.web')
@section("left")
    韦宁的博客
@stop
@section("content")

    {{$blog[title]}}

    {!!$blog[content]!!}

@endsection
