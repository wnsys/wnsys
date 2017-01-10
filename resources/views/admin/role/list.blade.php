@extends('admin.setting')
@section("js")
    <script>
        $().ready(function(){
            $(".edit").click(function () {
                self = $(this)
                $.ajax({
                    url:"/admin/role/get?id="+self.data("id"),
                    dataType:"json",
                    success:function (data) {
                        $("#edit #name").val(data.name);
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
                    <th>角色名</th>
                    <th>创建时间</th>
                    <td>操作</td>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item["name"]}}</td>
                        <td>{{$item["created_at"]}}</td>
                        <td><a data-id="{{$item["id"]}}" class="edit" >编辑</a>
                            | <a href="/admin/role/delete?id={{$item["id"]}}">删除</a></td>
                    </tr>
                @endforeach
            </table>
            {{$data->links()}}
        </div>
    </div>
@append

@section("modal")
    @include("admin.role.add",["id"=>"add","action"=>"add"])
    @include("admin.role.add",["id"=>"edit","action"=>"edit"])
@stop