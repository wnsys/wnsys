@extends('layouts.shop')
@include("common.slider")
@section("shop")
    <div class="banner">
        <ul class="list-inline">
            @foreach($data->image() as $item)
                <li class="text-center"><a ><img style="width:100%;max-width: 500px" class="img-rounded" src="{{$item->thumb(500,500)}}"></a></li>
            @endforeach
        </ul>
    </div>
    <h3>{{$data[name]}}</h3>
    <div class="blog-content ">
        {!!$data[content]!!}
    </div>
@endsection
