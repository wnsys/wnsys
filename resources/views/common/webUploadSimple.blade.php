<link rel="stylesheet" type="text/css" href="/js/webuploader/webuploader.css"/>
<link rel="stylesheet" type="text/css" href="/js/webuploader/style.css"/>
<script type="text/javascript" src="/js/webuploader/webuploader.min.js"></script>
<!--dom结构部分-->
<div id="uploader">
    <input type="hidden" name="info[attach_add]" id="attach_add">
    <input type="hidden" name="info[attach_del]" id="attach_del">
    @if($data)
        <div class="uploader-list list">
            @foreach($data->image() as $img)
                <div class="file-item thumbnail" image_id="{{$img["id"]}}">
                    <img src="{{$img->url}}">
                    <div class="info">{{$img->title}}</div>
                    <div class="file-panel">
                        <span class="glyphicon glyphicon-minus cancel"></span>
                        <span class="glyphicon glyphicon-pencil edit"  v-on:click="imageEdit"></span>

                    </div>
                </div>
            @endforeach
        </div>
@endif
<!--用来存放item-->
    <div id="fileList" class="uploader-list add"></div>
    <div id="filePicker">选择图片</div>
</div>
<script type="text/javascript" src="/js/webuploader/simple.js"></script>


