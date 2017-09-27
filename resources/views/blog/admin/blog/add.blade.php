@extends('blog.admin')
@section("js")
  @include("common.editor")
    <script>
        $(function () {
           createUpload(1)
        })
    </script>
@endsection
@section('right-content')
    <style>
        #container img {
            width: 100%;
        }
    </style>
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-horizontal" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="info[id]" value="{{$_GET["id"]}}">
                <div class="form-group">
                    <label class="control-label col-md-1">标题</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="info[title]" value="{{$data["title"]}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1">分类</label>
                    <div class="col-md-2">
                        <select class="form-control" name="info[catid]">
                            {!!$options!!}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1">内容</label>
                    <div class="col-md-11">
                        <script id="container" name="info[content]" type="text/plain">
                            {!!$data["content"]!!}
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1">附件</label>
                    <div class="col-md-11">
                        @include("common.webUploadSimple",["list"=>1])
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1">创建时间</label>
                    <div class="col-md-11">
                        {{$data["created_at"]}}
                    </div>
                </div>
                <div class="center-block text-center">
                    <input type="submit" class="btn btn-primary " style="width:100px;" name="dosubmit" value="提交">
                </div>

            </form>
        </div>
    </div>
@endsection