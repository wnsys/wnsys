@extends('layouts.shop')
@section("css")
    <link href="/css/shop/common.css" rel="stylesheet" type="text/css">
@append
@include("common.slider")
@section("shop")

    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">商品</a>
        </li>
        <li><a href="#detail" data-toggle="tab">详情</a></li>
        <li>
            <a href="#pingjia" data-toggle="tab">评价</a>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
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
                    <ul class="list-unstyled top-boder1 pd-t7">
                        <li><span class="title-text">{{$data[name]}}</span></li>
                        <li class="pd-t7"><span class="big-price">￥{{$data[price]}}</span></li>
                        <li class="pd-t7"><span class="prod-act">{{$data[description]}}</span></li>
                    </ul>

                </div>
            </div>


        </div>
        <div class="tab-pane fade" id="detail">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="content">
                        {!!$data[content]!!}
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pingjia">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="content">
                        <p>Enterprise Java Beans（EJB）是一个创建高度可扩展性和强大企业级应用程序的开发架构，部署在兼容应用程序服务器（比如 JBOSS、Web Logic 等）的 J2EE
                            上。
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(function () {
            $('#myTab li:eq(0) a').tab('show');
        });
    </script>

    <div id="cart1" class="">
        <div class="concern-cart">

            <a class="" >
					<span class="focus-info">客服</span>
            </a>
            <a class="" id="focusOn" >
                <span class="focus-info"> 关注  </span>
            </a>
            <a class="" id="toCartNew" >
                <span class="focus-info">购物车</span>
            </a>
        </div>
        <div class="action-list">
            <a class="yellow-color add_cart">
                加入购物车
            </a>
            <a class="red-color directorder">
                立即购买
            </a>
        </div>
    </div>
@endsection
