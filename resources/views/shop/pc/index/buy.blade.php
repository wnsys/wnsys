@extends('shop')
@section("js")
    <script>
        var app = new Vue({
            el: '#cart1',
            data: {
                items: {},
                sum:0
            },
            mounted: function () {
                $.get("/shop/getCart", function (res) {
                    app.items = res.data.list;
                    app.sum = res.data.sum;
                })

            },
            methods: {
                add_cart: function (id,price,name,qty) {
                    $.get("/shop/addCart",
                            {"cart[product_id]": id, "cart[price]": price, "cart[qty]": qty, "cart[name]": name},
                            function (res) {
                                app.items = res.data.list;
                                app.sum = res.data.sum;
                                app.$toast({
                                    message: '操作成功',
                                    position: 'middle',
                                    duration: 1000
                                })
                            })

                },
            }
        })

    </script>
@stop
@section("left")
@stop
@section("right")
    <div class="col-md-9">
        <form class="form-horizontal " method="post">
            <div class="form-group ">
                <label class="col-md-3 control-label">姓名</label>
                <div class="col-md-9 ">
                    <input type="text" name="user_name" class="form-control input-lg " placeholder="请输入姓名">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">手机号</label>
                <div class="col-md-9">
                    <input type="text" name="phone" class="form-control input-lg " placeholder="请输入手机号">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">收货地址</label>
                <div class="col-md-9">
                    <input type="text" name="address" class="form-control input-lg" placeholder="请输入收货地址">
                </div>
            </div>
            <div class="form-group text-center">
                <label class="col-md-3 control-label hidden-xs"></label>
                <div class="col-md-9">
                    <input type="submit" name="dosubmit" class="btn btn-primary btn-lg" value="提交" style="width:40%;">
                </div>
            </div>
        </form>
        <div class="cart-list col-md-offset-3" id="cart1">
            <table class="table">
                <tr>
                <th>商品名称</th>
                <th>件数</th>
                <th>价格</th>
                </tr>

                    <tr v-for="item in items">
                            <td>@{{item.name}}</td>
                            <td>@{{item.price}}</td>
                            <td>
                                <span class="glyphicon glyphicon-minus" v-on:click="add_cart(item.product_id,item.price,item.name,-1)"></span>
                                <span>@{{item.qty}}</span>
                                <span class="glyphicon glyphicon-plus" v-on:click="add_cart(item.product_id,item.price,item.name,1)"></span>
                            </td>

                    </tr>
                <tr>
                    <td>总价</td>
                    <td></td>
                    <td>
                        <span class="big-price">
                            ￥<span class="pro-price">@{{sum}}</span></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
