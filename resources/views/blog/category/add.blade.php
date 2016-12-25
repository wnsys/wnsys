@extends('layouts.admin')
@section("js")
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.min.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        $(function () {
            var ue = UE.getEditor('container', {
                initialFrameHeight:400
            });
        })
    </script>
    @endsection
@section('left')
    @include('blog.left')
@endsection
@section('content')
    <div >
        <form class="form-horizontal" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-md-1">名称</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="info[name]" value="{{$data["name"]}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1">分类</label>
                <div class="col-md-2">
                    <select class="form-control" name="info[parentid]">
                        <option value="0">未选择</option>
                        {!!$options!!}
                    </select>
                </div>
            </div>

            <div class="center-block text-center" >
                <input type="submit" class="btn btn-primary " style="width:100px;" name="dosubmit" value="提交">
            </div>

        </form>
    </div>

@endsection