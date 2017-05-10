@extends('layouts.admin')
@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-horizontal" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label class="control-label col-md-1">产品名称</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="name" value="{{$data["name"]}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1">分类</label>
                    <div class="col-md-2">
                        <select class="form-control" name="catid">
                            {!!$options!!}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1">价格</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" style="width:80%;display: inline-block" name="price"
                               value="{{$data["price"]}}">元
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-md-1">描述</label>
                    <div class="col-md-11">
                        <textarea type="text" class="form-control" name="description"
                               >{{$data["description"]}}</textarea>
                    </div>

                </div>
                <div class="form-group">
                    <label class="control-label col-md-1">内容</label>
                    <div class="col-md-11">
                        <script id="container" name="content" type="text/plain">

                            {!!$data["content"]!!}
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1">附件</label>
                    <div class="col-md-11">
                        @include("common.webUploadSimple")
                    </div>
                </div>

                <div class="center-block text-center">
                    <input type="submit" class="btn btn-primary " style="width:100px;" name="dosubmit" value="提交">
                </div>

            </form>
        </div>
    </div>
@endsection
