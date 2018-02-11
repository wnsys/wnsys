var thumbnailWidth = 110,
    thumbnailHeight = 110,
    addAttch  = [],
    delAttch = [];

function createUpload(id,config){
    config = config || {};
    defaults = {
        pk_type:"none",
        length:5,
        extensions:"gif,jpg,jpeg,bmp,png,rar,zip,doc,xls,docx,xlsx,pdf,ppt",
        mimeTypes:'image/jpg,image/jpeg,image/png,image/gif,application/msword,application/vnd.ms-excel,application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    }
    // 合并默认配置
    for (var i in defaults) {
        if (config[i] === undefined) config[i] = defaults[i];
    };
    WebUploader.create({
        // 选完文件后，是否自动上传。
        auto: true,
        // swf文件路径
        swf: '/js/webuploader/Uploader.swf',
        // 文件接收服务端。
        server: '/admin/blog/upload',
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker'+id,
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: config.extensions,
            mimeTypes: config.mimeTypes
        }
    }).on('fileQueued', function (file) {
        if($(".thumbnail").length>=config.length){
            alert("最多只能上传"+config.length+"个附件")
            uploader.cancelFile( file );
            return;
        }
        var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                '<img>' +
                '<div class="info">' + file.name + '</div>' +
                '</div>'
            ),
            $img = $li.find('img');
        $btns = $('<div class="file-panel">' +
            '<span class="glyphicon glyphicon-remove cancel"></span>' ).appendTo($li);
        // $list为容器jQuery实例
        $("#fileList"+id).append($li);
        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100

        this.makeThumb(file, function (error, src) {
            if (error) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }
            $img.attr('src', src);
        }, thumbnailWidth, thumbnailHeight);
    }).on('uploadProgress', function (file, percentage) {
        var $li = $('#' + file.id),
            $percent = $li.find('.progress span');
        // 避免重复创建
        if (!$percent.length) {
            $percent = $('<p class="progress"><span></span></p>')
                .appendTo($li)
                .find('span');
        }
        $percent.css('width', percentage * 100 + '%');
    }).on('uploadSuccess', function (file, data) {
        addAttch.push(data.image_id);
        $('#' + file.id).append('<span class="success"></span>');
        $('#' + file.id).attr("image_id",data.image_id);
    }).on('uploadError', function (file, data) {
        var $li = $('#' + file.id),
            $error = $li.find('div.error');
        // 避免重复创建
        if (!$error.length) {
            $error = $('<div class="error"></div>').appendTo($li);
        }
        $error.text('上传失败');
    }).on('uploadComplete', function (file, data) {
        $('#' + file.id).find('.progress').remove();
    }).on('uploadFinished', function (file, data) {
        var add = addAttch.join(",");
        $("input[name='imgs"+id+"[add]']").val(add);

    });
    upload(id)
}
function upload(id) {
    idupload = "#uploader"+id
    $(idupload).on('mouseenter','.thumbnail', function () {
        $(this).find(".file-panel").stop().animate({height: 30});
    });

    $(idupload).on('mouseleave','.thumbnail', function () {
        $(this).find(".file-panel").stop().animate({height: 0});
    });
    $(idupload).on('click','.add .cancel', function () {
        var thumb = $(this).parent().parent();
        addAttch.remove(thumb.attr("image_id"));
        var tt = addAttch.join(",");
        $(this).parent().parent().remove();
    });
    $(idupload).on('click','.list .cancel', function () {
        var thumb = $(this).parent().parent();
        delAttch.push(thumb.attr("image_id"));
        var del = delAttch.join(",");
        $("input[name='imgs"+id+"[del]']").val(del)
        $(this).parent().parent().remove();
    });
    $(idupload).on('click','.edit', function () {
        $("#imageEdit"+id).modal("show");
    });
}
// 初始化Web Uploader
Array.prototype.indexOf = function(val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == val) return i;
    }
    return -1;
};
Array.prototype.remove = function(val) {
    var index = this.indexOf(val);
    if (index > -1) {
        this.splice(index, 1);
    }
};