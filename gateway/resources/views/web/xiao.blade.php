@extends('layouts.web')
@section("left-content")
    @include("web.left")
@stop
@section("right-content")
    <style>
        .gongshi{
            font-size:12px;
            color:#ccc;
        }
    </style>
    <div class="panel panel-default">
        <div class="panel-heading">
            基本公式（陈正生）
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-2">声速</label>
                    <div class="col-md-7">
                        <input class="form-control" name="shengsu" id="shengsu" value="33140">
                    </div>
                    <div class="col-md-1">cm/s</div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">温度t</label>
                    <div class="col-md-7">
                        <input class="form-control" name="wendu"  id="wendu">
                    </div>
                    <div class="col-md-1">℃</div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">固定频率f</label>
                    <div class="col-md-7">
                        <input class="form-control" name="pinlv" id="pinlv" value="">

                    </div>
                    <div class="col-md-1">赫兹</div> <div class="col-md-2"><input class="btn btn-primary" id="btnPinlv" type="button" value="计算"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">实际管长L</label>
                    <div class="col-md-7">
                        <input class="form-control" name="guanchang" id="guanchang" value="">
                        <div class="gongshi">实际管长=波长-校正</div>
                    </div>
                    <div class="col-md-1">cm</div><div class="col-md-2"><input class="btn btn-primary" id="btnGuanchang" type="button" value="计算"></div>

                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">理论管长(入)</label>
                    <div class="col-md-7">
                        <input class="form-control" name="bochang"  id="bochang" value="">
                        <div class="gongshi">理论管长=声速/（2*固定频率）</div>
                    </div>
                    <div class="col-md-1">cm</div> <div class="col-md-2"><input class="btn btn-primary" id="btnBochang" type="button" value="计算"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">管口校正(Ａ整)</label>
                    <div class="col-md-7">
                        <input class="form-control" name="jiaozheng" id="jiaozheng" value="">
                        <div class="gongshi">校正=波长-管长</div>
                    </div>
                    <div class="col-md-1">cm</div> <div class="col-md-2"><input class="btn btn-primary" id="btnJiaozheng" type="button" value="计算"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">误差音分</label>
                    <div class="col-md-7">
                        <input class="form-control" name="wucha" id="wucha" value="">
                        <div class="gongshi">每低10音分校正量加2mm估算 </div>

                    </div>
                    <div class="col-md-1"></div> <div class="col-md-2"><input class="btn btn-primary" id="btnWucha" type="button" value="修正校正"></div>
                </div>
            </form>
        </div>

    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            备注
        </div>
        <div class="panel-body">
            助音孔边缘间距1cm,孔直径8mm （陈正生）<br>
            每低10音分校正量加2mm估算 （陈正生）<br>
            助音长度÷1.067=基音长度 (望月山人)<br>
            注音长度 = 管长 * （实际频率/期望频率）- （0.9到1.1之间取值） （望月山人）<br>
            吹口的宽度是内径的一半左右，吹口的深度是宽度的一半左右。比如内径18的竹子，吹口一般宽9毫米，深4.5-5毫米。大概有这么个概念就可以，我一般靠目测，基本不量。关于吹口内沿的斜度，我在之前的贴子里讲的是45-60度，最近制作的一般都超过60度 （望月山人）
        </div>
        </div>
<script>
    $(function () {
        $(".btn").on("click",function(){
            //(声速+61*温度)/频率
            var shengsu = parseFloat($("#shengsu").val());
            var wendu = parseFloat($("#wendu").val());
            var pinlv = parseFloat($("#pinlv").val())
            var guanchang = parseFloat($("#guanchang").val());
            if($(this).attr("id") == "btnBochang"){
                var bochang = getbochang(shengsu,wendu,pinlv);
                $("#bochang").val(bochang.toFixed(2));
            }
            if($(this).attr("id") == "btnJiaozheng"){
                var bochang = getbochang(shengsu,wendu,pinlv);
                var jiaozheng = bochang-guanchang;
                $("#jiaozheng").val(jiaozheng.toFixed(2));
            }
            if($(this).attr("id") == "btnGuanchang"){
                var bochang = getbochang(shengsu,wendu,pinlv);
                var guanchang = bochang- $("#jiaozheng").val();
                $("#guanchang").val(guanchang.toFixed(2));
            }
        });
        $("#btnWucha").on("click",function () {
            var wucha = parseFloat($("#wucha").val());
            var jiaozheng = parseFloat($("#jiaozheng").val());
            var rs = (wucha/10)*2/10
            $("#jiaozheng").val((jiaozheng+(-rs)).toFixed(2));
        })
    })
    function getbochang(shengsu,wendu,pinlv) {
         return  (shengsu+61*wendu)/(2*pinlv);
    }
</script>
@stop
