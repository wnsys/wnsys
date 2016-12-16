<!DOCTYPE html>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container ">
    <div class="row center-block" style="width:500px;margin-top:100px;">
        <div class="panel panel-default">
            <div class="panel-heading text-center">后台系统</div>
            <div class="panel-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-2 control-label">账号</label>
                        <div class="col-xs-8 ">
                            <input type="text" class="form-control" name="info[user_name]" value=""/>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label">密码</label>
                        <div class="col-xs-8 ">
                            <input type="password" class="form-control" name="info[password]" value=""/>
                        </div>
                    </div>
                    <div class="text-center">
                    <input type="submit" class="btn btn-primary " style="width:100px;" name="dosubmit" value="登录">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>