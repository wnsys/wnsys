@extends('modal.common')
@section("title")
    {{$title}}
@overwrite
@section("form")
    <form class="form-horizontal" method="post" action="/admin/role/{{$action}}">
        <input type="hidden" name="id" class="id" value="">
        @overwrite
        @section('message')
            <div class="form-group">
                <label class="control-label col-md-4">账号</label>
                <div class="col-md-5">
                    <input type="text" class="form-control name" name="info[user_name]" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">密码</label>
                <div class="col-md-5">
                    <input type="text" class="form-control name" name="info[password]" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">确认密码</label>
                <div class="col-md-5">
                    <input type="text" class="form-control name" name="info[check_password]" value="">
                </div>
            </div>
@overwrite