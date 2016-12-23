@extends('layouts.admin')
@section("js")
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        $(function () {
            var ue = UE.getEditor('container');
        })

    </script>
    @endsection
@section('left')
    @include('blog.admin.left')
@endsection
@section('content')
    <div >
        <form class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-1">标题</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1">分类</label>
                <div class="col-md-2">
                    <select class="form-control">
                        <option>生活</option>
                        <option>技术</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1">内容</label>
                <div class="col-md-10">
                    <script id="container" name="content" type="text/plain">
        这里写你的初始化内容
    </script>
                </div>
            </div>
            <div class="center-block text-center" >
                <input type="submit" class="btn btn-primary " style="width:100px;" name="dosubmit" value="提交">
            </div>

        </form>
    </div>

@endsection