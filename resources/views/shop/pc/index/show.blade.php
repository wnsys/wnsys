@extends('shop')
@section("css")
    <link href="/statics/css/shop/show.css" rel="stylesheet" type="text/css">
@append
@section("js")
    <script>
        var price = {{$data[price]}};
        var id = {{$data[id]}};
        var name = "{{$data[name]}}";

        var app = new Vue({
            el: '#cart1',
            data: {
                items: {},
                sum:0
            },
            mounted: function () {
                $('#myTab li:eq(0) a').tab('show');
                $.get("/shop/getCart", function (res) {
                    app.items = res.data.list;
                    app.sum = res.data.sum;
                })

            },
            methods: {
                toCartNew: function () {
                    $(".cart-list").slideToggle()
                },
                add_cart: function (id,qty) {
                    $.get("/shop/addCart",
                            {"cart[product_id]": id, "cart[price]": price, "cart[qty]": qty, "cart[name]": name},
                            function (res) {
                                app.items = res.data.list;
                                app.sum = res.data.sum;
                                app.$toast({
                                    message: '操作成功',
                                    position: 'middle',
                                    duration: 600
                                })
                            })

                },
            }
        })
    </script>
@append
@include("common.slider")
@section("content")

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
                                <li class="text-center">
                                    <a><img style="width:100%;max-width: 500px" class="img-rounded"
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
@endsection
@section("footer")

    <div id="cart1" class="text-center cart-concern-btm-fixed five-column">
        <div class="cart-list " style="display: none;">
            <ul class="list-group text-left">

                <li class="list-group-item" v-for="item in items">
                    <div class="col-xs-10 col">
                        <span>@{{item.name}}</span>
                        <span class="big-price">￥<span class="pro-price">@{{item.price}}</span></span>
                    </div>
                    <div class="col-xs-2 col">
                        <span class="glyphicon glyphicon-minus" v-on:click="add_cart(item.product_id,-1)"></span>
                        <span>@{{item.qty}}</span>
                        <span class="glyphicon glyphicon-plus" v-on:click="add_cart(item.product_id,1)"></span>
                    </div>
                </li>
                <li class="list-group-item" >
                    <div class="col-xs-10 col">
                        总价
                    </div>
                    <div class="col-xs-2 col">
                        <span class="big-price">￥<span class="pro-price">@{{sum}}</span></span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="concern-cart col-xs-6 col ">

            <a class="col-xs-4 col">
                <span class="focus-info">客服</span>
            </a>
            <a class="col-xs-4 col" id="focusOn">
                <span class="focus-info"> 关注  </span>
            </a>
            <a class="col-xs-4 col" id="toCartNew" v-on:click="toCartNew">
                <span class="focus-info">购物车</span>
            </a>
        </div>
        <div class="action-list col-xs-6 col">
            <a class="yellow-color add_cart col-xs-6 col" v-on:click="add_cart(id,1)">
                加入购物车
            </a>
            <a class="red-color directorder col-xs-6 col" href="/shop/buy">
                立即购买
            </a>
        </div>
    </div>
@stop