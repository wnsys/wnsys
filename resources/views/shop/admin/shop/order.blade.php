@extends('shop.admin')
@section('right-content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline">
                <div class="form-group">
                    <label for="cat_name">分类</label>
                    <?php echo $catlist;?>
                </div>

                <input type="submit" class="btn btn-primary" value="搜索">
            </form>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped ">
                <tr>
                    <th class="">订单号</th>
                    <th class="">商品名称</th>
                    <th class="">订单金额(元)</th>
                    <th class="">客户姓名</th>
                    <th class="">客户手机号</th>
                    <th class="">创建时间</th>
                    <td class="">操作</td>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td><a href="/admin/shop/order/{{$item["id"]}}" target="_blank">{{$item["id"]}}</a></td>
                        <td>
                            @foreach($item->detail as $d)
                                {{$d->product->name}}
                                <br>
                            @endforeach
                        </td>
                        <td>{{$item["amount"]}}</td>
                        <td>{{$item["user_name"]}}</td>
                        <td>{{$item["phone"]}}</td>
                        <td>{{$item["created_at"]}}</td>
                        <td><a v-on:click="getDetail({{$item['id']}})">查看</a>
                            | <a href="/admin/shop/order/delete?id={{$item["id"]}}" onclick="return confirm('确定删除吗？')">删除</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{$data->links()}}
        </div>
    </div>
@endsection
@section('modal')
    <div id="detail" style="width:400px;display: none">
        <table class="table table-striped ">
            <tr>
                <td>订单号</td>
                <td> @{{detail.id}}</td>
            </tr>
            <tr>
                <td>客户姓名</td>
                <td> @{{detail.user_name}}</td>
            </tr>
            <tr>
                <td>客户手机号</td>
                <td> @{{detail.phone}}</td>
            </tr>
            <tr>
                <td>客户地址</td>
                <td> @{{detail.address}}</td>
            </tr>
            <tr>
                <td>商品</td>
                <td></td>
            </tr>
        </table>

    </div>
@append
@section("js")
    <script>
        var app = new Vue({
            el: "#app",
            data: {detail: {}},
            methods: {
                getDetail: function (id) {
                    $.ajax({
                        url: "/admin/shop/order/detail?id=" + id,
                        dataType: "json",
                        async: false,
                        success: function (rs) {
                            app.detail = rs;
                            art.dialog({
                                content: $("#detail")[0]
                            })
                        }
                    })
                }
            }
        })

    </script>
@stop