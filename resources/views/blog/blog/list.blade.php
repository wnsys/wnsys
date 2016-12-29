<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('left')
    @include('blog.left')
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline">
                <div class="form-group">
                    <label for="cat_name">栏目</label>
                   <?php echo \App\Module\Blog\Bll\CategoryBll::formSelect("catid",$_GET["catid"]);?>
                </div>

                <input type="submit" class="btn btn-primary" value="搜索">
            </form>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>标题</th>
                    <th>创建时间</th>
                    <td>操作</td>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item["title"]}}</td>
                        <td>{{$item["created_at"]}}</td>
                        <td><a href="/admin/blog/edit?id={{$item["id"]}}">编辑</a>
                            | <a href="/admin/blog/delete?id={{$item["id"]}}">删除</a></td>
                    </tr>
                @endforeach
            </table>
            {{$data->links()}}
        </div>
    </div>
@endsection