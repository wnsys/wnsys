<!-- 模态框（Modal） -->
<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="{{$id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @section("form")
                <form class="form-horizontal model-form" method="post">
                    @show
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="{{$id}}Label">@yield("title")</h4>
                    </div>
                    <div class="modal-body">
                        @section("message")
                            内容
                        @show
                    </div>
                    <div class="modal-footer">
                        @section("modal-footer")
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <input type="submit" class="btn btn-primary" name="dosubmit" value="提交" />
                        @show
                    </div>
                </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
@section("modeljs")
    @show