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
                <label class="control-label col-md-4">角色名称</label>
                <div class="col-md-5">
                    <input type="text" class="form-control name" name="info[name]" value="">
                </div>
            </div>
@overwrite