@extends('shop')
@section("js")
    <script src="/statics/js/mtjsencrypt.min.js"></script>
    <script>
        var app = new Vue({
            el: '#app',
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

                            })

                },
            }
        })
        function submit1() {
            var version='pc_NoEncrypt';//传此值时，明天云返回明文参数，否则返回密文参数
            var subject="test";
            var mchntOrderNo='No112324';
            var amount='1';
            var appid="{{config("module.shop.itppay.appid")}}";
            var key="{{config("module.shop.itppay.key")}}";
            var payChannelId='';
            var body='花千骨';
            var clientIp="{{$ip}}";
            var notifyUrl="{{config("module.shop.itppay.notifyUrl")}}";
            var returnUrl="{{config("module.shop.itppay.returnUrl")}}";
            var signature='';
            var jsonStr='{';
            //请求参数都按照名称字符升序排列
            if(amount!=''&&$.trim(amount).length>0){
                jsonStr+='"amount":"'+amount+'",';
                signature+='amount='+amount+'&'
            }
            if(appid!=''&&$.trim(appid).length>0){
                jsonStr+='"appid":"'+appid+'",';
                signature+='appid='+appid+'&'
            }
            if(body!=''&&$.trim(body).length>0){
                jsonStr+='"body":"'+body+'",';
                signature+='body='+body+'&'
            }
            if(clientIp!=''&&$.trim(clientIp).length>0){
                jsonStr+='"clientIp":"'+clientIp+'",';
                signature+='clientIp='+clientIp+'&'
            }
            if(mchntOrderNo!=''&&$.trim(mchntOrderNo).length>0){
                jsonStr+='"mchntOrderNo":"'+mchntOrderNo+'",';
                signature+='mchntOrderNo='+mchntOrderNo+'&'
            }

            if(notifyUrl!=''&&$.trim(notifyUrl).length>0){
                jsonStr+='"notifyUrl":"'+notifyUrl+'",';
                signature+='notifyUrl='+notifyUrl+'&'
            }
            if(payChannelId!=''&&$.trim(payChannelId).length>0){
                jsonStr+='"payChannelId":"'+payChannelId+'",';
                signature+='payChannelId='+payChannelId+'&'
            }
            if(returnUrl!=''&&$.trim(returnUrl).length>0){
                jsonStr+='"returnUrl":"'+returnUrl+'",';
                signature+='returnUrl='+returnUrl+'&'
            }
            if(subject!=''&&$.trim(subject).length>0){
                jsonStr+='"subject":"'+subject+'",';
                signature+='subject='+subject+'&'
            }
            if(version!=''&&$.trim(version).length>0){
                jsonStr+='"version":"'+version+'",';
                signature+='version='+version+'&'
            }
            if(key!=''&&$.trim(key).length>0){
                signature+='key='+key
            }
            if(signature!=''&&$.trim(signature).length>0){
                jsonStr+='"signature":"'+signature+'",';
            }

            jsonStr=jsonStr.substring(0,jsonStr.length-1);
            jsonStr+='}';
            var result =mtEncryptAndMD5(jsonStr);
            $("#orderInfo").val(result);
            $('#form').submit();
        }
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
                    <input type="button" name="dosubmit" onclick="submit1()" class="btn btn-primary btn-lg" value="提交" style="width:40%;">
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
    <form id="form" action="http://trans.itppay.com/newsdk/api/v1.0/cli/order_h5/0" method="post">
        <input type="hidden" id="orderInfo" name="orderInfo" value="">
    </form>
    
@endsection
