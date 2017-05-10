<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('right-content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-inline">
                <div class="form-group">
                    <label for="cat_name">栏目</label>
                    <?php echo $catlist;?>
                </div>

                <input type="submit" class="btn btn-primary" value="搜索">
            </form>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped " >
                <tr>
                    <th class="col-xs-8 col-md-7">标题</th>
                    {{-- <th class="col-xs-4 col-md-3">创建时间</th>--}}
                    <td class="col-xs-4 col-md-2">操作</td>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td><a href="/blog/{{$item["id"]}}" target="_blank">{{$item["title"]}}</a></td>
                        {{-- <td>{{$item["created_at"]}}</td>--}}
                        <td><a href="/admin/blog/edit?id={{$item["id"]}}">编辑</a>
                            | <a href="/admin/blog/delete?id={{$item["id"]}}" onclick="return confirm('确定删除吗？')">删除</a></td>
                    </tr>
                @endforeach
            </table>
            {{$data->links()}}
        </div>
    </div>
@endsection