@include("common.header")
<div class="container center-block pad5 <?php echo app()["module"]?"container-".app()["module"]:"";?>">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                @section("left")
                    @include("web.left")
                @show
            </div>
        </div>
    </div>
    <div class="col-md-9">
        @section('content')
        @show
    </div>
<div>
@include("common.footer")
</body>
</html>