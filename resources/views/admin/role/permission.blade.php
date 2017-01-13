@extends('modal.common')
@section("title")
    {{$title}}
@overwrite
@section("form")
    <form class="form-horizontal" method="post" action="/admin/permission/{{$action}}">
        <input type="hidden" name="id" class="id" value="">
        @overwrite
        @section('message')
            <div class="form-group">
                <label class="control-label col-md-4">角色名称</label>
                <div class="col-md-5">
                   <label class="control-label name"></label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">选择权限</label>
                <div class="col-md-5">
                    <select multiple="multiple" name="permissionid" class="form-control" id="permissionid" style="height:300px">
                        {!! $options !!}
                    </select>
                </div>
            </div>
@overwrite