@extends('admin.setting')
@section("js")
    <script>
        $().ready(function(){
            $(".edit").click(function () {
                item = $(this)
                $.ajax({
                    url:"/admin/permission/get?id="+item.data("id"),
                    dataType:"json",
                    success:function (data) {
                        $("#edit .name").val(data.name);
                        $("#edit .code").val(data.code);
                        $("#edit .id").val(item.data("id"))
                        $('#edit').modal('show');
                    }
                })
            });
        })
    </script>
@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#add" value="新增">
            </div>
            <table class="table table-striped">
                <tr>
                    <th width="80%">权限名</th>
                    <td>操作</td>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item["name"]}}</td>

                        <td><span class="glyphicon glyphicon-pencil"></span>
                            <a data-id="{{$item["id"]}}" class="edit" href="javascript:void(0)" >编辑</a>
                            &nbsp;&nbsp;
                            <span class=" glyphicon glyphicon-minus"></span>
                           <a href="/admin/role/delete?id={{$item["id"]}}" href="javascript:void(0)" >删除</a></td>
                    </tr>
                @endforeach
            </table>
            {{$data->links()}}
        </div>
    </div>
@stop

@section("modal")
    @include("admin.permission.add",["id"=>"add","action"=>"add","title"=>"新增权限"])
    @include("admin.permission.add",["id"=>"edit","action"=>"edit","title"=>"编辑权限"])
@append