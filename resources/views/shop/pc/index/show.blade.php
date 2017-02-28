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
            <a href="#pingjia" data-toggle="tab" >评价</a>
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
            <p>Enterprise Java Beans（EJB）是一个创建高度可扩展性和强大企业级应用程序的开发架构，部署在兼容应用程序服务器（比如 JBOSS、Web Logic 等）的 J2EE 上。
            </p>
        </div>
    </div>
    <script>
        $(function () {
            $('#myTab li:eq(0) a').tab('show');
        });
    </script>

<div id="cart1" class="cart-concern-btm-fixed five-column">
        		<div class="concern-cart">
											<!--Jimi客服(hasJimi&&notOnline)-->
													<a class="dong-dong-icn J_ping" report-eventid="MProductdetail_DongDongService" report-pageparam="10100422034" report-eventlevel="5" id="imBottom" href="http://chat.jd.com/merchant/index?v=6&amp;sku=10100422034&amp;imgUrl=&amp;goodName=%25E6%25BD%25AE%25E5%25AE%258F%25E5%259F%25BA%2520%25E9%25BB%2584%25E9%2587%2591%25E8%25B6%25B3%25E9%2587%2591%2520%2520%25E8%2590%258C%25E7%258C%25B4%2520%25E5%2590%258A%25E5%259D%25A0%25E9%25BB%2584%25E9%2587%2591%25E8%25BD%25AC%25E8%25BF%2590%25E7%258F%25A0%25E4%25B8%25B2%25E7%258F%25A0%25E8%25BD%25AC%25E8%25BF%2590%25E7%258F%25A0%2520%25E9%25BB%2584%25E9%2587%2591%25E6%258C%2582%25E5%259D%25A0%2520%25E5%25AE%259A%25E4%25BB%25B7%2520Y%2520%25E7%25BA%25A61.5g&amp;jdPrice=650.00&amp;sid=27199ad7ff7e758033d8b8331c3dfb8e&amp;entry=m_item">
								<em class="btm-act-icn"></em>
								<span class="focus-info">
																			客服
																	</span>
							</a>
											        			<a class="love-heart-icn J_ping" id="focusOn" report-eventid="MProductdetail_AddtoFollowed" report-eventparam="10100422034" report-pageparam="10100422034" report-eventlevel="5">
    					<em class="btm-act-icn focus-out" id="attentionFocus"></em>
    					<i class="focus-scale"></i>
    					<span class="focus-info"> 关注  </span>
        			</a>
					            			<a class="cart-car-icn J_ping" id="toCartNew" report-eventid="MProductdetail_GotoCart" report-eventparam="10100422034" report-pageparam="10100422034" report-eventlevel="5" href="//p.m.jd.com/cart/cart.action?sid=27199ad7ff7e758033d8b8331c3dfb8e">
            				<em class="btm-act-icn" id="shoppingCart">
                                <i class="order-numbers" id="carNum">1</i>
                            </em>
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
