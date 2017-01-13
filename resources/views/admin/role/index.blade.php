@extends('admin.setting')
@section("js")
    <script>
        $().ready(function(){
            $(".edit").click(function () {
                $("#edit .name").val($(this).data("name"));
                $("#edit .id").val($(this).data("id"))
                $('#edit').modal('show');
            });

            $(".permission").click(function () {
                item = $(this);
                $("#permission .name").text(item.data("name"));
                $("#permission .pk_id").val(item.data("id"));
                $.ajax({
                    url:"/admin/role/get?id="+item.data("id"),
                    success:function (data) {
                        $("#permission .permission_id").text(data.permission_id);
                        $('#permission').modal('show');
                    }
                })

            })
        })
    </script>
@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#add" value="新增">
            </div>
            <table class="table table-striped col-md-4" >
                <tr>
                    <th width="80%">角色名</th>
                    <td>操作</td>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item["name"]}}</td>

                        <td><span class="glyphicon glyphicon-pencil"></span>
                            <a data-id="{{$item["id"]}}" data-name="{{$item["name"]}}" class="edit" href="javascript:void(0)" >编辑</a>
                            &nbsp;&nbsp;
                            <span class="glyphicon glyphicon-glass"></span>
                            <a data-id="{{$item["id"]}}" data-name="{{$item["name"]}}" class="permission" href="javascript:void(0)" >权限</a>
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
    @include("admin.role.add",["id"=>"add","action"=>"add","title"=>"新增角色"])
    @include("admin.role.add",["id"=>"edit","action"=>"edit","title"=>"编辑角色"])
    @include("admin.role.permission",["id"=>"permission","options"=>$options,"title"=>"选择权限"])
@append