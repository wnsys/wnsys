@extends('admin')
@section('right-content')
    <div class="panel panel-default">
        <div class="panel-body">
            <p>分类列表</p>
            <div>
                <table class="table table-striped">
                    <tr>
                        <th class="col-xs-7 col-lg-8">权限名</th>
                        <td>操作</td>
                    </tr>
                    {!! $lists !!}
                </table>
            </div>
        </div>
    </div>
@endsection