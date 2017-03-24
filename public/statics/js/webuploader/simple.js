$().ready(function () {

    var // 缩略图大小
        thumbnailWidth = 110,
        thumbnailHeight = 110,
        addAttch  = new Array(),
        delAttch = new Array(),
        uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: '/js/webuploader/Uploader.swf',
            // 文件接收服务端。
            server: 'http://www.wnsys.net/admin/blog/upload',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

// 当有文件添加进来的时候
    uploader.on('fileQueued', function (file) {
        var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                '<img>' +
                '<div class="info">' + file.name + '</div>' +
                '</div>'
            ),
            $img = $li.find('img');
        $btns = $('<div class="file-panel">' +
            '<span class="glyphicon glyphicon-minus cancel"></span>' ).appendTo($li);
        // $list为容器jQuery实例
        $("#fileList").append($li);
        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb(file, function (error, src) {
            if (error) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }
            $img.attr('src', src);
        }, thumbnailWidth, thumbnailHeight);
    });
// 文件上传过程中创建进度条实时显示。
    uploader.on('uploadProgress', function (file, percentage) {
        var $li = $('#' + file.id),
            $percent = $li.find('.progress span');
        // 避免重复创建
        if (!$percent.length) {
            $percent = $('<p class="progress"><span></span></p>')
                .appendTo($li)
                .find('span');
        }
        $percent.css('width', percentage * 100 + '%');
    });

// 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on('uploadSuccess', function (file, data) {
        addAttch.push(data.image_id);
        $('#' + file.id).append('<span class="success"></span>');
        $('#' + file.id).attr("image_id",data.image_id);
    });

// 文件上传失败，显示上传出错。
    uploader.on('uploadError', function (file, data) {
        var $li = $('#' + file.id),
            $error = $li.find('div.error');
        // 避免重复创建
        if (!$error.length) {
            $error = $('<div class="error"></div>').appendTo($li);
        }
        $error.text('上传失败');
    });

// 完成上传完了，成功或者失败，先删除进度条。
    uploader.on('uploadComplete', function (file, data) {
        $('#' + file.id).find('.progress').remove();
    });
// 完成上传完了，成功或者失败，先删除进度条。
    uploader.on('uploadFinished', function (file, data) {
        var add = addAttch.join(",");
        $("#attach_add").val(add);

    });
    upload()
})
function upload() {
    $('#uploader').on('mouseenter','.thumbnail', function () {
        $(this).find(".file-panel").stop().animate({height: 30});
    });

    $('#uploader').on('mouseleave','.thumbnail', function () {
        $(this).find(".file-panel").stop().animate({height: 0});
    });
    $('#uploader').on('click','.add .cancel', function () {
        var thumb = $(this).parent().parent();
        addAttch.remove(thumb.attr("image_id"));
        var tt = addAttch.join(",");
        $(this).parent().parent().remove();
    });
    $('#uploader').on('click','.list .cancel', function () {
        var thumb = $(this).parent().parent();
        delAttch.push(thumb.attr("image_id"));
        var del = delAttch.join(",");
        $("#attach_del").val(del)
        $(this).parent().parent().remove();
    });
    $('#uploader').on('click','.edit', function () {
        $("#imageEdit").modal("show");
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