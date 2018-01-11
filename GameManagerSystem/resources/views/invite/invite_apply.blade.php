@extends('app')
@section('active_invite', 'active')
@section('nav_title', '邀请码管理')
@section('title', '邀请码申请')
@section('sub_title', '申请列表')

@section('main_content')
    <script>
        function sendConfirm(id){
            $('#id_send').val(id);
            $('#a_pop').modal('show');
        }
        function delConfirm(id){
            $('#id_deny').val(id);
            $('#d_pop').modal('show');
        }

    </script>

    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>账号</th>
            <th>用户名</th>
            <th>所在大区</th>
            <th>邮箱</th>
            <th>申请时间</th>
            <th>操作</th>
        </tr>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->account }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->area }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ date('Y-m-d H:i', $item->timestamp) }}</td>
                <td>
                    <button type="button" class="btn btn-success" onclick="sendConfirm({{ $item->id }})">
                        发送邀请码
                    </button>

                    <button type="button" class="btn btn-danger" onclick="delConfirm({{ $item->id }})">
                        拒绝
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$list->links()}}

@endsection

@section('other_content')

    <div class="modal fade" id="a_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <form method="post" action="{{ route('send_code') }}" id="unseal">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="id_send" name="id_send">
                        确认要发送到邮箱么？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-success">发送</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                        确认要拒绝么？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-danger">拒绝</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection