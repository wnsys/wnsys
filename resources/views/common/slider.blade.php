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