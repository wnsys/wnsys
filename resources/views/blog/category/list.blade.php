<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('left')
    @include('blog.left')
@endsection
@section('content')
    <p>栏目列表</p>
    <div>
        {!! $lists !!}
    </div>
@endsection