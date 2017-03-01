@include("common.header")
<div class="container center-block pad5 <?php echo app()["module"]?"container-".app()["module"]:"";?>">
        @section('content')
        @show
</div>
@section('modal')
@show
@section("footer")
    @include("common.footer")
@show
