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
                <label class="control-label col-md-4">权限名称</label>
                <div class="col-md-5">
                    <input type="text" class="form-control name" name="info[name]" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">代码</label>
                <div class="col-md-5">
                    <input type="text" class="form-control code" name="info[code]" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">上级权限</label>
                <div class="col-md-5">
                    <select class="form-control" name="info[parentid]">
                        {!!$options!!}
                    </select>
                </div>
            </div>
@overwrite