@extends('blog.admin')
@section('right-content')
    <div class="panel panel-default">
        <div class="panel-body">
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
                            {!!$options!!}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1">列表模板</label>
                    <div class="col-md-2">
                        <select class="form-control" name="info[template]">
                            @foreach($templates as $template)
                                <option value="{{$template}}" @if($template == $data["template"]) selected @endif>{{$template}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1">内容模板</label>
                    <div class="col-md-2">
                        <select class="form-control" name="info[template_show]">
                            @foreach($templates_show as $template)
                                <option value="{{$template}}" @if($template == $data["template_show"]) selected @endif>{{$template}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1"></label>
                    <div class="col-md-2">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="info[hidden]" <?php echo $data["hidden"] == 1?"checked":""?>>隐藏栏目
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-offset-1">
                    <input type="submit" class="btn btn-primary " style="width:100px;" name="dosubmit" value="提交">
                </div>

            </form>
        </div>
    </div>

@endsection