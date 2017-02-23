@extends('layouts.shop')

@section("css")
    <link href="/js/unslider/css/unslider.css" rel="stylesheet">
    <link href="/js/unslider/css/unslider-dots.css" rel="stylesheet">

    <style>
        .banner { position: relative; overflow: auto; }
        .banner li { list-style: none; }
        .banner ul li { float: left; }
    </style>
@stop
@section("js")
    <script src="/js/unslider/js/unslider-min.js"></script>

    <script src="/js/unslider/js/jquery.event.move.js"></script>
    <script src="/js/unslider/js/jquery.event.swipe.js"></script>
    <script>
        $(function () {
            $('.banner').unslider({
                speed: 500,               //  The speed to animate each slide (in milliseconds)
                delay: 3000,              //  The delay between slide animations (in milliseconds)
                complete: function () {
                },  //  A function that gets called after every slide animation
                keys: true,               //  Enable keyboard (left, right) arrow shortcuts
                dots: true,               //  Display dot navigation
                fluid: false              //  Support responsive design. May break non-responsive designs
            });
        })

    </script>
@stop
@section("shop")
    <div class="banner">
        <ul class="list-inline">
            @foreach($data->image() as $item)
                <li class="text-center"><a ><img style="width:100%;max-width: 500px" class="img-rounded" src="{{$item->thumb(500,500)}}"></a></li>
            @endforeach
        </ul>
    </div>
    <h3>{{$data[name]}}</h3>
    <div class="blog-content ">
        {!!$data[content]!!}
    </div>


@endsection
