@extends('modal.common')
@section("title")
    {{$title}}
@overwrite
@section('message')
    <div class="form-group">
        <label class="control-label col-md-4">标题</label>
        <div class="col-md-5">
            <input type="text" class="form-control user_name" name="info[title]"
                   >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4">url</label>
        <div class="col-md-5">
            <input type="text" class="form-control user_name" name="info[url]"
                   >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-4">排序</label>
        <div class="col-md-5">
            <input type="text" class="form-control user_name" name="info[sort]"
                   >
        </div>
    </div>
@overwrite
@section("footer")
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <input type="button" class="btn btn-primary" name="dosubmit" value="提交"/>
@overwrite