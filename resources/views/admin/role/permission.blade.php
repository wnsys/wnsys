@extends('modal.common')
@section("title")
    {{$title}}
@overwrite
@section("form")
    <form class="form-horizontal" method="post" action="/admin/permission/save">
        <input type="hidden" name="info[pk_id]" class="pk_id" value="">
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
                    <select multiple="multiple" name="permission_id[]" class="form-control permission_id"  style="height:300px">
                        {!! $options !!}
                    </select>
                </div>
            </div>
@overwrite