@extends('shop')
@section("right")
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3 control-label">姓名</label>
                <div class="col-md-9">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">手机号</label>
                <div class="col-md-9">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">收货地址</label>
                <div class="col-md-9">
                    <input type="text" class="form-control">
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
