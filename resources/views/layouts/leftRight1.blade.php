@extends('layouts.web')
@section("content")
    <div class="container center-block pad10  container-blog">
        @section("left")
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @section("left-content")
                            @show
                    </div>
                </div>
            </div>

        @show
        <div class="col-md-9">
            @section('right')
            @show
        </div>
    </div>
@endsection

@section("css")
@append