<link rel="stylesheet" type="text/css" href="/statics/js/webuploader/webuploader.css"/>
<link rel="stylesheet" type="text/css" href="/statics/js/webuploader/style.css"/>
<script type="text/javascript" src="/statics/js/webuploader/webuploader.min.js"></script>
<!--dom结构部分-->
<div id="uploader<?php echo $list;?>" class="uploader" >
    <input type="hidden" name="imgs<?php echo $list;?>[add]" >
    <input type="hidden" name="imgs<?php echo $list;?>[del]" >
    @if($data)
        <div class="uploader-list list">
            @foreach($data->image() as $img)
                <div class="file-item thumbnail" image_id="{{$img["id"]}}">
                    <img src="{{$img->url}}">
                    <div class="info">{{$img->original}}</div>
                    <div class="file-panel">
                        <span class="glyphicon glyphicon-minus cancel"></span>
                        <span class="glyphicon glyphicon-pencil edit"  v-on:click="imageEdit({{$img[id]}})"></span>

                    </div>
                </div>
            @endforeach
        </div>
@endif
<!--用来存放item-->
    <div id="fileList<?php echo $list;?>" class="uploader-list add"></div>
    <div id="filePicker<?php echo $list;?>" data-id="<?php echo $list;?>" class="filePicker">选择图片</div>
</div>
<script type="text/javascript" src="/statics/js/webuploader/simple.js"></script>


