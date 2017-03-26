@extends('shop')
@section("css")
    <link href="/statics/css/shop/show.css" rel="stylesheet" type="text/css">
@append
@section("left")
@stop
@section("right")

    <div class="col-md-9">
        <form class="form-horizontal ">
            <div class="form-group ">
                <label class="col-md-3 control-label">姓名</label>
                <div class="col-md-9 ">
                    <input type="text" class="form-control input-lg " placeholder="请输入姓名">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">手机号</label>
                <div class="col-md-9">
                    <input type="text" class="form-control input-lg " placeholder="请输入手机号">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">收货地址</label>
                <div class="col-md-9">
                    <input type="text" class="form-control input-lg" placeholder="请输入收货地址">
                </div>
            </div>
            <div class="form-group text-center">
                <label class="col-md-3 control-label hidden-xs"></label>
                <div class="col-md-9">
                    <input type="button" class="btn btn-primary btn-lg" value="提交" style="width:40%;">
                </div>
            </div>
        </form>
        <div class="cart-list col-md-offset-3">
            <table class="table">
                <tr>
                <th>商品名称</th>
                <th>件数</th>
                <th>价格</th>
                </tr>
                @foreach($items as $item)
                    <tr>
                            <td>{{$item[name]}}</td>
                            <td>{{$item[qty]}}</td>
                            <td>￥<span class="pro-price">{{$item[price]}}</span></td>

                    </tr>
                @endforeach
                <tr>
                    <td>总价</td>
                    <td></td>
                    <td>
                        <span class="big-price">
                            ￥<span class="pro-price">{{$sum}}
                            </span></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
