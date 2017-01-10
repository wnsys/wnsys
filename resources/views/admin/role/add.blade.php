<!-- 模态框（Modal） -->
<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="{{$id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" method="post" action="/admin/role/{{$action}}">
                <input type="hidden"  name="id" id="id"  value="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="{{$id}}Label">{{$title}}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-4">角色名称</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="info[name]" id="name" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <input type="submit" class="btn btn-primary" name="dosubmit" value="提交"/>

                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>