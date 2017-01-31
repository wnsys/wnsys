<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('left')
    @include('left')
@endsection
@section("js")
    <script>

        var app = new Vue({
            el: '#app',
            data: {
                add_id:"",
                add_user_name:"",
                add_password:"",
                add_check_password:"",
                edit_id:"",
                edit_user_name:"",
                edit_password:"",
                edit_check_password:"",

            },
            methods:{
                get:function (id) {
                    t = this;
                    $.ajax({
                        url:"/admin/member/get?id="+id,
                        dataType:"json",
                        success:function (data) {
                            t.edit_user_name = data.user_name;
                            t.edit_id = data.id;
                            $("#modelEdit").modal("show");
                        }
                    })
                },
                add:function () {
                    $("#modelAdd").modal("show");
                },
                save:function (formid) {
                    $.ajax({
                        url: "/admin/member/save?_token="+window.Laravel.csrfToken,
                        data: $('#' + formid).serialize(),
                        type: "post",
                        success: function (data) {
                            alert(data)
                        }
                    })
                }
            }
        })
    </script>
@stop
@section('content')

    <div class="panel panel-default" >
        <div class="panel-body">
            <div class="form-group">
                <input type="submit" v-on:click="add" class="btn btn-primary" id="add" value="新增">
            </div>
            <form class="form-inline">
                <div class="form-group">
                    <label for="cat_name">账号</label>
                    <input type="text" class="form-control" name="user_name">
                </div>

                <input type="submit" class="btn btn-primary" value="搜索">
            </form>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped ">
                <tr>
                    <th class="col-xs-4 col-md-7">账号</th>
                    <td class="col-xs-4 col-md-2">操作</td>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td><a href="" target="_blank">{{$item["user_name"]}}</a></td>
                        <td><a  class="edit" v-on:click="get({{$item["id"]}})" >编辑</a>
                            | <a href="/admin/member/delete?id={{$item["id"]}}"
                                 onclick="return confirm('确定删除吗？')">删除</a></td>
                    </tr>
                @endforeach
            </table>
            {{$data->links()}}
        </div>
    </div>
@endsection

@section("modal")
    @include("member.member.add",["id"=>"modelAdd","action"=>"add","title"=>"新增用户"])
    @include("member.member.add",["id"=>"modelEdit","action"=>"edit","title"=>"编辑用户"])
@append

