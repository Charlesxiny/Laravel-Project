@extends('app')
@section('active_invite', 'active')
@section('nav_title', '邀请码管理')
@section('title', '邀请码申请')
@section('sub_title', '发放列表')
@section('header_extension')
    <div class="panel-heading">
            <button class="btn btn-success" type="button" onclick="delUsed(1)">
                删除所有已使用邀请码
            </button>
            <button class="btn btn-success" type="button" onclick="delUsed(0)">
                删除所有记录
            </button>
    </div>
@endsection
@section('main_content')
    <script>
        function delConfirm(id){
            $('#id_deny').val(id);
            $('#d_pop').modal('show');
        }
        function delUsed(control) {
            $('#control').val(control);
            $('#del_pop').modal('show');
        }
    </script>

    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>用户名</th>
            <th>所在大区</th>
            <th>邀请码</th>
            <th>使用状态</th>
            <th>发放时间</th>
            <th>操作</th>
        </tr>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->area }}</td>
                <td>{{ $item->invite_code }}</td>
                @if($item->status == 0)
                    <td style="color: red">未使用</td>
                @else
                    <td style="color: green">已使用</td>
                @endif
                <td>{{ date('Y-m-d H:i', $item->timestamp) }}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="delConfirm({{ $item->id }})">
                        删除记录
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$list->links()}}

@endsection

@section('other_content')


    <div class="modal fade" id="d_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <form method="post" action="{{ route('deny_invite') }}" id="unseal">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="id_deny" name="id_deny">
                        确认要删除么？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-danger">删除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="del_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <form method="post" action="{{ route('del_record') }}" id="unseal">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="control" name="control">
                        确认要删除么？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-danger">删除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection