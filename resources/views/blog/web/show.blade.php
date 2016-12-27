@extends('layouts.web')
@section("left")
    韦宁的博客
@stop
@section("content")
    <style>img{width:100%;}</style>
<h1>{{$blog[title]}}</h1>

    {!!$blog[content]!!}

@endsection
