@extends('layouts.web')

@section("css")
    <style>img {
            width: 100%;
        }</style>
@stop
@section("content")
    <ol class="breadcrumb">
        @foreach($breadcrumb as $item)
            <li class="{{$item['class']}}">
                @if($item["url"])
                    <a href="{{$item[url]}}">{{$item[name]}}</a>
                @else
                    {{$item[name]}}
                @endif

            </li>
        @endforeach
    </ol>

    <h1>{{$blog[title]}}</h1>
    <ul class="list-inline">
        <li>
            <span class="glyphicon glyphicon-calendar"></span>
            {{$blog["created_at"]}}
        </li>
    </ul>
    {!!$blog[content]!!}

@endsection
