@extends('layouts.web')
@section("content")
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
        @section('blog')
        @show
    </div>
@endsection
