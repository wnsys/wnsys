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
            <table class="table table-striped " >
                <tr>
                    <th class="">id</th>
                    <th class="">商品</th>
                    <th class="">金额</th>
                    <th class="col-xs-4">时间</th>
                    <td class="">操作</td>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td><a href="/admin/shop/order/{{$item["id"]}}" target="_blank">{{$item["id"]}}</a></td>
                        <td>{{$item->detail->product->name}}</td>
                        <td>{{$item["amount"]}}</td>
                        <td>{{$item["created_at"]}}</td>
                        <td><a href="/admin/shop/order/view?id={{$item["id"]}}">详情</a>
                            </td>
                    </tr>
                @endforeach
            </table>
            {{$data->links()}}
        </div>
    </div>
    @endsection