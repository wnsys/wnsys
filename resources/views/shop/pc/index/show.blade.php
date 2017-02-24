@extends('layouts.shop')
@include("common.slider")
@section("shop")
    <div class="panel panel-default basic-info ">
        <div class="panel-body">
            <div class="banner">
                <ul class="list-inline">
                    @foreach($data->image() as $item)
                        <li class="text-center"><a><img style="width:100%;max-width: 500px" class="img-rounded"
                                                        src="{{$item->thumb(500,500)}}"></a></li>
                    @endforeach
                </ul>
            </div>
            <ul class="list-unstyled top-boder1 pd-t7" >
                <li><span class="title-text">{{$data[name]}}</span></li>
                <li class="pd-t7"><span class="big-price">￥{{$data[price]}}</span></li>
                <li class="pd-t7"><span class="prod-act">{{$data[description]}}</span></li>
            </ul>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="content">
                {!!$data[content]!!}
            </div>
        </div>
    </div>
@endsection
