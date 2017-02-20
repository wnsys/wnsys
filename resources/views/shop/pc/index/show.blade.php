@extends('layouts.web')

@section("css")
    <style>
        img {
            max-width: 100%;
        }
    </style>
@stop

@section("content")
    @include("index.components.breadcrumb")

    <h3>{{$data[name]}}</h3>

    <ul class="list-inline">
        <li>
            <span class="glyphicon glyphicon-calendar"></span>
            {{$data["created_at"]}}
        </li>
    </ul>
    <div class="blog-content ">
            {!!$data[content]!!}
            <ul class="list-inline">
                @foreach($data->image() as $item)
                    <li><a href="{{$item->url}}"><img class="img-thumbnail" src="{{$item->url}}"></a></li>
                @endforeach
            </ul>
    </div>
@endsection
