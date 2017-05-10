@extends('modal.common')
@section("title")
    {{$title}}
@overwrite
@section("form")
    <form class="form-horizontal" id="form{{$action}}">
@overwrite
@section('message')
            <input type="hidden" name="id" class="id" v-model="{{$action}}_id">
            <div class="form-group">
                <label class="control-label col-md-4">账号</label>
                <div class="col-md-5">
                    <input type="text" class="form-control user_name" name="info[user_name]"
                           v-model="{{$action}}_user_name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">密码</label>
                <div class="col-md-5">
                    <input type="password" class="form-control password" name="info[password]"
                           >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">确认密码</label>
                <div class="col-md-5">
                    <input type="password" class="form-control password_confirmation"
                           name="info[password_confirmation]">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">角色</label>
                <div class="col-md-5">
                    <select class="form-control role" name="role_id" v-model="{{$action}}_role_id">
                        @foreach($roles as $item)
                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
@overwrite
@section("modal-footer")
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <input type="button" class="btn btn-primary" name="button" v-on:click="save('form{{$action}}')"
                   value="提交"/>
@overwrite