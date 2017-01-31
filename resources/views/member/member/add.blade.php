@extends('modal.common')
@section("title")
    {{$title}}
@overwrite
@section("form")
    <form class="form-horizontal" method="post" action="/admin/member/{{$action}}">

@overwrite
@section('message')
            <input type="hidden" name="id" class="id" @if($id == "modelEdit") v-model="id" @endif>
            <div class="form-group">
                <label class="control-label col-md-4">账号</label>
                <div class="col-md-5">
                    <input type="text" class="form-control user_name" name="info[user_name]" @if($id == "modelEdit") v-model="user_name" @endif >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">密码</label>
                <div class="col-md-5">
                    <input type="text" class="form-control password" name="info[password]"  >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">确认密码</label>
                <div class="col-md-5">
                    <input type="text" class="form-control check_password" name="info[check_password]">
                </div>
            </div>
@overwrite