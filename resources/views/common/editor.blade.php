<script type="text/javascript" src="/statics/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/statics/ueditor/ueditor.all.min.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">

            @if(is_mobile())
    var ue = UE.getEditor('container', {
                initialFrameHeight: 150,
                toolbars: [['bold', 'italic', 'underline', 'simpleupload', 'forecolor', 'backcolor']],
            });
            @else
    var ue = UE.getEditor('container', {
                initialFrameHeight: 400
            });
    @endif


</script>