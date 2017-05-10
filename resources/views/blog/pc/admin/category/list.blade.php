@extends('admin')
@section('right-content')
    <div class="panel panel-default">
        <div class="panel-body">
            <p>栏目列表</p>
            <div>
                <table class="table table-striped">
                    <tr>
                        <th class="col-xs-7 col-lg-8">名称</th>
                        <td>操作</td>
                    </tr>
                    {!! $lists !!}
                </table>
            </div>
        </div>
    </div>
@endsection