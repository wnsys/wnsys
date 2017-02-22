@extends('modal.common')
@section("title")
    {{$title}}
@overwrite
@section("form")
    <form class="form-horizontal model-form" method="post" action="/admin/image/save">
        @show
        @section('message')
            <input type="hidden" class="form-control id" name="id"
                   v-model="id">
            <div class="form-group">
                <label class="control-label col-md-4">标题</label>
                <div class="col-md-5">
                    <input type="text" class="form-control user_name" name="title"
                           v-model="title">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">跳转地址</label>
                <div class="col-md-5">
                    <input type="text" class="form-control jump_url" name="jump_url"
                           v-model="jump_url">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">排序</label>
                <div class="col-md-5">
                    <input type="text" class="form-control sort" name="sort"
                           v-model="sort">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4"></label>
                <div class="col-md-5">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="">设为缩略图
                        </label>
                    </div>
                </div>
            </div>
        @overwrite
        @section("footer")
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <input type="button" class="btn btn-primary" name="dosubmit" v-on:click="save" value="提交"/>
        @overwrite
        @section("modeljs")
            <script>
                var app = new Vue({
                    el: '#app',
                    data: {
                        id:"",
                        title: "",
                        jump_url: "",
                        sort: ""
                    },
                    methods: {
                        imageEdit: function (id) {
                            var self = this
                            $.ajax({
                                url: "/admin/image/get?id=" + id,
                                success: function (data) {
                                    self.id = data.data.id;
                                    self.title = data.data.title;
                                    self.jump_url = data.data.jump_url;
                                    self.sort = data.data.sort;
                                }
                            })
                        },
                        save: function () {
                            $.post("/admin/image/save",$(".model-form").serialize(),function (data) {
                                $("#{{$id}}").modal("hide");
                                alert("保存成功")
                            })
                        }
                    }
                })
            </script>
@overwrite