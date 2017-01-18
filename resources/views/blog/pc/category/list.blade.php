<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('left')
    @include('left')
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <p>栏目列表</p>
            <div>
                {!! $lists !!}
            </div>
        </div>
    </div>
@endsection