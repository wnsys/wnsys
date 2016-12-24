<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('left')
    @include('blog.left')
@endsection
@section('content')
    <p>博客列表</p>
    <div>
        <table class="table">
            <tr>
                <th>标题</th>
                <th>创建时间</th>
                <td>操作</td>
            </tr>
            @foreach($data as $item)
            <tr>
                <td>{{$item["title"]}}</td>
                <td>{{$item["created_at"]}}</td>
                <td><a href="/admin/blog/edit?id={{$item["id"]}}">编辑</a></td>
            </tr>
                @endforeach
        </table>
    </div>
@endsection