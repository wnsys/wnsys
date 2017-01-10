@extends('layouts.web')
@section("left")
    韦宁的博客
@stop
@section("content")
    <style>img {
            width: 100%;
        }</style>
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

    <h1>{{$blog[title]}}</h1>

    {!!$blog[content]!!}

@endsection
