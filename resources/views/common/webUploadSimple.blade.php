<link rel="stylesheet" type="text/css" href="/js/webuploader/webuploader.css"/>
<link rel="stylesheet" type="text/css" href="/js/webuploader/style.css"/>
<script type="text/javascript" src="/js/webuploader/webuploader.min.js"></script>
<!--dom结构部分-->
<div id="uploader-demo">
    <div class="uploader-list">
        @foreach($data->image() as $img)
            <div class="file-item thumbnail">
                <img src="{{$img->url}}">
                <div class="info">{{$img->title}}</div>
                <div class="file-panel">
                    <span class="cancel">删除</span>
                    <span class="rotateRight">向右旋转</span>
                    <span class="rotateLeft">向左旋转</span>
                </div>
            </div>
        @endforeach
    </div>
    <!--用来存放item-->
    <div id="fileList" class="uploader-list"></div>
    <div id="filePicker">选择图片</div>
</div>
<script type="text/javascript" src="/js/webuploader/simple.js"></script>


