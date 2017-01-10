<!-- Stored in resources/views/child.blade.php -->

@extends('admin.setting')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">


        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>角色名</th>
                    <th>创建时间</th>
                    <td>操作</td>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item["name"]}}</td>
                        <td>{{$item["created_at"]}}</td>
                        <td><a href="/admin/role/edit?id={{$item["id"]}}">编辑</a>
                            | <a href="/admin/role/delete?id={{$item["id"]}}">删除</a></td>
                    </tr>
                @endforeach
            </table>
            {{$data->links()}}
        </div>
    </div>
@endsection