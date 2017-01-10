@extends('modal.common')
@section("title")
    新增角色
@stop
@section("form")
    <form class="form-horizontal" method="post" action="/admin/role/{{$action}}">
@stop
@section('message')
        <div class="form-group">
            <label class="control-label col-md-4">角色名称</label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="info[name]" id="name" value="">
            </div>
        </div>
@stop