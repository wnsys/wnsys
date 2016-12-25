@extends('layouts.web')
@section("left")
    韦宁的博客
@stop
@section("content")
<h1>{{$blog[title]}}</h1>


    {!!$blog[content]!!}

@endsection
