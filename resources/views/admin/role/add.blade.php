@extends('admin.setting')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
        <form class="form-horizontal" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label class="control-label col-md-1">标题</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="info[name]" value="{{$data["name"]}}">
                </div>
            </div>

            <div class="center-block text-center">
                <input type="submit" class="btn btn-primary " style="width:100px;" name="dosubmit" value="提交">
            </div>

        </form>
    </div>
    </div>
@endsection