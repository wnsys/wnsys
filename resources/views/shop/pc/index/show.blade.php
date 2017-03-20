@extends('shop')
@section("css")
    <link href="/css/shop/show.css" rel="stylesheet" type="text/css">
@append
@section("js")
    <script>
        var price = {{$data[price]}};
        var id = {{$data[id]}};
        var name = "{{$data[name]}}";

        var app = new Vue({
            el: '#app',
            data: {

            },
            mounted:function () {
                this.$http.jsonp("shop/getCart")
                        .then(function(res) {
                            var rtnData = res.data;
                            if (rtnData.status == 0) {
                                console.log(rtnData);
                            }
                        })
                        .catch(function(res) {
                            console.info('网络失败');
                        });

            },
            methods:{

            }
        })
        $(function () {
            $('#myTab li:eq(0) a').tab('show');
            $("#toCartNew").on("click", function () {
                $(".cart-list").slideToggle()

            })

            $(".add_cart").on("click", function () {
                $.get("/shop/addCart",
                        {id: id,price:price,qty:1,name:name},
                        function (data) {
                            console.log(data);
                        })
                layer.msg('添加成功', {time: 1000});
            })
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
                @foreach($cart as $item)
                <li class="list-group-item" v-for="item in items">
                    <div class="col-xs-10 col">
                        <span></span>{{ $item[name] }}
                        <span class="big-price">￥<span class="pro-price">{{ $item[price] }}</span></span>
                    </div>
                    <div class="col-xs-2 col">
                        <span class="glyphicon glyphicon-minus"></span>
                        <span>{{ $item[qty] }}</span>
                        <span class="glyphicon glyphicon-plus"></span>
                    </div>
                </li>
                    @endforeach
            </ul>
        </div>
        <div class="concern-cart col-xs-6 col ">

            <a class="col-xs-4 col">
                <span class="focus-info">客服</span>
            </a>
            <a class="col-xs-4 col" id="focusOn">
                <span class="focus-info"> 关注  </span>
            </a>
            <a class="col-xs-4 col" id="toCartNew">
                <span class="focus-info">购物车</span>
            </a>
        </div>
        <div class="action-list col-xs-6 col">
            <a class="yellow-color add_cart col-xs-6 col">
                加入购物车
            </a>
            <a class="red-color directorder col-xs-6 col">
                立即购买
            </a>
        </div>
    </div>
@stop