@extends('layouts.shop')
@include("common.slider")
@section("shop")
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="banner">
                <ul class="list-inline">
                    @foreach($data->image() as $item)
                        <li class="text-center"><a><img style="width:100%;max-width: 500px" class="img-rounded"
                                                        src="{{$item->thumb(500,500)}}"></a></li>
                    @endforeach
                </ul>
            </div>
            <ul class="list-group" style="border-top: 1px solid #ddd;padding-top:7px;">
                <li>{{$data[name]}}</li>
                <li>￥{{$data[price]}}</li>
            </ul>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="blog-content">
                {!!$data[content]!!}
            </div>
        </div>
    </div>
@endsection
