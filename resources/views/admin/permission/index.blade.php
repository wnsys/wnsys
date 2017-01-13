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
                        $("#edit .parentid").html(data.options)
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
                    <th class="col-xs-7 col-lg-8">权限名</th>
                    <td>操作</td>
                </tr>
               {!! $data !!}
            </table>

        </div>
    </div>
@stop

@section("modal")
    @include("admin.permission.add",["id"=>"add","action"=>"add","title"=>"新增权限"])
    @include("admin.permission.add",["id"=>"edit","action"=>"edit","title"=>"编辑权限"])
@append